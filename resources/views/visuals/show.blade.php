@extends('layouts.app')
@section('title', $visual->track)
@section('class', 'show-visual')

@section('breadcrumbs')
    <div class="is-hidden-mobile">
        @breadcrumbs(['Home' => 'index', 'Visuals' => 'visuals.index'])
    </div>
@endsection

@section('control-bar')
    <div id="visual-edit" class="visual__edit">
        <div class="is-hidden-mobile">
            <span class="visual__track">
                Track: <b>{{ $visual->track }}</b>
            </span> ∙

            <span class="visual__album">
              Album:  <b>{{ $visual->album }}</b>
            </span> ∙

            <span class="visual__artist">
               Artist: <b>{{ $visual->artist }}</b>
            </span>
        </div>

        @can('update', $visual)
            <div class="visual__save">
                <a href="#" @click.prevent="$emit('toggleModalEvent')">
                    <img src="{{ asset('assets/img/icons/user/edit.svg') }}" alt="Edit">
                </a>
            </div>

            <div class="visual__remove">
                <a href="#" @click.prevent="$emit('showDeleteModalEvent', 'visual-{{ $visual->id }}')">
                    <img src="{{ asset('assets/img/icons/user/trash.svg') }}" alt="Delete">
                </a>
            </div>

            <form ref="visual-{{ $visual->id }}" action="{{ route('visuals.destroy', ['visual' => $visual->id]) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
            </form>

            <div class="visual__private">
                Private:
                <label for="private" @change.stop="togglePrivate">
                    <input type="checkbox" id="private" :checked="private" /><span class="switch"></span><span class="toggle"></span>
                </label>
            </div>

            <delete-modal v-cloak></delete-modal>

            <manager
                url="{{ route('visuals.update', $visual) }}"
                :entity="{{ $visual }}">
            </manager>
        @endcan
    </div>
@endsection

@section('content')
    <section id="content">
        <div class="section">
            <div class="columns">
                <div class="column is-8">
                    <div class="message is-primary is-hidden-desktop">
                        <div class="message-body">
                            <p class="heading">Track: {{ $visual->track }}</p>
                            <p class="heading">Album: {{ $visual->album }}</p>
                            <p class="heading">Artist: {{ $visual->artist }}</p>

                            <hr>

                            <p class="heading">Average Rating: {{ $visual->rating or 'No ratings yet' }}</p>

                            <div class="columns is-mobile">
                                <div class="column">
                                    <p class="heading">Views: {{ $visual->views }}</p>
                                </div>

                                <div class="column">
                                    <p class="heading">Favorites: @{{ favoritesCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        @can('rate', $visual)
                            <div class="rating">
                                <rating
                                    :items="ratingItems"
                                    kind="grow"
                                    :value="ratingValue"
                                    @change="submitRating">
                                </rating>
                            </div>

                            <div class="favorite">
                                <button
                                    @click.prevent="toggleFavorite"
                                    class="favorite__button"
                                    :data-balloon="tooltipMessage"
                                    data-balloon-pos="left">
                                    <svg width="20px" height="20px" viewBox="0 0 83 71">
                                       <use
                                        :class="{'favorite--active': isActive}"
                                        class="favorite__heart" xlink:href="{{ asset('assets/img/icons/user/favorite.svg') }}#Default">
                                        </use>
                                    </svg>
                                </button>
                            </div>
                        @endif
                        <img src="{{ asset(\Storage::url('visuals/' . $visual->user_id . '/' . $visual->image)) }}" alt="{{ $visual->track }}"
                        style="padding-bottom: 16px">
                    </div>

                    <div class="card">
                        <div class="card-content">
                            @include('visuals/partials/description')
                        </div>
                    </div>
                </div>

                <div class="column is-4">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">Comments: {{ $visual->comments->count() }}</p>
                        </header>

                        <div class="card-content">
                            <div class="comments">
                                @include('comments.index')
                                @unless($visual->comments->count())
                                    <p class="has-text-centered color-grey-light">No comments yet</p>
                                @endunless
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </section>
@endsection

@section('footer-js')
@parent

@can('update', $visual)
    @include('visuals.partials.update-vue')
@endcan

@include('visuals.partials.show-vue')

@endsection
