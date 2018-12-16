@extends('layouts.main')

@section('header')
    <span class="oi oi-plus"></span>&nbsp;Insert Bahan
@endsection

@section('main-content')
    <div class="card text-dark mt-4">
        <div class="card-body">
            @section('form-action')
            <form method="POST" action="{{ action('BahanController@store') }}" accept-charset="UTF-8">
            @show
                @csrf
                <div class="form-group">
                    <label for="inputNama">Nama Bahan</label>
                    <input type="text" name="nama" class="form-control form-control-lg" id="inputNama" value="@section('nama'){{ old('nama') }}@show">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputStok">Stok</label>
                        <input type="number" name="stok" class="form-control form-control-lg" step="any" id="inputStok" value="@section('stok'){{ old('stok') }}@show">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputSatuan">Satuan</label>
                        @php($s = (isset($bahan)) ? $bahan->satuan : old('satuan'))
                        <select name="satuan" id="inputSatuan" class="custom-select custom-select-lg">
                            <option value="" disabled selected>Pilih Satuan...</option>
                            <option value="g" @if($s=='g') selected @endif>Gram (g)</option>
                            <option value="kg" @if($s=='kg') selected @endif>Kilogram (kg)</option>
                            <option value="l" @if($s=='l') selected @endif>Liter (L)</option>
                            <option value="buah" @if($s=='buah') selected @endif>Satuan (Buah)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary mt-4">
                    @section('form-submit')
                        Insert
                    @show 
                </button>
                <a href="/bahan" class="btn btn-lg btn-danger float-right mt-4">Cancel</a>
            </form>   
        </div>
    </div>
@endsection