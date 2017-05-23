@extends('layouts/app')
@section('class', 'home')


@section('content')
    <div class="section" id="app">
        <div class="columns">
            <div class="column is-2">
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
