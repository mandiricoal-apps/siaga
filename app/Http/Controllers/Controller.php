<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard_catering(){
        return view('home.dashboard_catering');
    }

    public function dashboard_departemen(){
        return view('home.dashboard_departemen');
    }

    public function dashboard_ga(){
        return view('home.dashboard_ga');
    }
}
