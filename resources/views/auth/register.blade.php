@extends('layouts.app')
@section('title', 'Register new account')
@section('breadcrumbs')
    Index / Register
@endsection
@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-4 is-offset-2">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="field">
                        <label for="name" class="label">Name</label>

                        <p class="control has-icon">
                            <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                            <span class="icon is-small">
                                <i class="fa fa-user"></i>
                            </span>

                            @if ($errors->has('name'))
                                <p class="help is-danger">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </p>
                    </div>

                    <div class="field">
                        <label for="email" class="label">Email</label>

                        <p class="control has-icon">
                            <input class="input" id="email" type="email" value="{{ old('email') }}" name="email" placeholder="Email">

                            <span class="icon is-small">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </p>

                        @if ($errors->has('email'))
                            <p class="help is-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password" class="label">Password</label>

                        <p class="control has-icon">
                            <input class="input" id="password" type="password" name="password" placeholder="Password">

                            <span class="icon is-small">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>

                        @if ($errors->has('password'))
                            <p class="help is-danger">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password_confirmation" class="label">Confirm Password</label>

                        <p class="control has-icon">
                            <input class="input" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">

                            <span class="icon is-small">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>
                    </div>

                    <div class="field">
                        <button class="button is-info" type="submit">Register</button>
                    </div>
                </form>
            </div>
            <div class="column is-offset-1">
                <article class="media">
                    <figure class="media-left">
                    <svg width="80px" height="80px" viewBox="0 0 18 18">
                        <use xlink:href="{{ asset('assets/img/icons/twitter.svg#2') }}"
                    </svg>
                    </figure>
                    <div class="media-content">
                        <p class="title is-4">Using Twitter?</p>
                        <a href="{{ route('twitter.login') }}" class="button is-small is-info">
                            Register with Twitter
                        </a>
                    </div>
                </article>

                <hr>

                <span class="title is-4">Allready have an account?</span><br><br>
                <a href="{{ route('login') }}" class="button is-info">
                    Login
                </a>
            </div>
        </div>
    </section>
@endsection
