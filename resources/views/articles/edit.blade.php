<x-layout>

    <style>
        .ck-editor__editable {
            min-height: 600px !important;
            margin-bottom: 3rem;
        }
    </style>

    
    <div class="container">
        <h1>Edit this article</h1>
        <h2>Update the article information accordingly and click Update article.</h2>

        <div class="grid grid-cols-1">
            <a href="/dashboard/articles/{{$article->hex}}/images/upload" class="btn btn-dark">
                Upload image
            </a>           
        </div>

        <form id="editArticleForm" action="/dashboard/articles/{{$article->hex}}/update" method="post" class="mx-auto w-4/5 mt-16 flex flex-col">
            @csrf
            
            {{-- Title --}}
            @error('title')
                <p class="form-error">
                    Enter a title
                </p>
            @enderror
            <input type="text" name="title" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Title" value="{{old('title')?:$article->title}}" autofocus>
            
            {{-- Caption --}}
            @error('caption')
                <p class="form-error">
                    Enter a caption
                </p>
            @enderror
            <input type="text" name="caption" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center" placeholder="Caption" value="{{old('caption')?:$article->caption}}">

            {{-- Criminal Case --}}
            @error('criminal_case_id')
                <p class="form-error">
                    Choose a criminal case for this article.
                </p>
            @enderror
            <select id="criminalCaseList" name="criminal_case_id" class="text-3xl text-thin text-gray-600 w-3/4 mx-auto">
                <option disabled selected class="text-center">Select a criminal case</option>
                @foreach ($criminal_cases as $criminal_case)
                    <option class="text-center" value="{{$criminal_case->id}}" {{$article->criminal_case_id == $criminal_case->id ? 'selected' : null}}>{{$criminal_case->title}}</option>
                @endforeach
            </select>

            <select id="topicList" class="text-3xl text-thin text-gray-600 w-3/4 mx-auto" name="topic_id" required disabled>
                <option disabled selected class="text-center">Select a topic</option>
                @foreach ($topics as $topic)
                    <option value="{{ $topic->id }}" class='parent-{{ $topic->criminal_case_id }} topics'>{{ $topic->title }}</option>
                @endforeach
            </select>

            <script>
                var criminalCaseList = document.querySelector('#criminalCaseList');
                var topicList = document.querySelector('#topicList');
                var topics = document.querySelectorAll('.topics');

                criminalCaseList.addEventListener('change', function(){
                    var selectedCriminalCase = criminalCaseList.options[criminalCaseList.selectedIndex].value;

                    // Enable topicList <select>
                    topicList.disabled = false;
                    
                    // Disable and hide all topic <select> options
                    topics.forEach(e => {
                        e.disabled = true;
                        e.classList.add('hidden');
                    });

                    // Show and enable topics for this criminal case
                    var theseTopics = document.querySelectorAll('.parent-' + selectedCriminalCase);
                        theseTopics.forEach(e => {
                        e.disabled = false;
                        e.classList.remove('hidden');
                    });
                });
            </script>

            {{-- Body --}}
            @error('body')
                <p class="form-error">
                    Enter a content for the article body
                </p>
            @enderror
            {{-- <textarea name="body" class="w-full text-3xl text-thin placeholder-gray-300 placeholder-thin text-center !mb-20" placeholder="Article body"></textarea> --}}
            {{-- <textarea id="editor">True Crime Metrix</textarea>  --}}
            <div class="article-body mx-0">
                <textarea id="editor" name="body">
                    {!!$article->body!!}
                </textarea>
            </div>



            <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ), {
                        ckfinder: {
                            uploadUrl: '/dashboard/articles/{{$article->hex}}/upload-article-images?_token={{csrf_token()}}',
                        }
                    })
                    .catch( error => {
                        // console.error( error );
                    } );
            </script>

            {{-- Status --}}
            @error('status')
                <p class="form-error">
                    Choose a status for the article.
                </p>
            @enderror
            <select name="status" class="text-3xl text-thin text-gray-600 w-2/5 mx-auto mb-20">
                <option value="private" {{$article->status == 'private' ? 'selected' : null}}>Private</option>
                <option value="public" {{$article->status == 'public' ? 'selected' : null}}>Public</option>
            </select>

            <div class="flex justify-center">
                <button type="submit" class="btn btn-dark">Update article</button>
            </div>

            

            
        </form>
    </div>

</x-layout>