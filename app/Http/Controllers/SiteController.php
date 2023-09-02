<?php

namespace App\Http\Controllers;

use Carbon;
use App\Models\Topic;
use App\Models\Partner;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // View homepage
    public function home(){
        $partners = Partner::orderBy('id', 'DESC')->where('status', 'public')->take(3)->get();
        return view('home', [
            'partners' => $partners
        ]);
    }

    // View terms
    public function viewAbout(){
        return view('about');
    }

    // View terms
    public function viewTerms(){
        return view('terms');
    }



    public function getOptions($id = null){
        // dd('Hello world');

        $topics = Topic::where('category_id', $id)->orderBy('title', 'ASC')->get();

        return response()->json($topics);


    }
}
