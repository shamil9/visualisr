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
        <header class="header">
            @include('layouts.partials.header')
        </header>

        <main class="splash-screen">
            <p>Create beautiful art</p>
            <img src="{{ asset('assets/img/wave.png') }}" alt="{{ config('app.name') }}">
            <p>From your favorite song</p>
            <a class="join" href="{{ route('visuals.create') }}">TRY NOW</a>
        </main>

        <footer class="footer">
            @include('layouts.partials.footer')
        </footer>
    </div>

<script>
    console.log('%c Hey there! ', 'padding: 5px; background: #222831; color: white');
    var menuToggle = document.querySelector('#nav-menu-toggle');
    var menu = document.querySelector('#nav-menu');

    menuToggle.addEventListener('click', function() {
        menu.classList.toggle('is-active');
        menuToggle.classList.toggle('is-active');
    });
</script>
</body>
</html>
