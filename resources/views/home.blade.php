@extends('layouts/app')
@section('class', 'home')
@section('content')
    <div class="section">
        <div class="columns home__title">
            <div class="column">
                <h1 class="title is-1">My Visuals</h1>
            </div>
            <div class="column">
                <div class="home__plus is-pulled-right">
                    <a href="{{ route('visuals.create') }}">
                        <img src="{{ asset('assets/img/icons/user/plus.svg') }}" alt="Add Visual">
                    </a>
                </div>
            </div>
        </div>
        <div class="columns is-multiline">
            @each('visuals.partials.visual', $user->visuals, 'visual')
        </div>
    </div>
@endsection
