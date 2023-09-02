<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show register/create form
    public function create(){
        return view('users.register');
    }

    // Create new user
    public function store(Request $request){
        // dd($request);
        $formFields = $request->validate([
            'first_name' => ['required', 'min:2', 'max:25', 'alpha_dash'],
            'last_name' => ['required', 'min:2', 'max:25', 'alpha_dash'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],
            'agree_terms' => ['required'] 
        ]);

        

        // Create user
        $user = User::create([
            'hex' => Str::random(11),
            'first_name' => trim($request->first_name),
            'last_name' => trim($request->last_name),
            'email' => trim($request->email),
            'password' => bcrypt($request->password)
        ]);

         // Login
         auth()->login($user);

         return redirect('/')->with('message', 'User created & logged in!');
    }

    // Log user out
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    // Show login form 
    public function login(){
        return view('users.login');
    }

    // Authenticate user for login
    public function authenticate(Request $request){

        // dd($request->password);

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/dashboard')->with('message', 'You have logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    // View Profile
    public function viewProfile(User $user){
        if(empty($user->hex)){
            $user = auth()->user();
        }
        return view('users.profile', [
            'user' => $user
        ]);
    }





    // View edit criminal_case form
    public function edit(User $user){
        return view('users.edit', [
            'user' => $user
        ]);
    }

    // Update category in database
    public function update(User $user, Request $request){
        $request->validate([
            'first_name' => 'required|min:2|max:25',
            'last_name' => 'required|min:2|max:25',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)]
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        
        $user->save();
        
        return redirect('profile')->with('message', 'Profile updated!');
    }

    // View edit edit password form
    public function editPassword(User $user){
        return view('users.edit-password', [
            'user' => $user
        ]);
    }

    // Update password for user
    public function updatePassword(User $user, Request $request){
        if(Hash::check($request->old_password, auth()->user()->password) === false){
            $errors = new MessageBag();

            // add your error messages:
            $errors->add('old_password', 'The old password is incorrect.');

            return back()->withErrors($errors);

        }
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        
       

        $user->password = bcrypt($request->password);
        
        $user->save();
        
        return redirect('profile')->with('message', 'Password updated!');
    }

    // Show form to select an image to upload
    public function selectImage(User $user,){
        return view('users.select-image', [
            'user' => $user
        ]);
    }

    // Upload image
    public function uploadImage(User $user, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $user->saveImage($request);
        }
        
        return redirect('profile/'.$user->hex.'/images/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(User $user){
        return view('users.crop-image', [
            'user' => $user
        ]);
    }

    // Render image
    public function renderImage(User $user, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $user->saveRenderedImage($data);

        return redirect('profile')->with('message', 'Your image has been cropped.');
    }

}
