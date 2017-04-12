@extends('layouts.app')

@section('content')
    <div class="section">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="field">
                <p class="control has-icon">
                    <input class="input" type="email" name="email" placeholder="Email">
                    <span class="icon is-small">
                <i class="fa fa-envelope"></i>
            </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icon">
                    <input class="input" type="password" name="password" placeholder="Password">
                    <span class="icon is-small">
              <i class="fa fa-lock"></i>
            </span>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button class="button is-success">
                        Login
                    </button>
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </p>
            </div>

            @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif

            @if ($errors->has('password'))
            <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </form>
    </div>
@endsection
