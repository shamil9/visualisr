@extends('layouts.app')
@section('title', 'Blog')

@section('container-header')
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Blog</h1>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="blog">
        <div class="columns">
            <div class="column is-9 card">
                <div class="card-content">
                    @foreach($blogs as $blog)
                        <article class="content">
                            <header class="title">{{ $blog->title }}</header>
                            <h3 class="subtitle is-6 blog__subtitle">
                                By {{ $blog->user->name . ' ' . $blog->created_at->diffForhumans() }}
                            </h3>
                            <div class="blog__content">
                                @markdown($blog->body)
                                @can('update', App\Blog::class)
                                    <a class="button is-warning" href="{{ route('blog.edit', $blog) }}">Edit</a>
                                @endcan
                            </div>
                        </article>
                    @endforeach
                </div>
                <flash message="{{ session('flash') }}"></flash>
            </div>
            <aside class="column is-3 blog__aside">
                <nav class="panel">
                    <p class="panel-heading">Archive</p>
                    <div class="panel-block">
                        <p class="control">
                            <input class="input is-small" type="text" placeholder="Search">
                        </p>
                    </div>

                    <a class="panel-block is-active">2017 <span class="blog__articles-count">(20 Articles)</span></a>
                    <a class="panel-block">2016 <span class="blog__articles-count">(15 Articles)</span></a>
                </nav>
            </aside>
        </div>
        <div class="columns">
            <div class="column is-9">
                <div class="section">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    @parent
    <script>
        new Vue({ el: '.blog' });
    </script>
@endsection