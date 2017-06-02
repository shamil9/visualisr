@extends('layouts.app')
@section('title', 'User list')
@section('class', 'users')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Profile' => 'user.home'])
@endsection

@section('content')
    <section class="section">
        <div class="columns">
            <a class="is-hidden-tablet" href="{{ route('user.home') }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <div class="column is-2 is-hidden-mobile">
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
        <delete-modal v-cloak></delete-modal>
    </section>
@endsection
@section('footer-js')
    @parent
    <script>
        new Vue({
            el: '.users',
            methods: {
                submit: function ( event ) {
                    event.target.parentNode.submit();
                }
            }
        });
    </script>
@endsection
