@extends('layouts.app')
@section('title', 'Visual 1')

@section('control-bar')
    @include('visuals.partials.player')
@endsection

@section('content')
    <div class="visualiser">
        <canvas id="visualizer"></canvas>
    </div>
@endsection

@section('footer-js')
    @parent
    <script src="{{ mix('assets/js/player.js') }}"></script>
{{--    <script src="{{ mix('assets/js/visual.js') }}"></script>--}}
@endsection