<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // PUBLIC METHODS

    // List public categories
    public function index(){
        $criminal_cases = Category::orderBy('id', 'DESC')->where('status', 'public')->get();
        return view('categories.index', [
            'criminal_cases' => $criminal_cases
        ]);
    }

    // Show single category index
    public function show(Category $criminal_case){
        // Increment category->views
        $criminal_case->views = $criminal_case->views + 1;
        $criminal_case->save();

        // Other categories
        $other_criminal_cases = Category::orderBy('id', 'DESC')->where('status', 'public')->where('hex', '!=', $criminal_case->hex)->get();

        return view('categories.show', [
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

    // Admin categories index
    public function adminIndex(){
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('categories.admin-index', [
            'categories' => $categories
        ]);
    }

    // View create category form
    public function create(){
        return view('categories.create');
    }

    // Store category in database
    public function store(Request $request, Category $category){
        $request->validate([
            'title' => 'required'
        ]);

        $category->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'caption' => $request->caption,
            'status' => $request->status
        ]);

        return redirect('dashboard/categories')->with('message', 'Category created!');
    }

    // View edit criminal_case form
    public function edit(Category $category){
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    // Update category in database
    public function update(Category $category, Request $request){
        $request->validate([
            'title' => 'required'
        ]);

        $category->title = $request->title;
        $category->status = $request->status;
        
        $category->save();

        return redirect('dashboard/categories')->with('message', 'Category updated!');
    }

    // Show form to select an image to upload
    public function selectImage(Category $category,){
        return view('categories.select-image', [
            'category' => $category
        ]);
    }

    // Upload image
    public function uploadImage(Category $category, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $category->saveImage($request);
        }
        
        return redirect('dashboard/categories/'.$category->hex.'/images/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(Category $category){
        return view('categories.crop-image', [
            'category' => $category
        ]);
    }

    // Render image
    public function renderImage(Category $category, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $category->saveRenderedImage($data);

        return redirect('dashboard/categories')->with('message', 'Your image has been cropped.');
    }
}
