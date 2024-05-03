<?php

namespace App\Service;

use App\Models\CallLog;
use App\Models\MemberCallLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CallLogService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function split_users(){
        DB::transaction(function () {
            $callLog = MemberCallLog::where('is_called', 0)->get();
            SplitFollowUpService::split_members_between_follow_up_team(1, $callLog->where('type','new_comer'));
            SplitFollowUpService::split_members_between_follow_up_team(1, $callLog->where('type','missed_church'));
        });
    }

    public function show_metrics()
    {
        $new_comers = MemberCallLog::where('type','new_comer')
            ->where('follow_up_id',auth()->user()->id)
            ->where('branch_state_id',auth()->user()->branch_state_id)
            ->where('branch_location_id',auth()->user()->branch_location_id)
            ->get();

        $missed_church = MemberCallLog::where('type','missed_church')
            ->where('follow_up_id',auth()->user()->id)
            ->where('branch_state_id',auth()->user()->branch_state_id)
            ->where('branch_location_id',auth()->user()->branch_location_id)
            ->get();


    }

    public function call_user($memberCallLog, $call_category_id, $call_response, $call_duration)
    {
        DB::transaction(function () use ($memberCallLog, $call_category_id, $call_response, $call_duration) {
            $user = User::find($memberCallLog->user_id);

            $callLog = new CallLog();
            $callLog->user_id = $memberCallLog->user_id;
            $callLog->call_category_id = $call_category_id;
            $callLog->call_response = $call_response;
            $callLog->call_duration = $call_duration;
            $callLog->follow_up_id = auth()->user()->id;
            $callLog->branch_location_id = auth()->user()->branch_location_id;
            $callLog->branch_state_id = auth()->user()->branch_state_id;

            $memberCallLog->is_called = 1;
            $memberCallLog->save();

            $user->last_called_date = now();
            $user->save();
        });
    }
}
