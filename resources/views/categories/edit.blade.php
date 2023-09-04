<x-layout>

    <style>
        .ck-editor__editable {
            min-height: 600px !important;
            margin-bottom: 3rem;
        }
    </style>

    
    <div class="container">
        <h1>Edit this category</h1>
        <h2>Edit the information for this category and click Update.</h2>

        <div class="grid grid-cols-1">
            <a href="/dashboard/categories/{{$category->hex}}/images/upload" class="btn btn-dark">
                Upload image
            </a>           
        </div>

        <form id="editCriminalCaseForm" action="/dashboard/categories/{{$category->hex}}/update" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf
            
            {{-- Title --}}
            @error('title')
                <p class="form-error">
                    Enter a title
                </p>
            @enderror
            <input type="text" name="title" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Title" value="{{old('title')?:$category->title}}" autofocus>

            {{-- Caption --}}
            @error('title')
                <p class="form-error">
                    Enter a caption
                </p>
            @enderror
            <input type="text" name="caption" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Caption" value="{{old('caption')?:$category->caption}}">

            {{-- Status --}}
            @error('status')
                <p class="form-error">
                    Choose a status for the categories.
                </p>
            @enderror
            <select name="status" class="text-3xl text-thin text-gray-600 w-2/5 mx-auto mb-20 text-center">
                <option value="private" {{$category->status == 'private' ? 'selected' : null}}>Private</option>
                <option value="public" {{$category->status == 'public' ? 'selected' : null}}>Public</option>
            </select>

            <div class="flex flex-col justify-center">
                <button type="submit" class="btn btn-dark">Update category</button>
                <a href="/dashboard/categories" class="mx-auto"><button type="button" class="btn btn-red">Cancel</button></a>
            </div>

            

            
        </form>
    </div>

    
</x-layout>