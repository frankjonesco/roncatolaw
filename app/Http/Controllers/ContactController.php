<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Show contact form page
    public function index(){
        // $data = new Message();
        // $data->name = 'Frank Jones';
        // $data->email = 'frankjones.web@gmail.com';
        // $data->phone = '+351 913 455 313';
        // $data->subject = 'I\'d like some information';
        // $data->message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.';
        // dd($data);
        return view('contact.index', [
            //'data' => $data
        ]);
    }

    // Send message via email
    public function sendMessage(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $message = new Message();

        $message->create([
            'hex' => Str::random(11),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect('/')->with('message', 'Message sent!');

    }
}
