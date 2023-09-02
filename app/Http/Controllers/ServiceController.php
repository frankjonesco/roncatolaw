<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Show all services
    public function index(){
        return view('services.index');
    }
}
