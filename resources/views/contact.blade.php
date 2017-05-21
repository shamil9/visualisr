@extends('layouts.app')
@section('title', 'Contact')
@section('class', 'contact')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Contact' => 'contact.create'])
@endsection

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <div class="card">
                    <div class="card-content">
                        <form method="post" action="{{ route('contact.store') }}">
                            {{ csrf_field() }}
                            @unless(auth()->check())
                                <div class="field">
                                    <label class="label">Name</label>
                                    <p class="control">
                                        <input class="input" type="text" placeholder="Name" name="name"
                                               value="{{ old('name') }}" required>
                                    </p>
                                    @if ($errors->has('name'))
                                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="field">
                                    <label class="label">Email</label>
                                    <p class="control">
                                        <input class="input" type="email" placeholder="Email" name="email"
                                               value="{{ old('email') }}" required>
                                    </p>
                                    @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            @endunless
                            <div class="field">
                                <label class="label">Message</label>
                                <p class="control">
                                    <textarea class="textarea" name="body" minlength="10" placeholder="Message"
                                              required>{{ old('body') }}</textarea>
                                </p>
                                @if ($errors->has('body'))
                                    <p class="help is-danger">{{ $errors->first('body') }}</p>
                                @endif
                            </div>
                            <div class="field">
                                <p class="control">
                                    <button type="submit" class="button is-primary">Submit</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <flash message="{{ session('flash') }}"></flash>
            </div>
        </div>
    </section>
@endsection

@section('footer-js')
    @parent
    <script>
        new Vue({ el: '.contact' })
    </script>
@stop
