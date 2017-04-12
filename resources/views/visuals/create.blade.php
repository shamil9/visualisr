@extends('layouts.app')
@section('title', 'New Visual')

@section('control-bar')
    @include('visuals.partials.player')
@endsection

@section('content')
    <div class="section">
        <canvas id="visualizer"></canvas>
    </div>
@endsection

@section('footer-js')
    @parent
    <script src="{{ mix('assets/js/player.js') }}"></script>
@endsection