<x-layout>
    <div class="container">
        <h1>Dashboard</h1>
        <h2>Manage the content on {{config('app.name')}}.</h2>

        <div class="flex flex-col mt-12">
            <a href="/dashboard/categories" class="btn btn-dark">
                Categories
            </a>
            <a href="/dashboard/topics" class="btn btn-dark">
                Topics
            </a>
            <a href="/dashboard/articles" class="btn btn-dark">
                Articles
            </a>
            <a href="/dashboard/partners" class="btn btn-dark">
                Partners
            </a>
            <a href="/dashboard/testimonials" class="btn btn-dark">
                Testimonials
            </a>
        </div>
    </div>
</x-layout>