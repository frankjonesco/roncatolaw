<x-layout>

    <style>
        .ck-editor__editable {
            min-height: 600px !important;
            margin-bottom: 3rem;
        }
    </style>

    
    <div class="container">
        <h1>Update password</h1>
        <h2>Enter the new password and click Update.</h2>

        <form id="editUserPasswordForm" action="/profile/{{$user->hex}}/update-password" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf

            {{-- Old password --}}
            @error('old_password')
                <p class="form-error">
                    {{$message}}
                </p>
            @enderror
            <input type="password" name="old_password" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Old password">

            {{-- Password --}}
            @error('password')
                <p class="form-error">
                    {{$message}}
                </p>
            @enderror
            <input type="password" name="password" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="New password">
            
            {{-- Password confirmation --}}
            @error('password_confirmation')
                <p class="form-error">
                    {{$message}}
                </p>
            @enderror
            <input type="password" name="password_confirmation" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center " placeholder="Confirm new password">

            <div class="flex justify-center mt-10">
                <button type="submit" class="btn btn-dark">Update password</button>
            </div>

            

            
        </form>
    </div>

    
</x-layout>