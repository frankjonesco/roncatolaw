<x-layout>
    <div class="container">
        <h1>Contact us</h1>
        <h2>Send us a message and we will get right back to you.</h2>

        <form action="/contact/send" method="POST" class="mx-auto w-3/5 mt-16 flex flex-col">

            @csrf

            {{-- Name --}}
            @error('name')
                <p class="form-error">
                    Enter your name
                </p>
            @enderror
            <input type="text" name="name" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Your name" value="{{old('name')}}" autofocus>

            {{-- Email --}}
            @error('email')
                <p class="form-error">
                    Enter your email
                </p>
            @enderror
            <input type="email" name="email" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Your email" value="{{old('email')}}" >

            {{-- Phone --}}
            @error('name')
                <p class="form-error">
                    Enter your phone number
                </p>
            @enderror
            <input type="text" name="phone" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Your phone number" value="{{old('phone')}}" >

            {{-- Subject --}}
            @error('subject')
                <p class="form-error">
                    Enter a subject for your message
                </p>
            @enderror
            <input type="text" name="subject" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Subject" value="{{old('subject')}}" >

            {{-- Message --}}
            @error('message')
                <p class="form-error">
                    Enter your message
                </p>
            @enderror
            <textarea name="message" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Message"></textarea>

            <button type="submit" class="btn btn-dark">Send message</button>

        </form>
    </div>
</x-layout>