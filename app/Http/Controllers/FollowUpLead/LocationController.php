<?php

namespace App\Http\Controllers\FollowUpLead;

use App\Http\Controllers\Controller;
use App\Models\BranchLocation;
use App\Models\BranchState;
use App\Models\Location;
use App\Service\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $location_service;

    public function __construct(LocationService $locationService)
    {
        $this->location_service = $locationService;
    }
    public function index()
    {
        $data = $this->location_service->list_locations();
        return view('admin.locations',$data);
    }
}
