@extends('layouts.main')

@section('header')
    <span class="oi oi-fire"></span>&nbsp;Kelola Menu
@endsection
@section('main-content')
    @if(count($daftarMenu) > 0)
        <a href="/menu/create" class="btn btn-lg btn-light mt-2">
            <span class="oi oi-plus"></span>&nbsp;Insert Menu
        </a>
        <table class="table table-light text-dark table-hover my-4">
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
                        <td>Rp {{ $menu->harga }}</td>
                        <td>
                            <a class="btn btn-primary float-right" href="/menu/{{ $menu->id }}/edit">
                                <span class="oi oi-pencil"></span>&nbsp;Edit
                            </a>
                        </td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#delete{{ $menu->id }}" class="btn btn-danger">
                                <span class="oi oi-trash"></span>&nbsp;Hapus
                            </button>
                            <form method="POST" action="{{ action('MenuController@destroy', $menu->id) }}">
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