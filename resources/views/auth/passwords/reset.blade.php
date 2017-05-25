@extends('layouts.app')
@section('title', 'Reset Password')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Password Reset' => 'password.request'])
@stop

@section('content')
<section class="section">
    <div class="columns">
        <div class="column is-offset-2 is-8 is-flex-centered">
            <form role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                @if (session('status'))
                    <div class="notification is-success">
                        {{ session('status') }}
                    </div>
                @endif

                <h1 class="title">Password Reset</h1>
                <h2 class="subtitle">Please enter you email adress and new password</h2>
                <hr>

                <div class="field">
                    <label for="email" class="label">Email</label>

                    <p class="control has-icon is-expanded">
                        <input class="input is-medium" type="email" name="email" value="{{ $email or old('email') }}" placeholder="Email" required autofocus>
                        <span class="icon is-medium">
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
                        <input class="input is-medium" id="password" type="password" name="password" placeholder="Password">

                        <span class="icon is-medium">
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
                        <input class="input is-medium" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">

                        <span class="icon is-medium">
                            <i class="fa fa-lock"></i>
                        </span>
                    </p>
                </div>

                <div class="field">
                    <button class="button is-info" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
