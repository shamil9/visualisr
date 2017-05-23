@extends('layouts.app')
@section('title', 'Update Profile')
@section('class', 'update-profile')
@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'My Profile' => 'user.home'])
@endsection

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column is-offset-1 is-5">
                <h1 class="title is-1">Update Profile</h1>
                <hr>
                <form method="post" action="{{ route('user.profile.update') }}"   enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="field">
                        <label for="avatar" class="label">Avatar</label>
                        <div class="media">
                            <figure class="media-left user__avatar image is-48x48">
                                <img src="{{ \Storage::url('avatars/' . auth()->user()->avatar) }}"
                                     alt="{{ auth()->user()->name }}">
                            </figure>
                            <div class="media-content">
                                <p class="control">
                                    <input class="input" name="avatar" type="file"
                                        accept=".png,.jpeg,.jpg,.bmp image/jpeg, image/png, image/bmp">
                                </p>

                                @if ($errors->has('avatar'))
                                    <p class="help is-danger">
                                        {{ $errors->first('avatar') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="email" class="label">Current Email</label>

                        <p class="control has-icon">
                            <input class="input" value="{{ auth()->user()->email }}" disabled>

                            <span class="icon is-small">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </p>
                    </div>

                    <div class="field">
                        <label for="email" class="label">New</label>

                        <p class="control has-icon">
                            <input class="input" id="email" name="email" type="email" placeholder="New Email" value="{{ old('email') }}" autofocus>

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
                        <label for="email_confirmation" class="label">Repeat</label>

                        <p class="control has-icon">
                            <input class="input" id="email_confirmation" name="email_confirmation" type="email" placeholder="Repeat Email" value="{{ old('email') }}">

                            <span class="icon is-small">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </p>

                        @if ($errors->has('email_confirmation'))
                            <p class="help is-danger">
                                {{ $errors->first('email_confirmation') }}
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
        new Vue({ el: '.update-profile'})
    </script>
@endsection
