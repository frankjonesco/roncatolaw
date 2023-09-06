<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    // PUBLIC METHODS

    // List public partners
    public function index(){
        $partners = Partner::orderBy('id', 'DESC')->where('status', 'public')->get();
        return view('partners.index', [
            'partners' => $partners
        ]);
    }

    // Show single partner index
    public function show(Partner $partner){
        // Increment partner->views
        $partner->views = $partner->views + 1;
        $partner->save();

        // Other partners
        $other_partners = Partner::orderBy('id', 'DESC')->where('status', 'public')->where('hex', '!=', $partner->hex)->get();

        return view('partners.show', [
            'partner' => $partner,
            'other_partners' => $other_partners,
            'meta' => [
                'title' => $partner->full_name().' - '.config('app.name'),
                'description' => truncate(strip_tags($partner->description), 140),
                'image' => 'https://truecrimemetrix.test/images/criminal_case/'.$partner->hex.'/'.$partner->image
            ]
        ]);
    }

    



    // ADMIN METHODS

    // Admin partners index
    public function adminIndex(){
        $partners = Partner::orderBy('id', 'DESC')->get();
        return view('partners.admin-index', [
            'partners' => $partners
        ]);
    }

    // View create partner form
    public function create(){
        return view('partners.create');
    }

    // Store partner in database
    public function store(Request $request, Partner $partner){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $partner->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'job_title' => $request->job_title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect('dashboard/partners')->with('message', 'Partner created!');
    }

    // View edit partner form
    public function edit(Partner $partner){
        return view('partners.edit', [
            'partner' => $partner
        ]);
    }

    // Update partner in database
    public function update(Partner $partner, Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'job_title' => 'required',
            'description' => 'required',
        ]);

        $partner->first_name = $request->first_name;
        $partner->last_name = $request->last_name;
        $partner->job_title = $request->job_title;
        $partner->description = $request->description;
        $partner->status = $request->status;
        
        $partner->save();

        return redirect('dashboard/partners')->with('message', 'Partner updated!');
    }

    // Show form to select an image to upload
    public function selectImage(Partner $partner,){
        return view('partners.select-image', [
            'partner' => $partner
        ]);
    }

    // Upload image
    public function uploadImage(Partner $partner, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $partner->saveImage($request);
        }
        
        return redirect('dashboard/partners/'.$partner->hex.'/images/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(Partner $partner){
        return view('partners.crop-image', [
            'partner' => $partner
        ]);
    }

    // Render image
    public function renderImage(Partner $partner, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $partner->saveRenderedImage($data);

        return redirect('dashboard/partners')->with('message', 'Your image has been cropped.');
    }
}
