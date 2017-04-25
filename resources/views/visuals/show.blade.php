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
                    <div class="modal-content">
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
<section id="content">
    <div class="section">
        <div class="relative">
            @unless($visual->user_id === auth()->id())
                <div class="favorite">
                    <button
                        @click.prevent="submit"
                        class="favorite__button"
                        :data-balloon="tooltipMessage"
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
    <div class="section">
        <div class="columns">
            <div class="column is-4">
                <div class="box stats">
                    <div class="columns is-multiline">
                        <div class="column is-6"><span class="title is-4">Note:</span></div>
                        <div class="column is-6 has-text-right"><span class="title is-4">3.4</div>
                        <div class="column is-6"><span class="title is-4">Views:</span></div>
                        <div class="column is-6 has-text-right"><span class="title is-4">{{ $visual->views }}</div>

                        <div class="column is-6"><span class="title is-4">Favorites:</span></div>
                        <div class="column is-6 has-text-right"><span class="title is-4">@{{ favoritesCount }}</div>

                        <div class="column is-6"><span class="title is-4">Comments:</span></div>
                        <div class="column is-6 has-text-right"><span class="title is-4">{{ $visual->comments_count }}</div>
                    </div>
                </div>
            </div>
            <div class="column is-7 is-offset-1">
                @include('comments.index')
            </div>
        </div>
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