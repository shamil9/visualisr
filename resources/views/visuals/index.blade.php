@extends('layouts.app')
@section('title', 'Latest Visuals')

@section('container-header')
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-1">Visuals</h1>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="section">
        <div class="columns is-multiline">
            @each ('visuals.partials.visual', $visuals, 'visual')
        </div>
        {{ $visuals->links() }}
    </div>
@endsection
