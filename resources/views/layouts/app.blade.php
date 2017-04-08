<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') Visualisr</title>

    @section('styles')
        <!-- Styles -->
        <link href="{{ asset('assets/css/vendor.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    @show
    @yield('header-js')
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <header>
        @include('layouts/partials/header')
    </header>
    <main role="main">
        @if (Auth::guest())
            <header>
                @include('layouts/partials/control-bar')
            </header>
        @endif
        <div class="container">
            @yield('content')
        </div>
    </main>
    <section class="footer">
        @include('layouts/partials/footer')
    </section>
    <!-- Scripts -->
    @section('footer-js')
        <script src="{{ asset('assets/js/app.js') }}"></script>
    @show
</body>
</html>
