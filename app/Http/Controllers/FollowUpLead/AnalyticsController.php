<?php

namespace App\Http\Controllers\FollowUpLead;

use App\DashboardRoute;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function metrics()
    {
        // $inspiration = DashboardRoute::inspiration();
        // $data['inspiration'] = $inspiration[array_rand($inspiration)];


        // return view('admin.metrics',$data);
        return view('zapp');
    }
}
