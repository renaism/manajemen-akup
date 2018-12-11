@extends('layouts.main')

@section('header', 'Insert Menu')
@section('main-content')
    <div class="card text-dark mt-4">
        <div class="card-body">
            @section('form-action')
            <form method="POST" action="{{ action('MenuController@store') }}" accept-charset="UTF-8">
            @show
                @csrf
                <div class="form-group">
                    <label for="inputNama">Nama Menu</label>
                    <input type="text" name="nama" class="form-control form-control-lg" id="inputNama" value="@section('nama'){{ old('nama') }}@show">
                </div>
                <div class="form-group">
                    <label for="inputStok">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" name="harga" class="form-control form-control-lg" step="any" id="inputHarga" value="@section('harga'){{ old('harga') }}@show">
                    </div>
                </div>
                <label>Daftar Bahan</label>
                <div id="daftarBahan">
                    @yield('daftar-bahan')
                </div>
                <div class="form-group mt-2">
                    <button type="button" id="addBahanBtn" class="btn btn-outline-dark"><span class="oi oi-plus"></span>&nbsp;Bahan</button>
                </div>
                <button type="submit" class="btn btn-lg btn-primary mt-4">
                    @section('form-submit')
                        Insert
                    @show 
                </button>
                <a href="/menu" class="btn btn-lg btn-danger float-right mt-4">Cancel</a>
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
@section('script')
    <script>
        $("#addBahanBtn").click(function(e) {
            e.preventDefault();
            $(".bahan-template").clone().removeClass("bahan-template d-none").appendTo("#daftarBahan");
        });
        $("#daftarBahan").on("click", ".remove-bahan-btn", function(e) {
            e.preventDefault();
            $(this).parent().remove();
        })
    </script>
@endsection