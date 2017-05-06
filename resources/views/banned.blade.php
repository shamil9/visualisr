@extends('layouts.app')
@section('title', 'Account banned')

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <article class="message is-danger">
                    <div class="message-body">
                        <h2 class="title">Account Suspended</h2>
                        <p>We are sorry, but your account has been temporarily suspended.</p>
                        <p>If you think there was a mistake please feel free to contact us.</p>
                    </div>
                </article>
                <a href="{{ route('contact.create') }}" class="button is-info">Write Us</a>
            </div>
        </div>
    </section>
@endsection