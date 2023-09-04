<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // PUBLIC METHODS

    // List public testimonials
    public function index(){
        $testimonials = Testimonial::orderBy('id', 'DESC')->where('status', 'public')->get();
        return view('categories.index', [
            'testimonials' => $testimonials
        ]);
    }

    // Show single testimonial index
    public function show(Testimonial $testimonial){
        // Increment testimonial->views
        $testimonial->views = $testimonial->views + 1;
        $testimonial->save();

        // Other testimonial
        $other_testimonials = Testimonial::orderBy('id', 'DESC')->where('status', 'public')->where('hex', '!=', $testimonial->hex)->get();

        return view('testimonials.show', [
            'testimonial' => $testimonial,
            'other_testimonials' => $other_testimonials,
            'meta' => [
                'title' => $testimonial->full_name().' - '.config('app.name'),
                'description' => truncate(strip_tags($testimonial->description), 140),
                'image' => 'https://truecrimemetrix.test/images/criminal_case/'.$testimonial->hex.'/'.$testimonial->image
            ]
        ]);
    }

    



    // ADMIN METHODS

    // Admin testimonials index
    public function adminIndex(){
        $testimonials = Testimonial::orderBy('id', 'DESC')->get();
        return view('testimonials.admin-index', [
            'testimonials' => $testimonials
        ]);
    }

    // View create testimonial form
    public function create(){
        return view('testimonials.create');
    }

    // Store testimonial in database
    public function store(Request $request, Testimonial $testimonial){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $testimonial->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'testimonial' => $request->testimonial,
            'status' => $request->status
        ]);

        return redirect('dashboard/testimonials')->with('message', 'Testimonial created!');
    }

    // View edit testimonial form
    public function edit(Testimonial $testimonial){
        return view('testimonials.edit', [
            'testimonial' => $testimonial
        ]);
    }

    // Update testimonial in database
    public function update(Testimonial $testimonial, Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'job_title' => 'required',
            'description' => 'required',
        ]);

        $testimonial->first_name = $request->first_name;
        $testimonial->last_name = $request->last_name;
        $testimonial->job_title = $request->job_title;
        $testimonial->description = $request->description;
        $testimonial->status = $request->status;
        
        $testimonial->save();

        return redirect('dashboard/testimonials')->with('message', 'Testimonial updated!');
    }

    // Show form to select an image to upload
    public function selectImage(Testimonial $testimonial,){
        return view('testimonials.select-image', [
            'testimonial' => $testimonial
        ]);
    }

    // Upload image
    public function uploadImage(Testimonial $testimonial, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $testimonial->saveImage($request);
        }
        
        return redirect('dashboard/testimonials/'.$testimonial->hex.'/images/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(Testimonial $testimonial){
        return view('testimonials.crop-image', [
            'testimonial' => $testimonial
        ]);
    }

    // Render image
    public function renderImage(Testimonial $testimonial, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $testimonial->saveRenderedImage($data);

        return redirect('dashboard/testimonials')->with('message', 'Your image has been cropped.');
    }
}
