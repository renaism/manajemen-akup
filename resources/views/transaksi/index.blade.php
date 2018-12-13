@extends('layouts.main')

@section('header')
    <span class="oi oi-cart"></span>&nbsp;Transaksi
@endsection
@section('main-content')
    @if(count($daftarTransaksi) > 0)
        <a href="/transaksi/create" class="btn btn-lg btn-light mt-2">
            <span class="oi oi-plus"></span>&nbsp;Input Transaksi
        </a>
        <table class="table table-light text-dark table-hover my-4">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Harga Total</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($daftarTransaksi as $transaksi)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ date('d F Y', strtotime($transaksi->tanggal)) }}</td>
                        <td>{{ date('H:i', strtotime($transaksi->tanggal)) }}</td>
                        <td>Rp{{ $transaksi->harga_total }},-</td>
                        <td>
                            <a class="btn btn-primary float-right" href="/transaksi/{{ $transaksi->id }}">
                                <span class="oi oi-eye"></span>&nbsp;Lihat
                            </a>
                        </td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#delete{{ $transaksi->id }}" class="btn btn-danger">
                                <span class="oi oi-trash"></span>&nbsp;Hapus
                            </button>
                            <form method="POST" action="{{ action('TransaksiController@destroy', $transaksi->id) }}">
                                @method('DELETE')
                                @csrf
                                @include('inc.delete', ['object' => $transaksi])
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <h3 class="mt-5">Data transaksi kosong</h3>
            <a href="/transaksi/create" class="btn btn-lg btn-outline-light mt-3">
                <span class="oi oi-plus"></span><br>
                Input Transaksi
            </a>
        </div>
    @endif
@endsection