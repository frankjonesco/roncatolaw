<x-layout>
    <div class="container">
        <h1>True Crime News Topics</h1>
        <h2>Browse our list of news articles on true crime.</h2>

        <div class="grid grid-cols-4 gap-6 border-t p-6">
            @foreach($topics as $topic)
                <div>
                    <div class="w-full aspect-video mb-4">
                        @if($topic->image)
                            <div class="w-full h-full bg-no-repeat bg-cover bg-center" style="background-image:url('{{asset('images/topics/'.$topic->hex.'/tn-'.$topic->image)}}');"></div>
                        @else
                            <div class="bg-gradient-to-tr from-yellow-400 to-amber-100 h-full"></div>
                        @endif
                    </div>
                    
                    <div class="text-lg font-bold leading-5 tracking-tight mb-4">
                        <a href="/articles/{{$article->hex}}" class="no-underline px-0.5 py-0.5 block hover:bg-yellow-300 hover:text-gray-900">
                            {{$article->title}}
                        </a>
                    </div>
                    
                </div>
            
            @endforeach
        </div>
    </div>
</x-layout>