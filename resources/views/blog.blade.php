@extends('layouts.app')
@section('title', 'Blog')
@section('class', 'blog')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Blog' => 'blog.index'])
@endsection

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-8 is-offset-2 card">
                <div class="card-content">
                    @foreach($blogs as $blog)
                        <article class="content">
                            @can('update', App\Blog::class)
                                <div class="pull-right">
                                    <a class="button is-warning" href="{{ route('blog.edit', $blog) }}">Edit</a>
                                </div>
                            @endcan
                            <header class="title">{{ $blog->title }}</header>
                            <h3 class="subtitle is-6 blog__subtitle">
                                By {{ $blog->user->name . ' ' . $blog->created_at->diffForhumans() }}
                            </h3>
                            <div class="blog__content">
                                @markdown($blog->body)
                            </div>
                        </article>
                        @unless ($loop->last)
                            <hr>
                        @endunless
                    @endforeach
                </div>
                <flash message="{{ session('flash') }}"></flash>
            </div>
        </div>
        <div class="columns">
            <div class="column is-8 is-offset-2">
                <div class="section">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer-js')
    @parent
    <script>
        new Vue({ el: '.blog' });
    </script>
@endsection
