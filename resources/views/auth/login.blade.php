@extends('layouts.app')
@section('title', 'Login')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Login' => 'login'])
@stop
@section('content')
<section class="section">
    <div class="columns">
        <div class="column is-4 is-offset-2">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="columns">
                    <div class="column is-10">
                        <div class="field">
                            <p class="control has-icon">
                                <input class="input" type="email" name="email" placeholder="Email" required autofocus>
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
                            <p class="control has-icon">
                                <input class="input" type="password" name="password" placeholder="Password" required>
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

                        <label class="checkbox">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>

                        <div class="pull-right">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <button type="submit" class="login__button button is-success">
                            <img src="{{ asset('assets/img/icons/sign-in.svg') }}" alt="Sign In">
                        </button>
                    </div>
                </div>

                <span class="title is-3">Using Twitter?</span>
                <hr>
                <div>
                    <a href="{{ route('twitter.login') }}" class="button is-info">
                        Twitter Login
                    </a>
                </div>
            </form>
        </div>
        <div class="column is-offset-1">
            <article class="message">
                <div class="message-body content">
                    <span class="title is-4">Don't have an account?</span><br>
                    <ul>
                        <li><a href="{{ route('register') }}">Register one now!</a></li>
                    </ul>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
