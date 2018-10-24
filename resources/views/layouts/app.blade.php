<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Bakso Akup</title>
    <!-- Styles -->
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <style>
        header, footer {
            padding-left: 300px;
        }
    </style>
</head>
<body class="red darken-4">
    <header>
        @include('inc.navbar')
    </header>
    <div class="row">
        <div class="col s12 m4 l3">
            @include("inc.sidebar")
        </div>
        <div class="col s12 m8 l9 container white-text">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    @yield('script')
</body>
</html>