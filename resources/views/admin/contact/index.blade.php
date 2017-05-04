@extends('layouts.app')
@section('title', 'Contact Messages')
@section('class', 'support-tickets')

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column is-10">
                <div class="columns is-multiline">
                    @each('admin.contact.partials.message', $messages, 'message')
                </div>
            </div>
        </div>
        <flash message="{{ session('flash') }}"></flash>
        <modal v-show="showModal" v-cloak>
            <div class="modal-card">
                <div class="modal-content">
                    <article class="message is-danger has-text-centered">
                        <div class="message-header">
                            <p><strong>Danger</strong>!</p>
                        </div>
                        <div class="message-body">
                            <p class="title is-2 is-danger">Delete message?</p>
                            <button class="button is-danger" @click.prevent="deleteTicket">Delete</button>
                            <button @click.prevent="showModal = !showModal" class="button">Cancel</button>
                        </div>
                    </article>
                </div>
            </div>
        </modal>
    </section>
@endsection

@section('footer-js')
    @parent
    <script>
        new Vue({
            el: '.support-tickets',
            data: {
                showModal: false,
                formId: null,
            },
            methods: {
                showDeleteModal: function ( id ) {
                    this.formId    = id
                    this.showModal = true;
                },
                deleteTicket: function () {
                    this.$refs[ this.formId ].submit()
                }
            }
        })
    </script>
@endsection