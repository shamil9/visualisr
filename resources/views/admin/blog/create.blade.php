@extends('layouts.app')
@section('title', 'Add Blog')
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column is-8">
                <form method="post"
                      action="{{
                    isset($blog) ?
                    route('blog.update', $blog) :
                    route('blog.store')
                  }}">

                    {{ csrf_field() }}
                    {{ method_field(isset($blog) ? 'patch' : 'post') }}

                    @if (isset($blog))
                        <span class="pull-right">
                        <button id="delete" class="button is-small is-danger">Delete</button>
                    </span>
                    @endif

                    <div class="field">
                        <label class="label">Title</label>
                        <p class="control">
                            <input class="input" name="title" type="text" placeholder="Title"
                                   value="{{ $blog->title or old('title') }}">
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Content</label>
                        <p class="control">
                        <textarea id="editor" class="textarea" name="body"
                                  placeholder="Content">{{ $blog->body or old('body') }}</textarea>
                        </p>
                    </div>

                    <p class="control">
                        <button type="submit" class="button is-primary">Submit</button>
                    </p>
                </form>
            </div>
        </div>

        @if (isset($blog))
            <form id="delete-form" action="{{ route('blog.destroy', $blog) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            </form>
        @endif
    </section>
@endsection

@section('footer-js')
    @parent
    <script src="{{ asset('assets/js/admin.js') }}"></script>
@endsection
