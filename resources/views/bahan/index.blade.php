@extends('layouts.main')

@section('main-content')
    <h3>Daftar Bahan</h3>
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="/bahan/create">Insert Bahan</a>
            @if(count($daftarBahan) > 0)
                <table class="table table-dark table-hover">
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
                                    <a class="btn btn-primary" href="/bahan/{{ $bahan->id }}/edit">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ action('BahanController@destroy', $bahan->id) }}" class="left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
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