@extends('pembelian.create')

@section('header', 'Edit Pembelian')
@section('form-action')
    <form method="POST" action="{{ action('PembelianController@update', $pembelian) }}" accept-charset="UTF-8">
    @method('PUT')
@endsection
@section('bahan')
    <select id="inputBahan" class="custom-select custom-select-lg" disabled>
        @if($pembelian->bahan)
            <option selected>{{ $pembelian->bahan->nama }}</option>
        @else
            <option selected><em class="text-muted">&lt;Bahan Dihapus&gt;</em></option>
        @endif
    </select>
@endsection
@section('jumlah'){{ $pembelian->jumlah }}@endsection
@if($pembelian->bahan)
    @section('satuan'){{ $pembelian->bahan->satuan }}@endsection
@else
    @section('satuan')?@endsection
@endif
@section('harga'){{ $pembelian->harga }}@endsection
@section('tanggal'){{ $pembelian->tanggal }}@endsection
@section('form-submit', 'Update')