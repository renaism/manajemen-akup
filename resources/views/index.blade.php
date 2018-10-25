<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manajemen Bakso Akup</title>

    <!-- Styles -->
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <style>
        .container {
            margin-top: 200px;
        }
    </style>
</head>
<body class="red darken-4">
    <div class="container center-align">
        <div class="row">
            <div class="col s12">
                <img src="{{ asset('mie_akup.png') }}" />
            </div>
        </div>
        <div class="row">
            <a href="/bahan" class="waves-effect waves-light grey darken-4 btn">Manajer Dashboard</a>
        </div>
        <!--
        <div class="row">
            <div class="col s12 m3 offset-m2">
                <div class="card grey darken-4">
                    <div class="card-content">
                            <a href="#" class="card-title white-text">Kasir</a>
                    </div>
                </div> 
            </div> 
            <div class="col s12">
                <div class="card grey darken-4">
                    <div class="card-content">
                        <a href="/bahan" class="card-title white-text">Manajer</a>
                    </div>
                </div>
            </div>
        </div>
        !-->
    </div>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
</body>
</html>