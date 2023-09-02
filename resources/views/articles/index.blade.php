<x-layout>
    <div class="container">
        <h1>News Articles</h1>
        <h2>Browse news articles on {{config('app.name')}}.</h2>

        <form id="editCriminalCaseForm" action="#" method="post" class="mx-auto w-3/5 mt-16 flex flex-col">
            @csrf

            @include('includes/category-topic-lists')

        </form>

        <x-articles-grid :articles="$articles" />
    </div>
</x-layout>