<x-layout>
    <div class="container">
        <div class="breadcrumbs mb-6">
            <ul class="flex gap-2 w-min whitespace-nowrap mx-auto font-roboto">
                <li>
                    <a href="/" class="no-underline tracking-tight">
                        {{config('app.name')}}
                    </a>
                </li>
                <li>></li>
                <li class="font-bold">
                    <a href="#" class="no-underline tracking-tight">
                        Partners
                    </a>
                </li>
            </ul>
        </div>
        <h1>Our partners</h1>
        <h2>List of partners at {{config('app.name')}}</h2>

        <div class="grid grid-cols-3 gap-6 border-t p-6">
            @foreach($partners as $partner)
                <div class="text-center">
                    <a href="/partners/{{$partner->hex}}">
                        <div class="w-full aspect-square bg-cover bg-no-repeat bg-top mb-4" style="background-image: url('{{asset('images/partners/'.$partner->hex.'/'.$partner->image)}}');"></div>
                    </a>
                    <p class="text-2xl font-bold">{{$partner->full_name()}}</p>
                    <p class="text-xl text-pink-600">{{$partner->job_title}}</p>
                </div>            
            @endforeach
        </div>
    </div>
</x-layout>