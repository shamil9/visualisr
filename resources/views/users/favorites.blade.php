@extends('layouts/app')
@section('class', 'home')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Profile' => 'user.home'])
@endsection

@section('content')
    <div class="section" id="app">
        <div class="columns">
            <a class="is-hidden-tablet" href="{{ route('user.home') }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <div class="column is-2 is-hidden-mobile">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column">
                @unless ($visuals->count())
                    <div class="is-flex-centered has-text-centered">
                        <p class="title is-1 color-grey-light">No Favorites Found</p>
                    </div>
                @endunless
                <div class="columns is-multiline">
                    @each('visuals.partials.visual', $visuals, 'visual')
                </div>
            </div>
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </div>
@endsection
@section('footer-js')
@parent
<script>
    new Vue({
        el: '#app'
    });
</script>
@endsection
