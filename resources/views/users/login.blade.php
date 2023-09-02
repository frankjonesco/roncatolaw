<x-layout>
    <div class="container">
        <h1 class="text-center my-10">Login</h1>
        <h2 class="text-center">Enter your email & password to log in to {{config('app.name')}}.</h2>
        <form action="/users/authenticate" method="post" class="mx-auto w-2/5 mt-16 flex flex-col">
            @csrf

            {{-- Email --}}
            @error('email')
                <p class="form-error">
                    Enter your email address
                </p>
            @enderror
            <input type="text" name="email" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Email" value="{{old('email')}}" autofocus>
            
            {{-- Password --}}
            @error('password')
                <p class="form-error">
                    Enter your email address
                </p>
            @enderror
            <input type="password" name="password" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center !mb-20" placeholder="Password">

            <div class="flex justify-center">
                <button type="submit" class="btn btn-dark">Log in</button>
            </div>
            
        </form>
        <div class="flex justify-center">
            <a href="/signup" class="btn btn-light">Create an account</a>
        </div>
        
    </div>
</x-layout>