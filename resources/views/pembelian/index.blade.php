@extends('layouts.main')

@section('header')
    <span class="oi oi-cart"></span>&nbsp;Kelola Pembelian
@endsection
@section('main-content')
    @if(count($daftarPembelian) > 0)
        <a href="/pembelian/create" class="btn btn-lg btn-light mt-2">
            <span class="oi oi-plus"></span>&nbsp;Input Pembelian
        </a>
        <table class="table table-light text-dark table-hover my-4">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Bahan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($daftarPembelian as $pembelian)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $pembelian->bahan->nama }}</td>
                        <td>{{ $pembelian->jumlah }} {{ $pembelian->bahan->satuan }}</td>
                        <td>Rp{{ $pembelian->harga }},-</td>
                        <td>{{ $pembelian->tanggal }}</td>
                        <td>
                            <a class="btn btn-primary float-right" href="/pembelian/{{ $pembelian->id }}/edit">
                                <span class="oi oi-pencil"></span>&nbsp;Edit
                            </a>
                        </td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#delete{{ $pembelian->id }}" class="btn btn-danger">
                                <span class="oi oi-trash"></span>&nbsp;Hapus
                            </button>
                            <form method="POST" action="{{ action('PembelianController@destroy', $pembelian->id) }}">
                                @method('DELETE')
                                @csrf
                                @include('inc.delete', ['object' => $pembelian])
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <h3 class="mt-5">Data pembelian kosong</h3>
            <a href="/pembelian/create" class="btn btn-lg btn-outline-light mt-3">
                <span class="oi oi-plus"></span><br>
                Input Pembelian
            </a>
        </div>
    @endif
@endsection