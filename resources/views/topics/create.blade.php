<x-layout>
    
    <div class="container">
        <h1>Create a new topic</h1>
        <h2>Add some information.</h2>

        <form id="editTopicForm" action="/dashboard/topics/store" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf

            {{-- Category --}}
            @error('category')
                <p class="form-error">
                    Choose a category for this topic.
                </p>
            @enderror
            <select name="category_id" class="text-3xl text-thin text-gray-600 w-2/5 mx-auto mb-10 text-center">
                <option disabled selected>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : null}}>{{$category->title}}</option>
                @endforeach
            </select>
            
            {{-- Title --}}
            @error('title')
                <p class="form-error">
                    Enter a title
                </p>
            @enderror
            <input type="text" name="title" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Title" value="{{old('title')}}">

            {{-- Caption --}}
            @error('caption')
                <p class="form-error">
                    Enter a caption
                </p>
            @enderror
            <input type="text" name="caption" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Caption" value="{{old('caption')}}">

            {{-- Status --}}
            @error('status')
                <p class="form-error">
                    Choose a status for the topic.
                </p>
            @enderror
            <select name="status" class="text-3xl text-thin text-gray-600 w-2/5 text-center mx-auto mb-20">
                <option value="private" {{old('status') == 'private' ? 'selected' : null}}>Private</option>
                <option value="public" {{old('status') == 'public' ? 'selected' : null}}>Public</option>
            </select>

            <div class="flex flex-col justify-center">
                <button type="submit" class="btn btn-dark">Create topic</button>
                <a href="/dashboard/topics" class="mx-auto"><button type="button" class="btn btn-red">Cancel</button></a>
            </div>
            

            

            
        </form>
    </div>

    
</x-layout>