@extends('layouts.app')
@section('title', 'Latest Visuals')
@section('class', 'visuals-index')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Visuals' => 'visuals.index'])
@endsection

@section('content')
    <div class="section">
        <div class="columns is-multiline grid">
            @each ('visuals.partials.visual', $visuals, 'visual')
        </div>
        {{ $visuals->links() }}
        <flash message="{{ session('flash') }}"></flash>
    </div>
@endsection

@section('footer-js')
    @parent()
    <script>
        new Vue({ el: '.visuals-index' })
    </script>
@endsection
