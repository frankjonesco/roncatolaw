<x-layout>
    <div class="container">
        <h1>Categories</h1>
        <h2>Manage the categories on {{config('app.name')}}.</h2>

        <div class="grid grid-cols-1 mb-10">
            <a href="/dashboard/categories/create" class="btn btn-dark">
                Create category
            </a>
        </div>

        <div class="grid grid-cols-4 gap-6 border-t p-6">
            @foreach($categories as $category)
                <div>
                    <div class="w-full aspect-video mb-4">
                        @if($category->image)
                            <div class="w-full h-full bg-no-repeat bg-cover bg-center" style="background-image:url('{{asset('images/categories/'.$category->hex.'/tn-'.$category->image)}}');"></div>
                        @else
                            <div class="bg-gradient-to-tr from-cyan-400 to-teal-200 h-full"></div>
                        @endif
                    </div>
                    
                    <div class="font-bold leading-5 mb-4">{{$category->title}}</div>
                    <div>
                        <a href="/dashboard/categories/{{$category->hex}}/edit" class="btn btn-dark btn-sm">
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>