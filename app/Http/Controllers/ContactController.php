<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Show contact form page
    public function index(){
        return view('contact.index');
    }
}
