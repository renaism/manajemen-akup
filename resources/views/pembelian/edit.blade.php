@extends('pembelian.create')

@section('header', 'Edit Pembelian')
@section('form-action')
    <form method="POST" action="{{ action('PembelianController@update', $pembelian->id) }}" accept-charset="UTF-8">
    @method('PUT')
@endsection
@section('bahan')
    <select id="inputBahan" class="custom-select custom-select-lg" disabled>
        <option selected>{{ $pembelian->bahan->nama }}</option>
    </select>
@endsection
@section('jumlah'){{ $pembelian->jumlah }}@endsection
@section('harga'){{ $pembelian->harga }}@endsection
@section('tanggal'){{ $pembelian->tanggal }}@endsection
@section('form-submit', 'Update')