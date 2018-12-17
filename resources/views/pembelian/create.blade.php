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
                        <input type="number" name="jumlah" class="form-control form-control-lg" step="any" id="inputJumlah" value="@section('jumlah'){{ old('jumlah') }}@show" min="0" max="999999.99" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="satuanBahan">@yield('satuan')</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStok">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" name="harga" required class="form-control form-control-lg" step="1" id="inputHarga" value="@section('harga'){{ old('harga') }}@show" min="0" max="99999999" required>
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
    @foreach ($daftarBahan as $bahan)
        <input type="hidden" id="satuan{{ $bahan->id }}" value="{{ $bahan->satuan }}">
    @endforeach
@endsection
@push('scripts')
    <script>
        function select_bahan(select) {
            console.log("X");
            $(select).parent().find(".input-jumlah-satuan").text(
                $("#satuan" + $(select).val()).val()
            );
        }
        $(document).ready(function() {
            $("#inputBahan").change( function() {
                $("#satuanBahan").text(
                    $("#satuan" + $(this).val()).val()
                );
            });
        });
    </script>
@endpush