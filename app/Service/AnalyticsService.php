<?php

namespace App\Service;

use App\Models\LocationLog;
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
    private $start_date;
    private $end_date;

    public function __construct($service_day = null, $start_date = null, $end_date = null)
    {
        $this->start_date = $start_date ?? now()->startOfMonth();
        $this->end_date = $end_date ?? now();

        // Retrieve data from ServiceDays table with optional filtering by service_day
        $this->data = ServiceDays::when($service_day, function ($query, $service_day) {
            return $query->where('service_day', $service_day);
        })
            ->whereBetween('service_date', [$this->start_date, $this->end_date])
            ->get();

        // Get the last service day record from the retrieved data
        $this->last_service = ServiceDays::orderBy('id', 'DESC')->first();

        // Calculate total number of present, absent, and available seats across all service days
        $this->total_present = $this->data->sum('no_present');
        $this->total_absent = $this->data->sum('no_absent');
        $this->total_seats = $this->data->sum('no_seats');
    }

    /**
     * Calculate the total attendance in previous service based on the retrieved data.
     *
     * @return float
     */

    public function total_attendance_previous_service(): float
    {
        return $this->last_service->no_present ?? 0;
    }

    /**
     * Calculate the total attendance based on the retrieved data.
     *
     * @return float
     */

    public function total_attendance_this_month(): float
    {
        return $this->total_present;
    }

    /**
     * Calculate the average attendance based on the retrieved data.
     *
     * @return float
     */
    public function average_attendance(): float
    {
        return $this->data->avg('no_present');
    }

    /**
     * Calculate the percentage of present attendees to available seats.
     *
     * @return float
     */
    public function present_to_seats_percentage(): float
    {
        return ($this->total_present / $this->total_seats) * 100;
    }

    /**
     * Calculate the percentage of present attendees to absent attendees.
     *
     * @return float
     */
    public function present_to_absent_percentage(): float
    {
        return ($this->total_present / ($this->total_absent + $this->total_present)) * 100;
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
            ->where('type', 'missed_church')
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
        return LocationLog::all();
    }

    public function establishment_rate(): float
    {
        $establishment_rate = User::select('id', 'service_unit_joined_at')
            ->whereBetween('discipleship_class_joined_at', [$this->start_date, $this->end_date])
            ->get();

        return ($establishment_rate->where('service_unit_joined_at', '!=', null)->count() / $establishment_rate->count()) * 100;
    }

    public function conversion_rate()
    {
        $conversion_rate = User::select('id', 'discipleship_class_joined_at')
            ->whereBetween('service_unit_joined_at', [$this->start_date, $this->end_date])
            ->get();

        return ($conversion_rate->where('discipleship_class_joined_at', '!=', null)->count() / $conversion_rate->count()) * 100;
    }
}
