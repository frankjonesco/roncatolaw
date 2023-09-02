<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // View Dashboard
    public function index(){
        return view('dashboard.index');
    }
}
