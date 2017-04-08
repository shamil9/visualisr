<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="{{ mix('assets/css/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
    <title>Visualisr</title>
</head>
<body>
<div class="home">
    <header class="header">
        <div class="container">
            <div class="header__logo is-pulled-left">
                <a href="{{ url('/') }}">
                    <img src="{{ url('assets/img/logo.png') }}" title="{{ env('APP_NAME') }}" />
                </a>
            </div>
            <div class="header__user is-pulled-right">
{{--                @if (Auth::guest())--}}
                    <div class="header__user--guest">
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('assets/img/icons/user.svg') }}" alt="User">
                        </a>
                    </div>
                {{--@endif--}}
            </div>
        </div>
    </header>
    <main class="splash-screen" role="main">
        <p>Create beautiful art</p>
        <img src="{{ asset('assets/img/wave.png') }}" alt="Visualisr">
        <p>From your favorite song</p>
        <a class="join">JOIN NOW</a>
    </main>
</div>
</body>
</html>