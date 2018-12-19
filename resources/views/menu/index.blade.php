@extends('layouts.manajer')

@section('header')
    <span class="oi oi-fire"></span>&nbsp;Kelola Menu
@endsection
@section('main-content')
    @if(count($daftarMenu) > 0)
        <a href="/menu/create" class="btn btn-lg btn-light mt-2 mb-4">
            <span class="oi oi-plus"></span>&nbsp;Insert Menu
        </a>
        <div class="row text-dark">
            @foreach ($daftarMenu as $menu)
                <div class="col-4 col-xl-3 mb-4">
                    <div class="card menu h-100">
                        <img src="{{ asset('storage/menu/gambar/'.$menu->gambar) }}" onError="this.onerror=null;this.src='{{ asset('menu_default.jpg') }}';" class="card-img-top menu-image">
                        <div class="menu-action-button text-white w-100">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-outline-light mt-2 mr-2 shadow"><span class="oi oi-menu"></button>
                            </div>
                        </div>
                        <div class="card-img-overlay menu-action">
                            <div class="d-flex flex-column">
                                <a class="btn btn-primary shadow mb-3" href="/menu/{{ $menu->id }}/edit">
                                    <span class="oi oi-pencil"></span>&nbsp;Edit
                                </a>
                                <button type="button" data-toggle="modal" data-target="#delete{{ $menu->id }}" class="btn btn-danger shadow">
                                    <span class="oi oi-trash"></span>&nbsp;Hapus
                                </button>
                                <form method="POST" action="{{ action('MenuController@destroy', $menu) }}">
                                    @method('DELETE')
                                    @csrf
                                    @include('inc.delete', ['object' => $menu])
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama }}</h5>
                            <p class="card-text">
                                @foreach ($menu->daftarBahan as $bahan)
                                    {{ $bahan->nama }}@if(!$loop->last){{ ', ' }}@endif
                                @endforeach
                            </p>
                            <p class="card-text d-none"><small class="text-muted">Rp{{ number_format($menu->harga) }},-</small></p>
                        </div>
                        <div class="card-footer">
                            Rp{{ number_format($menu->harga) }},-
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <table class="table table-light text-dark table-hover my-4 d-none" id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($daftarMenu as $menu)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $menu->nama }}</td>
                        <td>Rp{{ number_format($menu->harga) }}</td>
                        <td>
                            <a class="btn btn-primary float-right" href="/menu/{{ $menu->id }}/edit">
                                <span class="oi oi-pencil"></span>&nbsp;Edit
                            </a>
                        </td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#delete{{ $menu->id }}" class="btn btn-danger">
                                <span class="oi oi-trash"></span>&nbsp;Hapus
                            </button>
                            <form method="POST" action="{{ action('MenuController@destroy', $menu) }}">
                                @method('DELETE')
                                @csrf
                                @include('inc.delete', ['object' => $menu])
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <h3 class="mt-5">Data menu kosong</h3>
            <a href="/menu/create" class="btn btn-lg btn-outline-light mt-3">
                <span class="oi oi-plus"></span><br>
                Insert Menu
            </a>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".menu").each(function() {
                $(this).children(".menu-action").hide();
                $(this).children(".menu-action-button").hide();
            });
            
            $(".menu").hover(function() {
                $(this).children(".menu-action-button").fadeIn();
            }, function() {
                $(this).children(".menu-action-button").fadeOut();
                $(this).children(".menu-action").fadeOut();
            });

            $(".menu-action-button button").click(function() {
                $(this).parent().parent().hide();
                $(this).parent().parent().siblings(".menu-action").fadeIn();
            });
        });
    </script>
@endpush