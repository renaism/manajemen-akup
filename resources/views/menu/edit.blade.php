@extends('menu.create')

@section('header', 'Edit Menu')
@section('form-action')
    <form method="POST" action="{{ action('MenuController@update', $menu->id) }}" accept-charset="UTF-8">
    @method('PUT')
@endsection
@section('nama'){{ $menu->nama }}@endsection
@section('harga'){{ $menu->harga }}@endsection
@section('daftar-bahan')
    @foreach ($menu->daftarBahan as $bahan)
        <div class="form-inline">
            <select name="daftarBahan[]" id="bahan" class="custom-select flex-grow-1 mb-2 mr-2">
                <option value="" disabled selected>Pilih Bahan...</option>
                @foreach ($daftarBahan as $b)
                    <option value="{{ $b->id }}" @if($bahan->id == $b->id) selected @endif>{{ $b->nama }}</option>
                @endforeach
            </select>
            <div class="input-group mb-2 mr-2 w-25">
                <input type="number" name="jumlahBahan[]" class="form-control" step="any" id="inputJumlahBahan" placeholder="Jumlah" value="{{ $bahan->pivot->jumlah }}">
                <div class="input-group-append">
                    <span class="input-group-text">{{ $bahan->satuan }}</span>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger mb-2 remove-bahan-btn">
                <span class="oi oi-trash"></span>
            </button>
        </div>
    @endforeach
@endsection
@section('form-submit')
    <span class="oi oi-pencil"></span>&nbsp;&nbsp;Edit
@endsection 