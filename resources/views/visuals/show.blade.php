@extends('layouts.app')
@section('title', $visual->track)

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
                    <a href="#" @click.prevent="toggleModal">
                    <img src="{{ asset('assets/img/icons/user/trash.svg') }}" alt="Delete">
                </a>
            </div>
            <div class="visual__private">
                Private:
                <label for="private" @change.stop="togglePrivate">
                    <input type="checkbox" id="private" :checked="private" /><span class="switch"></span><span class="toggle"></span>
                </label>
            </div>

            <modal v-show="showDeleteModal" v-cloak>
                <div class="modal-card">
                    <div class="modal-cotent">
                        <article class="message is-danger">
                            <div class="message-header">
                                <p><strong>Danger</strong>!</p>
                            </div>
                            <div class="message-body">
                                <p class="title is-2 is-danger">Delete visual?</p>
                                <button class="button is-danger" @click.prevent="submit">Delete</button>
                                <button @click.prevent="toggleModal" class="button">Cancel</button>
                            </div>
                        </article>
                    </div>
                </div>
            </modal>

            <manager
                url="{{ route('visuals.update', $visual) }}"
                track="{{ $visual->track }}"
                album="{{ $visual->album }}"
                artist="{{ $visual->artist }}">
            </manager>
        @endcan
    </div>
@endsection

@section('content')
    <div class="section" id="content">
        <div class="visual relative">
            @unless($visual->user_id === auth()->id())
                <div class="favorite">
                    <button
                        @click.prevent="submit"
                        class="favorite__button"
                        :data-balloon="'Favorites: ' + favoriteCount"
                        data-balloon-pos="left">
                        <svg width="20px" height="20px" viewBox="0 0 83 71">
                           <use
                            :class="{'favorite--active': isActive}"
                            class="favorite__heart" xlink:href="{{ asset('assets/img/icons/user/favorite.svg') }}#Default"></use>
                        </svg>
                    </button>
                </div>
            @endunless
            <img src="{{ asset('uploads/visuals/' . $visual->user_id . '/' . $visual->image) }}" alt="{{ $visual->track }}">
        </div>

        @can('delete', $visual)
            <form id="delete-form" action="{{ route('visuals.destroy', ['visual' => $visual->id]) }}" method="POST" style="display: none;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
            </form>
        @endcan
    </div>
@endsection

@section('footer-js')
@parent
@can('update', $visual)
    @include('visuals.partials.update-vue')
@endcan
@include('visuals.partials.show-vue')
@endsection