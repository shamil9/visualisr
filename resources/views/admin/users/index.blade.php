@extends('layouts.app')
@section('title', 'User list')
@section('class', 'users')

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column">
                <div class="columns is-multiline">
                    @each('admin.users.partials.user', $users, 'user')
                </div>
                {{ $users->links() }}
            </div>
        </div>
        <flash message="{{ session('flash') }}"></flash>
    </section>
@endsection
@section('footer-js')
    @parent
    <script>
        new Vue({
            el:      '.users',
            methods: {
                submit: function ( event ) {
                    event.preventDefault();
                    event.target.parentNode.submit();
                }
            }
        });
    </script>
@endsection
