<?php

namespace App\Service;

use App\Models\BranchLocation;
use App\Models\BranchState;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class LocationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function list_locations(): array
    {
        $admin = auth()->user();
        $data['locations'] = Location::where('branch_state_id', $admin->branch_state_id)
            ->where('branch_location_id', $admin->branch_location_id)
            ->get();

        $state = BranchState::find($admin->branch_state_id)->state_name;
        $state_location = BranchLocation::find($admin->branch_location_id)->branch_name;

        $data['segment'] = 'Branch Location: ' . strtoupper($state) . '(' . strtoupper($state_location) . ')';

        return $data;
    }

    public function add_location($name)
    {
        DB::transaction(function () use ($name) {
            $admin = auth()->user();

            $location = new Location();
            $location->name = $name;
            $location->branch_state_id = $admin->branch_state_id;
            $location->branch_location_id = $admin->branch_location_id;
            $location->save();
        });
    }

    public function rename_location($id, $name)
    {
        DB::transaction(function () use ($id, $name) {
            $admin = auth()->user();

            $location = Location::where('id', $id)
                ->where('branch_state_id', $admin->branch_state_id)
                ->where('branch_location_id', $admin->branch_location_id)
                ->first();

            $location->name = $name;
            $location->save();
        });
    }
}
