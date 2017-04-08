@extends('layouts/app')
@section('control-bar')
    <span class="icon">
        <img src="{{ asset('assets/img/icons/confirm.svg') }}" alt="Confirm">
    </span>
    <span class="icon">
        <img src="{{ asset('assets/img/icons/trash.svg') }}" alt="Confirm">
    </span>
@stop

@section('class', 'home')
@section('content')
    <div class="columns">
        <div class="column is-12">
            <h1 class="title is-1 user__home">My Visuals</h1>
            <hr>
            <div class="columns is-multiline">
                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>

                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>

                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>

                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>

                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>

                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>

                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>

                <div class="column is-3">
                    <div class="visual">
                        <div class="front">
                            <img src="{{ url('assets/img/wave.jpg') }}" alt="Visual">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
