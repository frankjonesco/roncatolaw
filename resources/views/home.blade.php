<x-layout>
    <x-container>
        <h1>Welcome to the Roncato site.</h1>

        <p class="text-4xl font-thin w-4/5 text-center mx-auto mb-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

        <div class="mx-auto flex gap-5 justify-center mb-10">
            <div class="">
                <a href="#" class="btn btn-dark self-end">Find out more</a>
            </div>
            <div class="">
                <a href="#" class="btn btn-light">Contact us</a>
            </div>
        </div>
    </x-container>



    <section id="our-partners" class="bg-gradient-to-tr from-pink-500 to-purple-900">
        <div class="container">
            <h1 class="text-white">Our partners</h1>

            <div class="grid grid-cols-3 gap-16 mb-12">
                @foreach ($partners as $partner)
                    <div class="rounded-lg h-[576px] flex flex-col justify-end">
                        @if($partner->image)
                            <div class="w-full h-full bg-no-repeat bg-cover bg-top rounded-lg" style="background-image:url('{{asset('images/partners/'.$partner->hex.'/'.$partner->image)}}');"></div>
                        @else
                            <div class="bg-gradient-to-tr from-cyan-400 to-teal-200 h-full"></div>
                        @endif
                        <div class="bg-white h-[120px] rounded-lg text-center flex flex-col justify-center mt-2">
                            <p class="text-3xl font-extrabold">{{$partner->full_name()}}</p>
                            <p class="text-xl font-extrabold text-orange-700">{{$partner->job_title}}</p>
                        </div>
                    </div>
                @endforeach

                {{-- @foreach ($partners as $partner)
                    <div class="text-center bg-white p-16">
                        @if($partner->image)
                            <img class="w-3/4 mx-auto h-full bg-no-repeat bg-cover bg-center" src="{{asset('images/partners/'.$partner->hex.'/'.$partner->image)}}">
                        @else
                            <div class="bg-gradient-to-tr from-cyan-400 to-teal-200 h-full"></div>
                        @endif
                        <p class="">{{$partner->full_name()}}</p>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </section>



    <section id="testimonials" class="bg-gradient-to-tr">
        <div class="container">
            <h1 class="">What people say about us</h1>
            <div class="grid grid-cols-3 gap-16 mb-12">
                @foreach ($testimonials as $testimonial)
                    <div class="flex flex-col items-center">
                        <img src="{{asset('images/testimonials/'.$testimonial->hex.'/'.$testimonial->image)}}" alt="" class="rounded-full w-1/2 mx-auto border-2 border-green-500 p-0.5">
                        <p>{{$testimonial->full_name()}}</p>
                        <p>{{$testimonial->job_title}}</p>
                        <p>{{$testimonial->company_name}}</p>
                        <span>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                        </span>
                        <p class="text-center">{{$testimonial->testimonial}}</p>
                    </div>
                   
                @endforeach
            </div>
        </div>
    </section>
    
</x-layout>