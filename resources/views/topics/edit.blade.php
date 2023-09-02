<x-layout>
    
    <div class="container">
        <h1>Edit this topic</h1>
        <h2>Update the topic information accordingly and click Update topic.</h2>

        <div class="grid grid-cols-1">
            <a href="/dashboard/topics/{{$topic->hex}}/images/upload" class="btn btn-dark">
                Upload image
            </a>           
        </div>

        <form id="editTopicForm" action="/dashboard/topics/{{$topic->hex}}/update" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf

            {{-- Category --}}
            @error('category_id')
                <p class="form-error">
                    Choose a category for this topic.
                </p>
            @enderror
            <select name="category_id" class="text-3xl text-thin text-gray-600 w-2/5 mx-auto">
                <option disabled selected>Select a category</option>
                @foreach ($categories as $category)
                    <option class="text-center" value="{{$category->id}}" {{$topic->category_id == $category->id ? 'selected' : null}}>{{$category->title}}</option>
                @endforeach
            </select>
            
            {{-- Title --}}
            @error('title')
                <p class="form-error">
                    Enter a title
                </p>
            @enderror
            <input type="text" name="title" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Title" value="{{old('title')?:$topic->title}}">

            {{-- Caption --}}
            @error('title')
                <p class="form-error">
                    Enter a caption
                </p>
            @enderror
            <input type="text" name="caption" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Caption" value="{{old('caption')?:$topic->caption}}">

            {{-- Status --}}
            @error('status')
                <p class="form-error">
                    Choose a status for the topic.
                </p>
            @enderror
            <select name="status" class="text-3xl text-thin text-gray-600 w-2/5 mx-auto mb-20 text-center">
                <option class="text-center" value="private" {{$topic->status == 'private' ? 'selected' : null}}>Private</option>
                <option class="text-center" value="public" {{$topic->status == 'public' ? 'selected' : null}}>Public</option>
            </select>

            <div class="flex flex-col justify-center">
                <button type="submit" class="btn btn-dark">Update topic</button>
                <a href="/dashboard/topics" class="mx-auto"><button type="button" class="btn btn-red">Cancel</button></a>
            </div>

            

            
        </form>
    </div>

    
</x-layout>