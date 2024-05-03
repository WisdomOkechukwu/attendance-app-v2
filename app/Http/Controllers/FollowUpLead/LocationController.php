<?php

namespace App\Http\Controllers\FollowUpLead;

use App\Http\Controllers\Controller;
use App\Models\BranchLocation;
use App\Models\BranchState;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $data['locations'] = Location::where('branch_state_id',$admin->branch_state_id)
            ->where('branch_location_id',$admin->branch_location_id)
            ->get();

        $state = BranchState::find($admin->branch_state_id)->state_name;
        $state_location = BranchLocation::find($admin->branch_location_id)->branch_name;

        $data['segment'] = "Branch Location: " . strtoupper($state) ."(".strtoupper($state_location).")";

        return view('admin.locations',$data);
    }
}
