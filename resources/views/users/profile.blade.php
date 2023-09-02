<x-layout>
    <div class="container">
        <h1>Profile</h1>
        <h2>View your {{config('app.name')}} profile.</h2>
        
        <p class="text-center !text-5xl font-extrabold mb-10">{{$user->full_name()}}</p>
        <img src="{{$user->getFullImage()}}" alt="" title="Default profile picture" class="mx-auto mb-10 rounded-full border-sky-300 border-4 p-1 shadow-xl">            

        <div class="grid grid-cols-1">
            <a href="/profile/{{$user->hex}}/images/upload" class="btn btn-dark">
                Change image
            </a>           
        </div>

        <div class="profile-details mt-10">
            <p class="text-center text-2xl text-gray-500 font-light mb-3">Email</p>
            <p class="text-center text-4xl mb-20">
                <a href="mailto:{{$user->email}}" class="no-underline">
                    {{$user->email}}
                </a>
            </p>
        </div>

        <div class="grid grid-cols-1">
            <a href="/profile/{{$user->hex}}/edit" class="btn btn-dark">
                Edit profile
            </a>           
        </div>

        <div class="grid grid-cols-1">
            <a href="/profile/{{$user->hex}}/edit-password" class="btn btn-dark">
                Change password
            </a>           
        </div>
    </div>
</x-layout>