@extends('layouts.main')

@section('header', 'Detail Transaksi')
@section('main-content')
    <div class="card text-dark">
        <div class="card-header d-flex justify-content-between">
            <a href="/transaksi" class="btn btn-primary">Kembali</a>
            <button type="button" class="btn btn-secondary"><span class="oi oi-print"></span></button>
        </div>
        <div class="card-body">
            <div id="tanggal">
                <h5><span class="oi oi-calendar"></span> {{ date('d F Y', strtotime($transaksi->tanggal)) }}</h5>
                <h5><span class="oi oi-clock"></span> {{ date('H:i', strtotime($transaksi->tanggal)) }}</h5>
            </div>
            <hr>
            @foreach ($transaksi->daftarMenu as $menu)
                <div class="menu d-flex">
                    <div class="menu-img mr-3">
                        <img src="{{ asset('storage/menu/gambar/'.$menu->gambar) }}" onError="this.onerror=null;this.src='{{ asset('menu_default.jpg') }}';" class="gambar-menu img-thumbnail">
                    </div>
                    <div class="menu-detail flex-grow-1 mr-3">
                        <h3 class="menu-nama">{{ $menu->nama }}</h3>
                        <h5>Rp{{ $menu->pivot->harga }},-</h5>
                    </div>
                    <div class="menu-qty w-25 text-right">
                        <h3>x{{ $menu->pivot->jumlah }}</h3>
                        <h5>Rp{{ $menu->pivot->harga * $menu->pivot->jumlah }},-</h5>
                    </div>
                </div>
                <hr>
            @endforeach
            <div id="hargaTotal" class="d-flex justify-content-between">
                <h3>Subtotal</h3>
                <h5 class="text-right">Rp{{ $transaksi->hargaTotal() }},-</h5>
            </div>
        </div>
    </div>
@endsection