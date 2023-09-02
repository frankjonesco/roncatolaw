<x-layout>

    <style>
        .ck-editor__editable {
            min-height: 600px !important;
            margin-bottom: 3rem;
        }
    </style>

    
    <div class="container">
        <h1>Edit profile inforation</h1>
        <h2>Edit the profile information and click update.</h2>

        <div class="grid grid-cols-1">
            <a href="/dashboard/profile/{{$user->hex}}/images/upload" class="btn btn-dark">
                Upload image
            </a>           
        </div>

        <form id="editUserForm" action="/profile/{{$user->hex}}/update" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf
            
            {{-- First name --}}
            @error('first_name')
                <p class="form-error">
                    Enter first name
                </p>
            @enderror
            <input type="text" name="first_name" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="First name" value="{{old('first_name')?:$user->first_name}}" autofocus>

            {{-- Last name --}}
            @error('last_name')
                <p class="form-error">
                    Enter last name
                </p>
            @enderror
            <input type="text" name="last_name" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Last name" value="{{old('last_name')?:$user->last_name}}">

            {{-- Email --}}
            @error('email')
                <p class="form-error">
                    Enter email address
                </p>
            @enderror
            <input type="email" name="email" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Email" value="{{old('email')?:$user->email}}">

            {{-- Password --}}
            {{-- @error('password')
                <p class="form-error">
                    {{$message}}
                </p>
            @else
                @error('terms')
                    <p class="form-error">
                        Please re-enter your password
                    </p>
                @enderror
            @enderror
            <input type="password" name="password" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Password">
            
            {{-- Password confirmation --
            @error('password_confirmation')
                <p class="form-error">
                    {{$message}}
                </p>
            @enderror
            <input type="password" name="password_confirmation" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center " placeholder="Confirm password"> --}}

            <div class="flex justify-center mt-10">
                <button type="submit" class="btn btn-dark">Update profile</button>
            </div>

            

            
        </form>
    </div>

    
</x-layout>