@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5 pt-5" id="welcome">
        <h1 class="display-1">Manajamen Akup</h1>
        <h3>Aplikasi buat tugas imparu by BayuSquat</h3>
        <hr class="my-4" />
        <div id="welcomeButtons">
            <a href="/transaksi" class="btn btn-block btn-lg btn-outline-light my-4">Kasir</a>
            <a href="/bahan" class="btn btn-block btn-lg btn-outline-light my-4">Manajer</a>
        </div>
    </div>
@endsection