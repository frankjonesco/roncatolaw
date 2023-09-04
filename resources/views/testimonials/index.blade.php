<x-layout>
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
                        Criminal cases
                    </a>
                </li>
            </ul>
        </div>
        <h1>Criminal Cases featured on True Crime Metrix</h1>
        <h2>Browse our list of criminal cases.</h2>

        <div class="grid grid-cols-4 gap-6 border-t p-6">
            @foreach($criminal_cases as $criminal_case)
                <div>
                    <div class="w-full aspect-video mb-4">
                        <a href="/criminal-cases/{{$criminal_case->hex}}">
                            @if($criminal_case->image)
                                <div class="w-full h-full bg-no-repeat bg-cover bg-center shadow-lg border border-gray-300" style="background-image:url('{{asset('images/criminal-cases/'.$criminal_case->hex.'/tn-'.$criminal_case->image)}}');"></div>
                            @else
                                <div class="bg-gradient-to-tr from-yellow-400 to-amber-100 h-full"></div>
                            @endif
                        </a>
                    </div>
                    
                    <div class="text-lg font-bold leading-5 tracking-tight mb-4">
                        <a href="/criminal-cases/{{$criminal_case->hex}}" class="no-underline px-0.5 py-0.5 block hover:bg-yellow-300 hover:text-gray-900">
                            {{$criminal_case->title}}
                        </a>
                        <span class="text-red-600 text-base">{{countArticles($criminal_case)}}</span>
                    </div>
                    
                </div>
            
            @endforeach
        </div>
    </div>
</x-layout>