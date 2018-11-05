@extends('layouts.app')

@section('content')
    <h3>Daftar Menu</h3>
    <div class="card black-text">
        <div class="card-content">
            <a class="waves-effect waves-light btn grey darken-3" href="/menu/create">Insert Menu</a>
            @if(count($daftarMenu) > 0)
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftarMenu as $menu)
                            <tr>
                                <td>{{ $menu->nama }}</td>
                                <td>Rp{{ $menu->harga }},-</td>
                                <td>
                                    <a class="waves-effect waves-light btn right" href="/menu/{{ $menu->id }}/edit">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ action('MenuController@destroy', $menu->id) }}" class="left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="waves-effect waves-light btn red">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Data menu kosong</p>
            @endif
        </div>
    </div>
@endsection