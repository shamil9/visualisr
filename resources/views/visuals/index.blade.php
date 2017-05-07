@extends('layouts.app')
@section('title', 'Latest Visuals')
@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Visuals' => 'visuals.index'])
@endsection

@section('content')
    <div class="section">
        <div class="columns is-multiline grid">
            @each ('visuals.partials.visual', $visuals, 'visual')
        </div>
        {{ $visuals->links() }}
    </div>
@endsection
