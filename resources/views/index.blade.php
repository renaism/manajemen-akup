@extends('layouts.app')

@section('content')
    <div id="particles-js"></div>
    <div class="container text-center" id="welcome">
        <a href="#" id="akupLogo">
            <img src="{{ asset('akup.png') }}" width="400" height="400">
        </a>
        <div id="welcomeButtons">
            <a href="/transaksi" class="btn btn-block btn-lg btn-outline-light my-4">Kasir</a>
            <a href="#" id="manajerBtn" class="btn btn-block btn-lg btn-outline-light my-4">Manajer</a>
        </div>
        <div id="manajerButtons" class="mt-4">
            <div class="d-flex justify-content-center ">
                <a href="/bahan" class="btn btn-lg btn-outline-light mx-2">
                    <span class="oi oi-fire"></span><br>Bahan
                </a>
                <a href="/menu" class="btn btn-lg btn-outline-light mx-2">
                    <span class="oi oi-book"></span><br>Menu
                </a>
                <a href="/pembelian" class="btn btn-lg btn-outline-light mx-2">
                    <span class="oi oi-basket"></span><br>Pembelian
                </a>
                <a href="/keuangan" class="btn btn-lg btn-outline-light mx-2">
                    <span class="oi oi-spreadsheet"></span><br>Keuangan
                </a>
                <a href="#" id="manajerBackBtn" class="btn btn-lg btn-outline-light mx-2">
                    <span class="oi oi-chevron-left"></span><br>Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/particles.min.js') }}"></script>   
    <script>
        particlesJS.load('particles-js', '{{ asset('particles.json') }}');
        var expanded = false;
        $("#akupLogo").hide();
        $("#akupLogo").fadeIn(1000);
        $("#welcomeButtons").hide();
        $("#manajerButtons").hide();
        $("#akupLogo").click(function() {
            $(this).find("img").animate({
                width: expanded ? "400px" : "200px",
                height: expanded ? "400px" : "200px"
            }, function() {
                if (expanded) {
                    $("#welcomeButtons").slideUp();
                    $("#manajerButtons").slideUp();
                }
                else {
                    $("#welcomeButtons").slideDown();
                }
                expanded = !expanded;
            });
        });
        $("#manajerBtn").click(function() {
            $("#welcomeButtons").fadeOut(function() {
                $("#manajerButtons").fadeIn();
            });
        });
        $("#manajerBackBtn").click(function() {
            $("#manajerButtons").fadeOut(function() {
                $("#welcomeButtons").fadeIn();
            });
        });
    </script>
@endpush