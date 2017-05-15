@extends('layouts.app')
@section('title', $user->name)

@section('container-header')
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <nav class="level">
                    <div class="level-item">
                        <figure class="user__avatar image is-48x48">
                            <img src="{{ asset(\Storage::url('avatars/' . $user->avatar)) }}"
                                 alt="{{ $user->name }}">
                        </figure>
                        <h1 class="title">{{ $user->name }}</h1>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Visuals</p>
                            <p class="title">{{ $user->visuals->count() }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Favorites</p>
                            <p class="title">{{ $user->favorites->count() }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Likes</p>
                            <p class="title">{{ $likes }}</p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="section">
        <div class="columns is-multiline">
            @each('visuals.partials.visual', $user->visuals, 'visual')
        </div>
    </section>
@endsection
