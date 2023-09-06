<!DOCTYPE html>
<html lang="en">
<head>

    {{-- Meta information --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
        $meta = setMeta(isset($meta)?$meta:null);
    @endphp
    <title>{{$meta['title']}}</title>
    <meta name="description" content="{{$meta['description']}}">
    <meta name="author" content="{{config('app.name')}}">

    {{-- Open graph information --}}
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$meta['title']}}" />
    <meta property="og:description" content="{{$meta['description']}}" />
    <meta property="og:image" content="{{$meta['image']}}" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,400;0,600;0,700;1,300;1,400;1,600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Asset builds --}}
    @php
        $environment = 'build';
    @endphp
    @if($environment == 'dev')
        {{-- Development scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Production scripts --}}
        <link href="{{ asset('build/assets/app-816e8c3d.css') }}"  rel="preload" as="style" onload="this.rel='stylesheet'">
        <script src="{{ asset('build/assets/app-dbe23e4c.js') }}" defer></script>
    @endif

    {{-- Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-791TLXKGDD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-791TLXKGDD');
    </script>

</head>

<body>

    <x-navbar />
    
    <div id="searchSlide" class="!z-40 -translate-y-20 transition-all duration-300 ease-out">
        <div id="searchCard" class="bg-neutral-100 border-b border-b-gray-400 w-screen">
            <div class="container flex justify-center py-1.5 mb-0">
                <form action="/" method="GET" class="w-3/4">
                    <input id="searchField" type="text" name="search" class="text-xl font-light outline-none !bg-transparent !mb-0 !border-0 !border-b-0 focus:ring-0 text-center w-full placeholder-gray-600 focus:!shadow-none" placeholder="Search">
                </form>
            </div>
        </div>
        <div id="blackout" class="w-screen h-screen fixed hidden bg-gray-900 bg-opacity-60 z-30 transition-all duration-300 ease-out"></div>

        <div id="headSpace" class="w-full mb-10"></div>

        {{-- Alerts component --}}
        <x-alerts />

        {{$slot}}     

    </div>

    <x-footer />
    
    {{-- Toast messages --}}
    <x-toast-message />

    <script>

        var openMenuIcon = document.getElementById('openMenuIcon');
        var closeMenuIcon = document.getElementById('closeMenuIcon');
        var slideMenu = document.getElementById('slideMenu');
        var toggleSearchIcon = document.getElementById('toggleSearchIcon');
        var searchSlide = document.getElementById('searchSlide');
        var searchField = document.getElementById('searchField');
        var blackout = document.getElementById('blackout');

        // Open menu
        openMenuIcon.addEventListener('click', function(e){
            showMenu();
            toggleBlackout();
            e.preventDefault();
        });
        
        // Close menu
        closeMenuIcon.addEventListener('click', function(e){
            hideMenu();
            toggleBlackout();
            e.preventDefault();
        });
        
        // Open/close search
        toggleSearchIcon.addEventListener('click', function(e){
            hideMenu();
            if(searchSlide.classList.contains('-translate-y-20')){
                state = 'opening';
            }else{
                state = 'closing'; 
            }
            searchSlide.classList.toggle('-translate-y-20');
            searchField.focus();
            var state;
            if(state == 'opening'){
                console.log(18);
                if(blackout.classList.contains('hidden') === true){
                    toggleBlackout();
                }
            }           
            if(state == 'closing'){
                console.log(19);
                if(blackout.classList.contains('hidden') === false){
                    toggleBlackout();
                }
                if(openMenuIcon.classList.contains('text-white') === true){
                    openMenuIcon.classList.remove('text-white');
                }
            }
            e.preventDefault();
        });


        // Hover color of closeMenuIcon
        var homeBtn = document.getElementById('homeBtn');

        homeBtn.onmouseover = function(){
            closeMenuIcon.classList.remove('text-gray-900');
            closeMenuIcon.classList.add('text-white');
        }

        homeBtn.onmouseout = function(){
            closeMenuIcon.classList.remove('text-white');
            closeMenuIcon.classList.add('text-gray-900');
        }



        document.addEventListener("click", (evt) => {
            let targetElement = evt.target; // clicked element
            console.log(targetElement);
            do {
                if (targetElement == blackout) {
                    // Do nothing, just return.
                    hideMenu();
                    console.log('close blackout');
                    
                    
                    closeSearch();
                    blackout.classList.add('hidden');
                }
                // Go up the DOM.
                targetElement = targetElement.parentNode;
            } while (targetElement);

            
        });

        





        function showMenu(){
            closeSearch();
            slideMenu.classList.remove('-left-1/4');
            slideMenu.classList.add('left-0');
            closeMenuIcon.classList.remove('hidden');
            openMenuIcon.classList.add('text-white');            
        }

        function hideMenu(){
            slideMenu.classList.remove('left-0');
            slideMenu.classList.add('-left-1/4');
            closeMenuIcon.classList.add('hidden');
            openMenuIcon.classList.remove('text-white');
        }

        function toggleBlackout(){
            if(blackout.classList.contains('hidden')){
                blackout.classList.remove('hidden');
            }else{
                blackout.classList.add('hidden');
            }
        }
       
        
        function closeSearch(){
            if(searchSlide.classList.contains('-translate-y-20') === false){
                searchSlide.classList.toggle('-translate-y-20');
                document.getElementById('blackout').classList.toggle('hidden'); 
            }
        }
        </script>

</body>
</html>