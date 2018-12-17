@extends('menu.create')

@section('header', 'Edit Menu')
@section('form-action')
    <form method="POST" action="{{ action('MenuController@update', $menu) }}" enctype="multipart/form-data" accept-charset="UTF-8">
    @method('PUT')
@endsection
@section('nama'){{ $menu->nama }}@endsection
@section('harga'){{ $menu->harga }}@endsection
@if($menu->gambar != 'default.jpg')
    @section('gambar'){{ asset('storage/menu/gambar/'.$menu->gambar) }}@endsection
@endif
@section('daftar-bahan')
    @foreach ($menu->daftarBahan as $bahan)
        <div class="form-inline">
            <select name="daftarBahan[]" id="bahan" class="custom-select flex-grow-1 mb-2 mr-2" onchange="select_bahan(this)" required>
                <option value="" disabled selected>Pilih Bahan...</option>
                @foreach ($daftarBahan as $b)
                    <option value="{{ $b->id }}" @if($bahan->id == $b->id) selected @endif>{{ $b->nama }}</option>
                @endforeach
            </select>
            <div class="input-group input-jumlah mb-2 mr-2 w-25">
                <input type="number" name="jumlahBahan[]" class="form-control" step="any" id="inputJumlahBahan" placeholder="Jumlah" value="{{ $bahan->pivot->jumlah }}" min="0" max="999999.99" required>
                <div class="input-group-append">
                    <span class="input-group-text input-jumlah-satuan">{{ $bahan->satuan }}</span>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger mb-2 remove-bahan-btn">
                <span class="oi oi-trash"></span>
            </button>
        </div>
    @endforeach
@endsection
@section('form-submit', 'Update')