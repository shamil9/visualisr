@extends('layouts.app')
@section('title', 'Login')

@section('breadcrumbs')
Index / Login
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
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <p class="control has-icon">
                                <input class="input" type="email" name="email" placeholder="Email">
                                <span class="icon is-small">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <p class="control has-icon">
                                <input class="input" type="password" name="password" placeholder="Password">
                                <span class="icon is-small">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </p>
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
                        <button class="login__button button is-success">
                            <img src="{{ asset('assets/img/icons/sign-in.svg') }}" alt="Sign In">
                        </button>
                    </div>
                </div>
                <div>
                    <a href="{{ route('twitter.login') }}" class="button is-info">
                        Twitter Login
                    </a>
                </div>

            </form>
        </div>
        <div class="column">
            <article class="message">
                <div class="message-body content">
                    <span class="title is-4">Don't have an account?</span><br>
                    <ul>
                        <li><a href="{{ route('register') }}">Register one now!</a></li>
                    </ul>
                    <span class="title is-4">Using Twitter?</span><br>
                    <ul>
                        <li>
                            <a href="{{ route('twitter.login') }}">
                                Register using Twitter
                            </a>
                        </li>
                    </ul>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
