@extends('layouts/app')
@section('class', 'home')

{{--@section('container-header')--}}
{{--<section class="hero is-light">--}}
{{--<div class="hero-body">--}}
{{--<div class="container">--}}
{{--<h1 class="title is-1">My Profile</h1>--}}
{{--                 <a class="home__plus" href="{{ route('visuals.create') }}">--}}
{{--<img src="{{ asset('assets/img/icons/user/plus.svg') }}" alt="Add Visual">--}}
{{--</a> --}}
{{--</div>--}}
{{--</div>--}}
{{--</section>--}}
{{--@endsection--}}
@section('content')
    <div class="section" id="app">
        <div class="columns">
            <div class="column is-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column">
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
