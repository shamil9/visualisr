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
        <delete-modal v-cloak></delete-modal>
    </section>
@endsection

@section('footer-js')
    @parent
    <script>
        new Vue({el: '.support-tickets'})
    </script>
@endsection
