@extends('layouts.manajer')

@section('header', 'Input Pembelian')
@section('main-content')
    <div class="card text-dark mt-4">
        <div class="card-body">
            @section('form-action')
            <form method="POST" action="{{ action('PembelianController@store') }}" accept-charset="UTF-8">
            @show
                @csrf
                <div class="form-group">
                    <label for="inputBahan">Bahan</label>
                    @section('bahan')
                        <select name="bahan" required id="inputBahan" class="custom-select custom-select-lg">
                            <option value="" disabled selected>Pilih Bahan...</option>
                            @foreach ($daftarBahan as $bahan)
                                <option value="{{ $bahan->id }}">{{ $bahan->nama }}</option>
                            @endforeach
                        </select>
                    @show
                </div>
                <div class="form-group">
                    <label for="inputNama">Jumlah</label>
                    <div class="input-group">
                        <input type="number" name="jumlah" required class="form-control form-control-lg" step="any" id="inputJumlah" value="@section('jumlah'){{ old('jumlah') }}@show">
                        <div class="input-group-append">
                            <span class="input-group-text"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStok">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" name="harga" required class="form-control form-control-lg" step="any" id="inputHarga" value="@section('harga'){{ old('harga') }}@show">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTanggal">Tanggal</label>
                    <input type="date" name="tanggal" required class="form-control form-control-lg" value="@section('tanggal'){{ old('tanggal') }}@show">
                </div>
                <button type="submit" class="btn btn-lg btn-primary mt-4">
                    @section('form-submit')
                        Insert
                    @show 
                </button>
                <a href="/pembelian" class="btn btn-lg btn-danger float-right mt-4">Cancel</a>
            </form>   
        </div>
    </div>
    <div class="form-inline bahan-template d-none">
        <select name="daftarBahan[]" id="bahan" class="custom-select flex-grow-1 mb-2 mr-2">
            <option value="" disabled selected>Pilih Bahan...</option>
            @foreach ($daftarBahan as $bahan)
                <option value="{{ $bahan->id }}">{{ $bahan->nama }}</option>
            @endforeach
        </select>
        <div class="input-group mb-2 mr-2 w-25">
            <input type="number" name="jumlahBahan[]" class="form-control" step="any" id="inputJumlahBahan" placeholder="Jumlah">
            <div class="input-group-append">
                <span class="input-group-text">buah</span>
            </div>
        </div>
        <button type="button" class="btn btn-outline-danger mb-2 remove-bahan-btn">
            <span class="oi oi-trash"></span>
        </button>
    </div>
@endsection