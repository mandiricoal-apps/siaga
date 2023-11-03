<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->id_role == 1) {
            return '/departemen/dashboard';
        }
        if (Auth::user()->id_role == 2) {
            return '/catering/dashboard';
        }
        if (Auth::user()->id_role == 3) {
            return '/hrd/dashboard';
        }
        if (Auth::user()->id_role == 4) {
            return '/ga/dashboard';
        }
    }
}
