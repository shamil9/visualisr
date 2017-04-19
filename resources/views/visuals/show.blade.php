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

            @if($visual->user->canManage($visual->user))
                <div class="visual__save">
                    <a href="#" @click.prevent="$emit('toggleModalEvent')">
                        <img src="{{ asset('assets/img/icons/user/confirm.svg') }}" alt="Delete">
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
                    url="{{ route('visuals.update', ['visual' => $visual->id]) }}"
                    track="{{ $visual->track }}"
                    album="{{ $visual->album }}"
                    artist="{{ $visual->artist }}">
                </manager>
            @endif
        </div>
@endsection

@section('content')
    <div class="section">
        <div class="visual">
            <img src="{{ asset('uploads/visuals/' . $visual->user->id . '/' . $visual->image) }}" alt="{{ $visual->track }}">
        </div>

        <form id="delete-form" action="{{ route('visuals.destroy', ['visual' => $visual->id]) }}" method="POST" style="display: none;">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
    </div>
@endsection

@section('footer-js')
@parent
    <script>
        new Vue({
            el: '#visual-edit',
            data: {
                showDeleteModal: false,
                private: {{ $visual->private }},
                display: 'none',
            },
            methods: {
                toggleModal: function() {
                    this.showDeleteModal = !this.showDeleteModal;
                },
                submit: function() {
                    document.getElementById('delete-form').submit();
               },
               togglePrivate: function() {
                    window.axios
                        .post('{{ route('visuals.update.post', $visual) }}', {
                            image: '{{ $visual->image }}',
                            track: '{{ $visual->track }}',
                            album: '{{ $visual->album }}',
                            artist: '{{ $visual->artist }}',
                            private: !this.private,
                        })
                        .then(response => {
                        })
                        .catch(error => {
                        })
               }
            }
        });
    </script>
@endsection