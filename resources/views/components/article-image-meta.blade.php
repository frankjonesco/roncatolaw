<div class="image-caption flex flex-col md:flex-row justify-between items-center gap-4 md:gap-28 border-b border-b-gray-200 py-6 px-4 mb-6 font-light font-roboto text-xs">
    @if($article->image_caption || $article->image_copyright)
        <div class="text-center md:text-left">
            {{$article->image_caption}}
        </div>
        <div class="flex">
            &copy;&nbsp;
            <a href="{{$article->image_copyright_link}}" target="_blank" class="whitespace-nowrap no-underline">
                {{$article->image_copyright}}
            </a>
        </div>
    @endif
</div>


