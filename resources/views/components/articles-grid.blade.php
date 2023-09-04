<div class="grid-lg">
    @foreach($articles as $article)
        <div class="grid-item flex flex-col border-b border-gray-200 pb-2">
            <a href="/articles/{{$article->hex}}">
                @if($article->image)
                    <div class="thumbnail" style="background-image:url('{{asset('images/articles/'.$article->hex.'/tn-'.$article->image)}}');"></div>
                @else
                    <div class="thumbnail bg-gray-500"></div>
                @endif
            </a>
            @auth
            <div class="">
                <a href="/dashboard/articles/{{$article->hex}}/edit" class="btn btn-dark btn-xs">
                    Edit
                </a>
            </div>
            @endauth
            <a href="/articles/{{$article->hex}}" class="text-lg font-bold leading-5 tracking-tight mb-1 no-underline px-0.5 py-0.5 block hover:bg-yellow-300 hover:text-gray-900">
                {{$article->title}}
            </a>
            <span class="font-light text-sm block mb-2" style="font-family: 'Poppins', sans-serif;">{{showDateTime($article->created_at)}}</span>
        </div>
    @endforeach
</div>