@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="field">
                <p class="control has-icon">
                    <input class="input" type="email" placeholder="Email">
                    <span class="icon is-small">
                <i class="fa fa-envelope"></i>
            </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icon">
                    <input class="input" type="password" placeholder="Password">
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

            {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

            {{--<div class="col-md-6">--}}
            {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

            {{--@if ($errors->has('email'))--}}
            {{--<span class="help-block">--}}
            {{--<strong>{{ $errors->first('email') }}</strong>--}}
            {{--</span>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

            {{--<div class="col-md-6">--}}
            {{--<input id="password" type="password" class="form-control" name="password" required>--}}

            {{--@if ($errors->has('password'))--}}
            {{--<span class="help-block">--}}
            {{--<strong>{{ $errors->first('password') }}</strong>--}}
            {{--</span>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}
        </form>
    </div>
@endsection
