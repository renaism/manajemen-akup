@extends('layouts.app')

@section('content')
    <h3>Daftar Bahan</h3>
    <div class="card black-text">
        <div class="card-content">
            <a class="waves-effect waves-light btn grey darken-3" href="/bahan/create">Insert Bahan</a>
            @if(count($daftarBahan) > 0)
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Bahan</th>
                            <th>Stok</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftarBahan as $bahan)
                            <tr>
                                <td>{{ $bahan->nama }}</td>
                                <td>{{ $bahan->stok }} {{ $bahan->satuan }}</td>
                                <td>
                                    <a class="waves-effect waves-light btn right" href="/bahan/{{ $bahan->id }}/edit">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ action('BahanController@destroy', $bahan->id) }}" class="left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="waves-effect waves-light btn red" href="/bahan/{{ $bahan->id }}/edit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Data bahan kosong</p>
            @endif
        </div>
    </div>
@endsection