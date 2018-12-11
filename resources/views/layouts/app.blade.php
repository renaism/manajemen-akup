<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Akup') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/open-iconic-bootstrap.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/akup.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Content -->
    <div id="app">
        @yield('navbar')
        <main>
            @yield('content')
        </main>
        @yield('footer')
    </div>

    <!-- Additional Scripts -->
    @yield('script')
</body>
</html>