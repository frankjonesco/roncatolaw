<x-layout>
    <div class="container">
        <h1>Partners</h1>
        <h2>Manage the partners on {{config('app.name')}}.</h2>

        <div class="grid grid-cols-1 mb-10">
            <a href="/dashboard/partners/create" class="btn btn-dark">
                Create partner
            </a>
        </div>

        <div class="grid grid-cols-4 gap-6 border-t p-6">
            @foreach($partners as $partner)
                <div>
                    {{-- <div class="w-full aspect-video mb-4">
                        @if($partner->image)
                            <div class="w-full h-full bg-no-repeat bg-cover bg-center" style="background-image:url('{{asset('images/partners/'.$partner->hex.'/tn-'.$partner->image)}}');"></div>
                        @else
                            <div class="bg-gradient-to-tr from-cyan-400 to-teal-200 h-full"></div>
                        @endif
                    </div> --}}

                    <div class="w-full mb-4">
                        @if($partner->image)
                            <img class="w-full h-full bg-no-repeat bg-cover bg-center" src="{{asset('images/partners/'.$partner->hex.'/'.$partner->image)}}">
                        @else
                            <div class="bg-gradient-to-tr from-cyan-400 to-teal-200 h-full"></div>
                        @endif
                    </div>
                    
                    <div class="font-bold leading-5 mb-2">{{$partner->full_name()}}</div>
                    <div class="font-bold !text-emerald-500 text-sm leading-5 mb-4">{{$partner->job_title}}</div>
                    <div>
                        <a href="/dashboard/partners/{{$partner->hex}}/edit" class="btn btn-dark btn-sm">
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>