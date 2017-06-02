@extends('layouts.app')
@section('title', 'Update Password')
@section('class', 'change-password')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Profile' => 'user.home'])
@endsection

@section('content')
    <section class="section">
        <div class="columns">
            <a class="is-hidden-tablet" href="{{ route('user.home') }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <div class="column is-2 is-hidden-mobile">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column is-offset-1 is-5">
                <h1 class="title is-1">Update Password</h1>
                <hr>
                <form method="post" action="{{ route('user.password.update') }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="field">
                        <label for="current_password" class="label">Current</label>

                        <p class="control has-icon">
                            <input class="input" pattern=".{6,}" title="6 characters minimum" name="current_password" type="password" placeholder="Current Password" required autofocus>

                            <span class="icon is-small">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>

                        @if ($errors->has('current_password'))
                            <p class="help is-danger">
                                {{ $errors->first('current_password') }}
                            </p>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password" class="label">New</label>

                        <p class="control has-icon">
                            <input class="input" pattern=".{6,}" title="6 characters minimum" name="password" type="password" placeholder="Password" required>

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
                        <label for="password_confirmation" class="label">Repeat</label>

                        <p class="control has-icon">
                            <input class="input" pattern=".{6,}" title="6 characters minimum" name="password_confirmation" type="password" placeholder="Repeat Password" required>

                            <span class="icon is-small">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>

                        @if ($errors->has('password_confirmation'))
                            <p class="help is-danger">
                                {{ $errors->first('password_confirmation') }}
                            </p>
                        @endif
                    </div>

                    <div class="field">
                        <p class="control">
                            <button type="submit" class="button is-success">Submit</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <flash message="{{ session('flash') }}"></flash>
    </section>
@endsection

@section('footer-js')
    @parent()
    <script>
        new Vue({ el: '.change-password'})
    </script>
@endsection
