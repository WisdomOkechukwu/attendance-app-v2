<?php

namespace App\Service;

use Illuminate\Http\Request;

class PlannedReachOutService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create_reach_out_plan(Request $request)
    {

    }

    public function add_reach_out_team_member(Request $request)
    {

    }

    public function remove_reach_out_team_member(Request $request)
    {

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
