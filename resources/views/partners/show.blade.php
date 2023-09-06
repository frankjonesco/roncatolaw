<x-layout :meta="$meta">
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
                    <a href="/partners" class="no-underline tracking-tight">
                        Partners
                    </a>
                </li>
                <li>></li>
                <li class="font-bold">
                    <a href="/partners/{{$partner->hex}}" class="no-underline tracking-tight">
                        {{$partner->full_name()}}
                    </a>
                </li>
            </ul>
        </div>

        <h1>Our partners</h1>

        <div class="grid grid-cols-2">
            <img src="{{asset('images/partners/'.$partner->hex.'/'.$partner->image)}}" alt="" title="" class="w-3/4 mx-auto mt-10">
            <div>
                <h1 class="text-center mb-8">
                    {{$partner->full_name()}}
                </h1>
                <h2 class="text-center mb-7 px-20 text-pink-600 font-bold">
                    {{$partner->job_title}}
                </h2>

                <h2 class="text-center mb-7 px-20">
                    {{$partner->description}}
                </h2>

                <h1 class="text-center mb-8 mt-20">
                    Other partners
                </h1>

                <div class="grid grid-cols-2 gap-10">
                    @foreach ($other_partners as $partner)

                        <div class="flex flex-col">
                            <a href="/partners/{{$partner->hex}}">
                                <div class="w-full aspect-square bg-no-repeat bg-cover bg-top bg-gray-500" style="background-image:url('{{asset('images/partners/'.$partner->hex.'/'.$partner->image)}}');"></div>
                            </a>
                            <h2 class="font-bold">
                                <a href="/partners/{{$partner->hex}}" class="no-underline">
                                    {{$partner->full_name()}}
                                </a>
                            </h2>
                        </div>
                        
                    @endforeach
                </div>
            </div>
        </div>

        
    </div>
</x-layout>