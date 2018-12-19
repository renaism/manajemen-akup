@extends('layouts.manajer')

@section('header')
    <span class="oi oi-cart"></span>&nbsp;Pembelian
@endsection
@section('main-content')
    @if(count($daftarPembelian) > 0)
        <a href="/pembelian/create" class="btn btn-lg btn-light mt-2 mb-4">
            <span class="oi oi-plus"></span>&nbsp;Input Pembelian
        </a>
        <table class="table table-light text-dark table-hover my-4" id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Bahan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($daftarPembelian as $pembelian)
                    <tr>
                        <td>{{ $i++ }}</td>
                        
                        @if($pembelian->bahan)
                            <td>{{ $pembelian->bahan->nama }}</td>
                            <td data-order="{{ $pembelian->jumlah }}">{{ rtrim(rtrim($pembelian->jumlah, 0), localeconv()['decimal_point']).' '.$pembelian->bahan->satuan }}</td>
                        @else
                            <td><em class="text-muted">&lt;Bahan Dihapus&gt;</em></td>
                            <td><em class="text-muted">{{ rtrim(rtrim($pembelian->jumlah, 0), localeconv()['decimal_point']).' ?' }}</em></td>
                        @endif
                        <td data-order="{{ $pembelian->harga }}">Rp{{ number_format($pembelian->harga) }},-</td>
                        <td data-order="{{ $pembelian->tanggal }}">{{ date('d F Y', strtotime($pembelian->tanggal)) }}</td>
                        <td>
                            <a class="btn btn-primary" href="/pembelian/{{ $pembelian->id }}/edit">
                                <span class="oi oi-pencil"></span>&nbsp;Edit
                            </a>
                            <button type="button" data-toggle="modal" data-target="#delete{{ $pembelian->id }}" class="btn btn-danger">
                                <span class="oi oi-trash"></span>&nbsp;Hapus
                            </button>
                            <form method="POST" action="{{ action('PembelianController@destroy', $pembelian) }}">
                                @method('DELETE')
                                @csrf
                                @include('inc.delete', ['object' => $pembelian])
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <h3 class="mt-5">Data pembelian kosong</h3>
            <a href="/pembelian/create" class="btn btn-lg btn-outline-light mt-3">
                <span class="oi oi-plus"></span><br>
                Input Pembelian
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
                    "targets": [0,5]}
                ],
                "order": [[4, "desc"]]
            });
            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();
        });
    </script>
@endpush