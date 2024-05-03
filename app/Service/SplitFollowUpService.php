<?php

namespace App\Service;

use App\Models\User;
use App\Role;

class SplitFollowUpService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function split_members_between_follow_up_team($add_lead = 0, $data = collect())
    {
        $follow_up_member_role = [Role::FOLLOW_UP];
        if($add_lead == 1){
            array_push($follow_up_member_role, Role::LEAD_FOLLOW_UP);
        }

        $follow_up = User::select('id')
            ->whereIn('role', $follow_up_member_role)
            ->get();

        
    }
}
