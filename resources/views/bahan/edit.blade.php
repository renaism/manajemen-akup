@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ action('BahanController@update', $bahan->id) }}" accept-charset="UTF-8">
        @method('PUT')
        @csrf
        <div class="card black-text" style="margin-top: 48px">
            <div class="card-content">
                <span class="card-title">Update Bahan</span>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="nama" data-length="100", value='{{ $bahan->nama }}'>
                        <label>Nama Bahan</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <input type="number" name="stok" step="any" min="0" value='{{ $bahan->stok }}'>
                        <label>Stok Awal</label>
                    </div>
                    <div class="input-field col s9">
                        <select name="satuan">
                            <option value="" disabled>Pilih Satuan</option>
                            <option value="g" @if($bahan->satuan=='g') selected @endif>gram (g)</option>
                            <option value="kg" @if($bahan->satuan=='kg') selected @endif>kilogram (kg)</option>
                            <option value="l" @if($bahan->satuan=='l') selected @endif>liter (l)</option>
                            <option value="sat" @if($bahan->satuan=='sat') selected @endif>satuan</option>
                        </select>
                        <label>Satuan</label>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="waves-effect waves-light btn">Update</button>
                <a class="waves-effect waves-light btn red right" href="/bahan">Cancel</a>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, {});
        });
    </script>
@endsection