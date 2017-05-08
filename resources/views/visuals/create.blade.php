@extends('layouts.app')
@section('title', 'New Visual')

@section('control-bar')
    <div id="player">
        <player url="{{ route('visuals.store') }}"></player>

        <div class="file has-text-centered"
            @drop.stop.prevent="changeSong"
            @dragover.stop.prevent="dragOver">
            <img src="{{ asset('/assets/img/icons/file.png') }}" alt="Drop File"> @{{ text }}
        </div>
    </div>
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
            data: {
                text: 'Drop Your Song Here',
                song: null,
            },
            methods:{
                changeSong: function(event) {
                    var files = event.target.files || event.dataTransfer.files;
                    this.song = URL.createObjectURL(files[0]);
                    this.text = files[0].name;
                    EventBus.$emit('changeSongEvent');
                },
                dragOver: function(event) {
                    event.dataTransfer.dropEffect = 'copy';
                }
            }
        });
    </script>
@endsection
