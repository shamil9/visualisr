@extends('layouts.app')
@section('title', 'New Visual')

@section('control-bar')
    <div id="player">
        <player url="{{ route('visuals.store') }}"></player>
    </div>
    {{-- @include('visuals.partials.player') --}}
@endsection

@section('content')
    <div class="section">
        <canvas id="visualizer"></canvas>
    </div>
@endsection

@section('footer-js')
    @parent
    <script>
        new Vue({
            el: '#player',
        });
    </script>
@endsection