<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    // PUBLIC METHODS

    // List public topic
    public function index(){
        $topics = Topic::orderBy('id', 'DESC')->where('status', 'public')->get();
        return view('topics.index', [
            'topics' => $topics
        ]);
    }

    // Show single topic
    public function show(Topic $criminal_case){
        // Increment topic->views
        $criminal_case->views = $criminal_case->views + 1;
        $criminal_case->save();

        // Other topics
        $other_criminal_cases = Topic::orderBy('id', 'DESC')->where('status', 'public')->where('hex', '!=', $criminal_case->hex)->get();

        return view('topics.show', [
            'criminal_case' => $criminal_case,
            'other_criminal_cases' => $other_criminal_cases,
            'meta' => [
                'title' => $criminal_case->title.' - True Crime Metrix',
                'description' => truncate(strip_tags($criminal_case->body), 140),
                'image' => 'https://truecrimemetrix.test/images/criminal_case/'.$criminal_case->hex.'/'.$criminal_case->image
            ]
        ]);
    }



    // ADMIN METHODS

    // Admin topics index
    public function adminIndex(){
        $topics = Topic::orderBy('id', 'DESC')->get();
        return view('topics.admin-index', [
            'topics' => $topics
        ]);
    }

    // View create topic form
    public function create(){
        return view('topics/create', [
            'categories' => Category::orderBy('title', 'ASC')->get(),
        ]);
    }

    // Store topic in database
    public function store(Request $request, Topic $topic){
        $request->validate([
            'title' => 'required'
        ]);

        // dd($request);

        $topic->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'caption' => $request->caption,
            'status' => $request->status
        ]);

        return redirect('dashboard/topics')->with('message', 'Topic created!');
    }

    // View edit topic form
    public function edit(Topic $topic){
        // dd(Category::orderBy('title', 'DESC')->get());
        return view('topics/edit', [
            'categories' => Category::orderBy('title', 'ASC')->get(),
            'topic' => $topic,
        ]);
    }

    // Update topic in database
    public function update(Topic $topic, Request $request){
        $request->validate([
            'title' => 'required'
        ]);

        $topic->category_id = $request->category_id;
        $topic->title = $request->title;
        $topic->caption = $request->caption;
        $topic->status = $request->status;
        
        $topic->save();

        return redirect('dashboard/topics')->with('message', 'Topic updated!');
    }

    // Show form to select an image to upload
    public function selectImage(Topic $topic,){
        return view('topics/select-image', [
            'topic' => $topic
        ]);
    }

    // Upload image
    public function uploadImage(Topic $topic, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $topic->saveImage($request);
        }
        
        return redirect('dashboard/topics/'.$topic->hex.'/images/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(Topic $topic){
        return view('topics.crop-image', [
            'topic' => $topic
        ]);
    }

    // Render image
    public function renderImage(Topic $topic, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $topic->saveRenderedImage($data);

        return redirect('dashboard/topics')->with('message', 'Your image has been cropped.');
    }
}
