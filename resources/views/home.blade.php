@extends('layouts/app')
@section('class', 'home')


@section('content')
    <div class="section" id="app">
        <div class="columns">
            <div class="column is-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column">
                <div class="columns is-multiline">
                    @each('visuals.partials.visual', $visuals, 'visual')
                    @unless ($visuals->count())
                        <div class="column is-centered has-text-centered">
                            <p>
                                <a href="{{ route('visuals.create') }}">Add</a>
                            </p>
                            <p class="title is-1">No visuals found</p>
                        </div>
                    @endunless
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
