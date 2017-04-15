@extends('layouts.app')
@section('title', 'New Visual')

@section('control-bar')
    <div id="player">
        <player>
            <manager url="{{ route('visuals.store') }}"></manager>
        </player>
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
        var playerControls = new Vue({
            el: '#player',
        });
    </script>
@endsection