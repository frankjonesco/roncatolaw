<x-layout>
    <div class="container">
        <h1>Upload an image to this article</h1>
        <h2 class="mb-20">Accepted files formats: jpg, png, svg, webp. Max filesize 2 MB.</h2>
        <form id="form" action="/dashboard/articles/{{$article->hex}}/images/upload" method="POST" enctype="multipart/form-data" class="flex justify-center">
            @csrf
            <div class="form-block">
                <input aria-describedby="image_help" id="image" name="image" type="file" class="btn btn-dark">
                @error('image')
                    <p class="text-error">{{$message}}</p>
                @enderror
            </div>
        </form>
        <script>
            document.getElementById("image").onchange = function() {
                document.getElementById("form").submit();
            };
        </script>
    </div>
</x-layout>