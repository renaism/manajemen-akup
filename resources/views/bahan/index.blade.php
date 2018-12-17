@extends('layouts.manajer')

@section('header')
    <span class="oi oi-fire"></span>&nbsp;Kelola Bahan
@endsection
@section('main-content')
    @if(count($daftarBahan) > 0)
        <a href="/bahan/create" class="btn btn-lg btn-light mt-2 mb-4">
            <span class="oi oi-plus"></span>&nbsp;Insert Bahan
        </a>
        <table class="table table-light text-dark table-hover my-4" id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Bahan</th>
                    <th>Stok</th>
                    <th>Terakhir Diupdate</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($daftarBahan as $bahan)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $bahan->nama }}</td>
                        <td>{{ rtrim(rtrim($bahan->stok, 0), localeconv()['decimal_point']).' '.$bahan->satuan }}</td>
                        <td>{{ date('d F Y', strtotime($bahan->updated_at)) }}</td>
                        <td>
                            <a class="btn btn-primary" href="/bahan/{{ $bahan->id }}/edit">
                                <span class="oi oi-pencil"></span>&nbsp;Edit
                            </a>
                            <button type="button" data-toggle="modal" data-target="#delete{{ $bahan->id }}" class="btn btn-danger">
                                <span class="oi oi-trash"></span>&nbsp;Hapus
                            </button>
                            <form method="POST" action="{{ action('BahanController@destroy', $bahan->id) }}">
                                @method('DELETE')
                                @csrf
                                @include('inc.delete', ['object' => $bahan])
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <h3 class="mt-5">Data bahan kosong</h3>
            <a href="/bahan/create" class="btn btn-lg btn-outline-light mt-3">
                <span class="oi oi-plus"></span><br>
                Insert Bahan
            </a>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var t = $("#table").DataTable({
                "columnDefs": [{
                    "orderable": false, 
                    "searchable": false,
                    "targets": [0,4]}
                ]
            });
            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();
        });
    </script>
@endpush