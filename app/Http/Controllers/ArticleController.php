<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ImageProcess;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    // PUBLIC METHODS

    // List public articles
    public function index(){

        // $breeds = Http::get('https://dog.ceo/api/breeds/list/random/5')['message'];
        // dd($breeds);



        $articles = Article::orderBy('id', 'DESC')->where('status', 'public')->get();
        return view('articles.index', [
            'categories' => Category::where('status', 'public')->orderBy('title', 'ASC')->get(),
            'articles' => $articles
        ]);
    }

    // Show single article index
    public function show(Article $article){
        // Increment article->views
        $article->views = $article->views + 1;
        $article->save();

        // Other articles
        $other_articles = Article::orderBy('id', 'DESC')->where('status', 'public')->where('hex', '!=', $article->hex)->get();

        return view('articles.show', [
            'article' => $article,
            'other_articles' => $other_articles,
            'meta' => [
                'title' => $article->title.' - '. config('app.name'),
                'description' => truncate(strip_tags($article->body), 140),
                'image' => 'https://truecrimemetrix.com/images/articles/'.$article->hex.'/'.$article->image
            ]
        ]);
    }



    // ADMIN METHODS

    // Admin articles index
    public function adminIndex(){
        $articles = Article::orderBy('id', 'DESC')->get();
        return view('articles.admin-index', [
            'articles' => $articles
        ]);
    }

    // View create article form
    public function create(){
        return view('articles/create', [
            'categories' => Category::orderBy('title', 'ASC')->get()
        ]);
    }

    // Store article in database
    public function store(Request $request, Article $article){
        // dd($request);
        $request->validate([
            'title' => 'required'
        ]);

        $article->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'caption' => $request->caption,
            'body' => $request->body,
            'category_id' => $request->category,
            'topic_id' => $request->topic,
            'status' => $request->status
        ]);

        return redirect('dashboard/articles')->with('message', 'Article created!');
    }

    // View edit article form
    public function edit(Article $article){
        return view('articles/edit', [
            'article' => $article,
            'criminal_cases' => Category::orderBy('title', 'ASC')->get(),
            'topics' => Topic::orderBy('title', 'ASC')->get(),
        ]);
    }

    // Update article in database
    public function update(Article $article, Request $request){
        $form_data = $request->validate([
            'title' => 'required',
            'criminal_case_id' => 'required',
            'topic_id' => 'required'
        ]);

        $article->criminal_case_id = $request->criminal_case_id;
        $article->topic_id = $request->topic_id;
        $article->title = $request->title;
        $article->caption = $request->caption;
        $article->body = $request->body;
        $article->status = $request->status;
        
        $article->save();

        return redirect('dashboard/articles')->with('message', 'Article updated!');
    }

    // Show form to select an image to upload
    public function selectImage(Article $article,){
        return view('articles/select-image', [
            'article' => $article
        ]);
    }

    // Upload image
    public function uploadImage(Article $article, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $article->saveImage($request);
        }
        
        return redirect('dashboard/articles/'.$article->hex.'/images/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(Article $article){
        return view('articles.crop-image', [
            'article' => $article
        ]);
    }

    // Render image
    public function renderImage(Article $article, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $article->saveRenderedImage($data);

        return redirect('dashboard/articles')->with('message', 'Your image has been cropped.');
    }





    // Upload images added to the article body in CK Editor
    public function storeBodyImage(Article $article, Request $request)
    {
        if ($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
    
            $request->file('upload')->move(public_path('images/articles/' . $article->hex), $fileName);
    
            $url = asset('images/articles/' . $article->hex . '/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

        }
    }

    

}
