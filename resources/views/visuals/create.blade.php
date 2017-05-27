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
            @drop.stop.prevent="changeSong"
            @dragover.stop.prevent="dragOver">
            Drop Your Song Here
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
            },
            methods:{
                changeSong: function(event) {
                    var files = event.target.files || event.dataTransfer.files;
                    this.song = URL.createObjectURL(files[0]);
                    this.text = files[0].name;
                    this.showDropArea = false;
                    EventBus.$emit('changeSongEvent');
                },
                dragOver: function(event) {
                    event.dataTransfer.dropEffect = 'copy';
                }
            }
        });
    </script>
@endsection
