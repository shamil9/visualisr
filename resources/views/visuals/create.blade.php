@extends('layouts.app')
@section('title', 'New Visual')
@section('class', 'create-visual')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Visuals' => 'visuals.index'])
@stop

@section('control-bar')
    <player url="{{ route('visuals.store') }}"></player>
@endsection

@section('content')
    <div class="section relative">
        <div class="file is-flex-centered"
            v-show="showDropArea"
            @drop.stop.prevent="checkFormat"
            @dragover.stop.prevent="dragOver">
            @{{ message }}
            <img src="{{ asset('/assets/img/icons/file.png') }}" alt="Drop File"> <br>
        </div>
        <div id="visualizer">
        </div>
    </div>
@endsection

@section('footer-js')
    @parent
    <script src="{{ mix('assets/js/player.js') }}"></script>
    <script>
        new Vue({
            el: '.create-visual',
            data: {
                showDropArea: true,
                song: null,
                format: null,
                message: 'Drop Your Song Here',
                fileTypes: ['audio/mp3', 'audio/wav', 'audio/aac', 'audio/webm', 'audio/ogg', 'audio/flac']
            },
            methods:{
                changeSong: function(file) {
                    this.format = file.type;
                    this.song = URL.createObjectURL(file);
                    this.text = file.name;
                    this.showDropArea = false;

                    EventBus.$emit('changeSongEvent');
                },
                checkFormat(event) {
                    var files = event.target.files || event.dataTransfer.files;

                    if (/^(audio)/.test(files[0].type)) {
                        this.changeSong(files[0]);
                    } else {
                        this.message = 'Invalid File Format.';
                    }

                },
                dragOver: function(event) {
                    event.dataTransfer.dropEffect = 'copy';
                }
            }
        });
    </script>
@endsection
