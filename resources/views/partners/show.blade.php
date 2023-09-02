<x-layout :meta="$meta">
    <div class="container">
        <div class="breadcrumbs mb-6">
            <ul class="flex gap-2 w-min whitespace-nowrap mx-auto font-roboto">
                <li>
                    <a href="/" class="no-underline tracking-tight">
                        True Crime Metrix
                    </a>
                </li>
                <li>></li>
                <li class="font-bold">
                    <a href="#" class="no-underline tracking-tight">
                        {{$criminal_case->title}}
                    </a>
                </li>
                <li>></li>
                <li class="font-bold">
                    <a href="#" class="no-underline tracking-tight">
                        Topics
                    </a>
                </li>
            </ul>
        </div>
        <h1 class="text-center mb-8">
            {{$criminal_case->title}}
        </h1>
        <h2 class="text-center mb-7 px-20">
            Something here.
        </h2>
        <div class="grid grid-cols-4 gap-6 border-t p-6">
            @foreach($criminal_case->topics as $topic)
                <div>
                    <div class="w-full aspect-video mb-4">
                        @if($topic->image)
                            <div class="w-full h-full bg-no-repeat bg-cover bg-center" style="background-image:url('{{asset('images/topics/'.$topic->hex.'/tn-'.$topic->image)}}');"></div>
                        @else
                            <div class="bg-gradient-to-tr from-yellow-400 to-amber-100 h-full"></div>
                        @endif
                    </div>
                
                    <div class="text-lg font-bold leading-5 tracking-tight mb-4">
                        <a href="/topics/{{$topic->hex}}" class="no-underline px-0.5 py-0.5 block hover:bg-yellow-300 hover:text-gray-900">
                            {{$topic->title}}
                        </a>
                    </div>
                
                </div>
        
            @endforeach
        </div>
    </div>
</x-layout>