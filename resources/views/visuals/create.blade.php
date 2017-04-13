@extends('layouts.app')
@section('title', 'New Visual')

@section('control-bar')
    @include('visuals.partials.player')
@endsection

@section('content')
    <form action="POST" id="visual-form">
        <div class="columns">
            <div class="column">
                <input placeholder="Track" type="text" id="visual-track" name="track">
            </div>
            <div class="column">
                <input placeholder="Artist" type="text" id="visual-artist" name="artist">
            </div>
            <div class="column">
                <input placeholder="Album" type="text" id="visual-album" name="album">
            </div>
        </div>
    </form>
    <div class="section">
        <canvas id="visualizer"></canvas>
    </div>
@endsection

@section('footer-js')
    @parent
    <script>
        $(document).ready(function() {
            new Player();
            new VisualManager('{{ route('visuals.store') }}');
        });
    </script>
@endsection