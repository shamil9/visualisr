@extends('layouts.app')
@section('title', $user->name)

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Users' => 'users.index'])
@endsection

@section('container-header')
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <div class="media">
                            <div class="media-left">
                                <figure class="user__avatar image is-48x48">
                                    <img src="{{ asset(\Storage::url('avatars/' . $user->avatar)) }}"
                                         alt="{{ $user->name }}">
                                </figure>
                            </div>
                            <div class="media-content">
                                <h1 class="title user__name">{{ $user->name }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="level is-mobile">
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
                        </div>
                    </div>
                </div>
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
