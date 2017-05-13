@extends('layouts.app')
@section('title', $visual->track)
@section('class', 'show-visual')

@section('control-bar')
    <div id="visual-edit" class="visual__edit">
        <div>
            <span class="visual__track">
                <b>Track:</b> {{ $visual->track }}
            </span> ∙

            <span class="visual__album">
              <b>Album:</b>  {{ $visual->album }}
            </span> ∙

            <span class="visual__artist">
               <b>Artist:</b> {{ $visual->artist }}
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
            <div class="column is-4">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Comments: {{ $visual->comments->count() }}</p>
                    </header>

                    <div class="card-content">
                        <div class="comments">
                            @include('comments.index')
                        </div>
                    </div>
                </div>
            </div>

            <div class="column is-8">
                <div class="relative">
                    @if ($visual->user_id !== auth()->id() && auth()->check())
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
                    <img src="{{ asset(getenv('APP_UPLOADS') . '/visuals/' . $visual->user_id . '/' . $visual->image) }}" alt="{{ $visual->track }}"
                    style="padding-bottom: 16px">
                </div>

                <div class="card">
                    <div class="card-content">
                        @include('visuals/partials/description')
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
