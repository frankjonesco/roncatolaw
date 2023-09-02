<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Show all testimonials
    public function index(){
        return view('testimonials.index');
    }
}
