@extends('layouts.app')
@section('title', 'Latest Visuals')

@section('content')
    <div class="section">
        <div class="columns is-multiline">
            @each ('visuals.partials.visual', $visuals, 'visual')
        </div>
        {{ $visuals->links() }}
    </div>
@endsection
