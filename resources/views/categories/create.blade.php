<x-layout>

    <style>
        .ck-editor__editable {
            min-height: 600px !important;
            margin-bottom: 3rem;
        }
    </style>

    
    <div class="container">
        <h1>Create a new category</h1>
        <h2>Add some information.</h2>
        <form id="createCriminalForm" action="/dashboard/categories/store" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf

            {{-- Title --}}
            @error('title')
                <p class="form-error">
                    Enter a title
                </p>
            @enderror
            <input type="text" name="title" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Title" value="{{old('title')}}" autofocus>
            
            {{-- Caption --}}
            @error('caption')
                <p class="form-error">
                    Enter a caption
                </p>
            @enderror
            <input type="text" name="caption" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center !mb-12" placeholder="Caption" value="{{old('title')}}">

            {{-- Status --}}
            @error('status')
                <p class="form-error">
                    Choose a status for the category
                </p>
            @enderror
            <select name="status" class="text-3xl text-thin text-gray-600 w-2/5 mx-auto mb-20">
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>

            <div class="flex flex-col justify-center">
                <button type="submit" class="btn btn-dark">Create category</button>
                <a href="/dashboard/categories" class="mx-auto"><button type="button" class="btn btn-red">Cancel</button></a>
            </div>

        </form>
    </div>
</x-layout>