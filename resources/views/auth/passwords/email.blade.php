@extends('layouts.app')
@section('title', 'Reset Password')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Password Reset' => 'password.request'])
@stop

@section('content')
<section class="section">
    <div class="columns">
        <div class="column is-offset-2 is-8">
            @if (session('status'))
                <div class="notification is-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="is-flex-centered">
                <h1 class="title">Password Reset</h1>
                <p>Enter your email address you used for registration.</p>
                <p>We will send you instructions to reset your password.</p>
                <br>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="field is-grouped">
                        <p class="control has-icon is-expanded">
                            <input class="input is-large" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                            <span class="icon is-medium">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </p>

                        <p class="control">
                            <button type="submit" class="button is-large is-info">Send</button >
                        </p>
                    </div>

                    @if ($errors->has('email'))
                        <p class="help is-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
