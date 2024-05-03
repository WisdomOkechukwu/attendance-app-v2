<?php

namespace App\Service;

use App\Models\PlannedCalledUsers;
use App\Models\PlannedCalledUsersLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlannedReachOutService
{
    public function create_reach_out_plan($name)
    {
        DB::transaction(function () use ($name) {
            $admin = auth()->user();

            $planned_called_user = new PlannedCalledUsers();
            $planned_called_user->name = $name;
            $planned_called_user->status = 'active';
            $planned_called_user->branch_location_id = $admin->branch_location_id;
            $planned_called_user->branch_state_id = $admin->branch_state_id;
            $planned_called_user->save();
        });
    }

    public function add_reach_out_team_member($planned_called_users_id,$user_id)
    {
        DB::transaction(function () use ($planned_called_users_id,$user_id) {
            $planned_called_user_log = new PlannedCalledUsersLog();
            $planned_called_user_log->planned_called_users_id = $planned_called_users_id;
            $planned_called_user_log->user_id = $user_id;
            $planned_called_user_log->save();
        });
    }

    public function remove_reach_out_team_member(Request $request)
    {
        // DB::transaction(function () use ($planned_called_users_id,$user_id) {
        //     $planned_called_user_log = new PlannedCalledUsersLog();
        //     $planned_called_user_log->planned_called_users_id = $planned_called_users_id;
        //     $planned_called_user_log->user_id = $user_id;
        //     $planned_called_user_log->save();
        // });
    }

    public function split_reach_out_team_member(Request $request)
    {
        SplitFollowUpService::split_members_between_follow_up_team();
    }

    public function move_reach_out_team_member(Request $request)
    {

    }

    public function delete_reach_out_plan(Request $request)
    {

    }
}
