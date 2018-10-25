@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ action('BahanController@store') }}" accept-charset="UTF-8">
        @csrf
        <div class="card black-text" style="margin-top: 48px">
            <div class="card-content">
                <span class="card-title">Insert Bahan</span>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="nama" data-length="100">
                        <label>Nama Bahan</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <input type="number" name="stok" step="any" min="0">
                        <label>Stok Awal</label>
                    </div>
                    <div class="input-field col s9">
                        <select name="satuan">
                            <option value="" disabled selected>Pilih Satuan</option>
                            <option value="g">gram (g)</option>
                            <option value="kg">kilogram (kg)</option>
                            <option value="l">liter (l)</option>
                            <option value="sat">satuan</option>
                        </select>
                        <label>Satuan</label>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="waves-effect waves-light btn">Insert</button>
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