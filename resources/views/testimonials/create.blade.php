<x-layout>

    <style>
        .ck-editor__editable {
            min-height: 600px !important;
            margin-bottom: 3rem;
        }
    </style>

    
    <div class="container">
        <h1>Create a new testimonial</h1>
        <h2>Add some information.</h2>
        <form id="createTestimonialForm" action="/dashboard/testimonials/store" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf

            {{-- First name --}}
            @error('first_name')
                <p class="form-error">
                    Enter a first name
                </p>
            @enderror
            <input type="text" name="first_name" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="First name" value="{{old('first_name')}}" autofocus>

            {{-- Last name --}}
            @error('last_name')
                <p class="form-error">
                    Enter a last name
                </p>
            @enderror
            <input type="text" name="last_name" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Last name" value="{{old('last_name')}}">

            {{-- Job title --}}
            @error('job_title')
                <p class="form-error">
                    Enter a job title
                </p>
            @enderror
            <input type="text" name="job_title" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Job title" value="{{old('job_title')}}">

            {{-- Company name --}}
            @error('company_name')
                <p class="form-error">
                    Enter a job title
                </p>
            @enderror
            <input type="text" name="company_name" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Company name" value="{{old('company_name')}}">
            
            {{-- Testimonial --}}
            @error('testimonial')
                <p class="form-error">
                    Enter a testimonial comment
                </p>
            @enderror
            <textarea name="testimonial" id="testimonial" cols="30" rows="10" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center !mb-12" placeholder="Testimonial">{{old('testimonial')}}</textarea>

            {{-- Status --}}
            @error('status')
                <p class="form-error">
                    Choose a status for the testimonial
                </p>
            @enderror
            <select name="status" class="text-3xl text-thin text-gray-600 w-2/5 mx-auto mb-20">
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>

            <div class="flex flex-col justify-center">
                <button type="submit" class="btn btn-dark">Create testimonial</button>
                <a href="/dashboard/testimonials" class="mx-auto"><button type="button" class="btn btn-red">Cancel</button></a>
            </div>

        </form>
    </div>
</x-layout>