@extends('layouts.kasir')

@push('styles')
    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
@endpush
@section('header', 'Detail Transaksi')
@section('main-content')
    <div class="card text-dark">
        <div class="card-header d-flex justify-content-between">
            <a href="/transaksi" class="btn btn-primary">Kembali</a>
            <button type="button" class="btn btn-secondary" onclick="window.print()"><span class="oi oi-print"></span></button>
        </div>
        <div class="card-body">
            <div id="tanggal">
                <h5><span class="oi oi-calendar"></span> {{ date('d F Y', strtotime($transaksi->tanggal)) }}</h5>
                <h5><span class="oi oi-clock"></span> {{ date('H:i', strtotime($transaksi->tanggal)) }}</h5>
            </div>
            <hr>
            <div id="print">
                <div class="print-only">
                    <h1 class="text-center">Mie Baso Akup</h1>
                    <p class="text-center">
                        Jl. Raya Banjaran No.7 Nambo, Banjaran, Kab. Bandung<br>
                        085320862076
                    </p>
                    <hr>
                    <p>
                        <strong>Nota Pembelian</strong><br>
                        Tanggal: {{ date('d F Y', strtotime($transaksi->tanggal)) }}<br>
                        Jam: {{ date('H:i', strtotime($transaksi->tanggal)) }}
                    </p>
                    <hr class="m-0 p-0">
                    <div class="d-flex justify-content-between">
                        <p class="m-0 p-0">Item</p>
                        <p class="m-0 p-0">Jumlah</p>
                    </div>
                    <hr class="mt-0 p-0">
                </div>
                @foreach ($transaksi->daftarMenu as $menu)
                    <div class="menu d-flex">
                        <div class="menu-img mr-3 print-hide">
                            <img src="{{ asset('storage/menu/gambar/'.$menu->gambar) }}" onError="this.onerror=null;this.src='{{ asset('menu_default.jpg') }}';" class="gambar-menu img-thumbnail">
                        </div>
                        <div class="menu-detail flex-grow-1 mr-3">
                            <h3 class="menu-nama">
                                {{ $menu->nama }}
                                @if($menu->trashed())
                                    <em class="text-mute print-hide"> &lt;Dihapus&gt;</em>
                                @endif
                            </h3>
                            <h5>Rp{{ number_format($menu->pivot->harga) }},-</h5>
                        </div>
                        <div class="menu-qty w-25 text-right">
                            <h3>x{{ $menu->pivot->jumlah }}</h3>
                            <h5>Rp{{ number_format($menu->pivot->harga * $menu->pivot->jumlah) }},-</h5>
                        </div>
                    </div>
                    <hr class="print-hide">
                    <div class="print-only">
                        <br>
                    </div>
                @endforeach
                <div class="print-only">
                    <hr>
                </div>
                <div id="hargaTotal" class="d-flex justify-content-between">
                    <h3>Subtotal</h3>
                    <h5 class="text-right">Rp{{ number_format($transaksi->harga_total) }},-</h5>
                </div>
            </div>
        </div>
    </div>
@endsection