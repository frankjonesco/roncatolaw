<x-layout :meta="$meta">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="flex flex-col sm:flex-row gap-0 sm:gap-2 items-center w-min whitespace-nowrap mx-auto font-roboto">
                <li class="hidden sm:block">
                    <a href="/" class="no-underline tracking-tight">
                        True Crime Metrix
                    </a>
                </li>
                @if($article->criminal_case)
                    <li class="hidden sm:block">></li>
                    <li class="font-bold">
                        <a href="#" class="no-underline tracking-tight">
                            {{$article->criminal_case->title}}
                        </a>
                    </li>
                @endif
                @if($article->criminal_case)
                    <li class="hidden sm:block">></li>
                    <li class="font-bold">
                        <a href="#" class="no-underline tracking-tight text-sky-600">
                            {{$article->topic->title}}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <h1 class="text-center mb-8">
            {{$article->title}}
        </h1>
        <h2 class="text-center mb-7 px-10 m:px-20">
            {{$article->caption}}
        </h2>
        <div class="flex flex-col lg:flex-row border-t pt-8 px-2">
            <div class="w-full lg:w-2/3">
                <div class="article-image w-full aspect-video mb-4">
                    @if($article->image)
                        <div class="w-full h-full bg-no-repeat bg-cover bg-center shadow-xl" style="background-image:url('{{asset('images/articles/'.$article->hex.'/'.$article->image)}}');"></div>
                    @else
                        <div class="bg-gradient-to-tr from-yellow-400 to-amber-100 h-full"></div>
                    @endif
                    <x-article-image-meta :article="$article" />
                </div>


                <div class="article-body">
                    {!!$article->body!!}                    
                </div>

            </div>
            <div class="w-1/3 pl-24 tracking-tight font-roboto">
                <div class="px-5 border-b border-gray-200 py-4 flex flex-col gap-5 mb-5">
                    <div class="flex gap-4 mx-auto w-fit">
                        <a id="shareFacebook" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&display=popup" target="_blank" rel="Share on Facebook" class="share-link hover:bg-[#3b5998] hover:text-white animate-150-in">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a id="shareTwitter" href="#" rel="Share on Twitter" class="share-link hover:bg-[#1da1f2] hover:text-white animate-150-in">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a id="shareEmail" href="#" rel="Share via email" class="share-link hover:bg-gray-600 hover:text-white animate-150-in">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a id="expandShareOptions" href="#" rel="More search options" class="share-link hover:bg-gray-900 hover:text-white animate-150-in">
                            <i class="fas fa-ellipsis-h"></i>
                        </a>
                    </div>
                    <div id="shareSecondRow" class="gap-4 mx-auto w-fit hidden">
                        <a id="shareFacebook" href="#" rel="Share on Whatsapp" class="share-link hover:bg-[#25d366] hover:text-white animate-150-in">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a id="shareEmail" href="#" rel="Share on Reddit" class="share-link hover:bg-[#ff4500] hover:text-white animate-150-in">
                            <i class="fab fa-reddit"></i>
                        </a>
                        <a id="expandShareOptions" href="#" rel="Share on Flipboard" class="share-link hover:bg-[#e12828] hover:text-white animate-150-in">
                            <i class="fab fa-flipboard"></i>
                        </a>
                    </div>

                    <div class="flex mx-auto w-fit text-sm">
                        <div>{{-- class="bull-after" --}}
                            <span class="font-bold">
                                {{$article->views}}
                            </span>
                            <span class="font-light">Views</span>
                        </div>
                        
                        <div class="hidden">
                            <span class="font-bold">
                                {{$article->shares}}
                            </span>
                            <span class="font-light">Shares</span>
                        </div>
                    </div>

                    <script>
                        var expandShareOptions = document.getElementById('expandShareOptions');
                        var shareSecondRow = document.getElementById('shareSecondRow');

                        expandShareOptions.addEventListener('click', function(e){
                            shareSecondRow.classList.toggle('hidden');
                            shareSecondRow.classList.toggle('flex');
                            e.preventDefault();
                        });
                    </script>

                    

                </div>

                <div class="flex flex-col gap-4 justify-center items-center border-b border-gray-200 pb-4">
                    <img src="{{asset('images/author.webp')}}" alt="" class="rounded-full w-16">
                    <div class="text-sm">
                        <span class="font-light">By</span>
                        <span class="font-bold">
                            <a href="#" class="undlerline underline-offset-2">
                                Frank Desoto
                            </a>
                        </span>
                    </div>
                </div>

                <div class="flex flex-col gap-4 justify-center items-center pt-4">
                    <div class="text-sm">
                        <span class="font-bold">Published</span>
                        <span class="font-light">
                            {{showDateTime($article->created_at)}}
                        </span>
                    </div>
                </div>

                @auth
                    <div class="mt-6">
                        <a href="/dashboard/articles/{{$article->hex}}/edit" class="btn btn-dark mx-auto block">
                            Edit article
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-layout>