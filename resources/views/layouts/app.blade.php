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
        <link href="{{ mix('assets/css/vendor.css') }}" rel="stylesheet">
        <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
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
    <div class="@yield('class')">
        <header>
            @include('layouts.partials.header')
        </header>

        <main role="main">
            @yield('container-header')
            <div class="container">
                @yield('content')
            </div>
        </main>

        {{--<section class="footer">--}}
            {{--@include('layouts.partials.footer')--}}
        {{--</section>--}}
        <!-- Scripts -->
    </div>
    @section('footer-js')
        <script src="{{ mix('assets/js/manifest.js') }}"></script>
        <script src="{{ mix('assets/js/vendor.js') }}"></script>
        <script src="{{ mix('assets/js/app.js') }}"></script>
    @show
</body>
</html>
