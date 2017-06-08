@extends('layouts.app')
@section('title', 'Latest Visuals')
@section('class', 'visuals-index')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Visuals' => 'visuals.index'])
@endsection

@section('content')
    <div class="section">
        <div class="sort-visuals has-text-right">
            <i class="fa fa-sort-amount-desc" aria-hidden="true" style="vertical-align: baseline"></i>
            <a href="{{ route('visuals.ratings') }}" class="@activeClass('visuals.ratings')">Rating</a> ∙
            <a href="{{ route('visuals.views') }}" class="@activeClass('visuals.views')">Views</a>
        </div>
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
