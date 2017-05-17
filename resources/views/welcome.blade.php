<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto+Condensed" rel="stylesheet">
    <link href="{{ mix('assets/css/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
    <title>Visualisr</title>
</head>
<body>
<div class="home">
    <header>
        @include('layouts.partials.header')
    </header>
    <main class="splash-screen" role="main">
        <p>Create beautiful art</p>
        <img src="{{ asset('assets/img/wave.png') }}" alt="Visualisr">
        <p>From your favorite song</p>
        <a class="join" href="{{ route('register') }}">JOIN NOW</a>
    </main>
</div>
</body>
</html>
