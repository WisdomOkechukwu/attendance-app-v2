<?php

namespace App\Service;

use App\Models\MemberCallLog;
use App\Models\OutreachMembershipLog;
use App\Models\ServiceDays;
use App\Models\User;
use Carbon\Carbon;

class AnalyticsService
{
    /**
     * Data collection from ServiceDays table filtered by service_day if provided.
     */
    private $data;
    private $total_present;
    private $total_absent;
    private $total_seats;
    private $last_service;

    public function __construct($service_day = null)
    {
        // Retrieve data from ServiceDays table with optional filtering by service_day
        $this->data = ServiceDays::when($service_day, function ($query, $service_day) {
            return $query->where('service_day', $service_day);
        })->get();

        // Get the last service day record from the retrieved data
        $this->last_service = $this->data->last() ? Carbon::parse($this->data->last()) : now();

        // Calculate total number of present, absent, and available seats across all service days
        $this->total_present = $this->data->sum('no_present');
        $this->total_absent = $this->data->sum('no_absent');
        $this->total_seats = $this->data->sum('no_seats');
    }

    /**
     * Calculate the average attendance based on the retrieved data.
     *
     * @return object
     */
    public function average_attendance(): object
    {
        return (object) [
            'average_attendance' => $this->data->avg('no_present'),
        ];
    }

    /**
     * Calculate the percentage of present attendees to available seats.
     *
     * @return object
     */
    public function present_to_seats_percentage(): object
    {
        return (object) [
            'present_to_seats_percentage' => ($this->total_present / $this->total_seats) * 100,
        ];
    }

    /**
     * Calculate the percentage of present attendees to absent attendees.
     *
     * @return object
     */
    public function present_to_absent_percentage(): object
    {
        return (object) [
            'present_to_absent_percentage' => ($this->total_present / ($this->total_absent + $this->total_present)) * 100,
        ];
    }

    /**
     * Prepare chart data for attendance and new attendees.
     *
     * @return object
     */
    public function service_statistics_chart_data(): object
    {
        return (object) [
            'chart_of_attendance' => $this->data->pluck('no_present'),
            'chart_of_new_comers' => $this->data->pluck('no_new_comers'),
        ];
    }

    /**
     * Count the total number of records in the OutreachMembershipLog table.
     *
     * @return int
     */

    /**
     * Calculate the percentage of missed church sessions within a given time frame and call status.
     *
     * @param string $start
     * @param string $end
     * @param int $is_called
     * @return float
     */
    public function missed_church_statistics(string $start, string $end, int $is_called): float
    {
        $missed_church = MemberCallLog::select('is_called', 'created_at')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return ($missed_church->where('is_called', $is_called)->count() / $missed_church->count()) * 100;
    }

    /**
     * Calculate the percentage of missed church sessions for the current month where members were not called.
     *
     * @return float
     */
    public function missed_church_this_month_not_called_percentage(): float
    {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        return $this->missed_church_statistics($start, $end, 0);
    }

    /**
     * Calculate the percentage of missed church sessions for the current month where members were called.
     *
     * @return float
     */
    public function missed_church_this_month_called_percentage(): float
    {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        return $this->missed_church_statistics($start, $end, 1);
    }

    /**
     * Calculate the percentage of missed church sessions for the previous service where members were not called.
     *
     * @return float
     */
    public function missed_church_for_previous_service_not_called_percentage(): float
    {
        return $this->missed_church_statistics($this->last_service->service_date, now(), 0);
    }

    /**
     * Calculate the percentage of missed church sessions for the previous service where members were called.
     *
     * @return float
     */
    public function missed_church_for_previous_service_called_percentage(): float
    {
        return $this->missed_church_statistics($this->last_service->service_date, now(), 1);
    }

    /**
     * Retrieve upcoming birthdays within the next 7 days.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function upcoming_birthdays(): \Illuminate\Database\Eloquent\Collection
    {
        return User::select('name', 'dob')
            ->whereBetween('dob', [now()->startOfDay(), now()->addDays(7)->endOfDay()])
            ->get();
    }

    /**
     * Retrieve the count of members per location.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function members_per_location(): \Illuminate\Database\Eloquent\Collection
    {
        return User::selectRaw('location, COUNT(*) as count')->groupBy('location')->get();
        //!for this create a location log
    }

    public function establishment_rate()
    {
        //! checking when the member joined the workforce
        //? HOW - by checking the discipleship_at is not null
    }

    public function conversion_rate()
    {
        //! checking when the member joined the discipleship
        //? HOW - by checking the service_unit_at is not null
    }
}
