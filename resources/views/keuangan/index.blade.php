@extends('layouts.main')

@section('header')
    <span class="oi oi-spreadsheet"></span>&nbsp;Rekap Keuangan
@endsection
@section('main-content')
    <div class="d-flex justify-content-between">
        <form method="GET" action="{{ action('RekapKeuanganController@index') }}" accept-charset="UTF-8">
            <div class="form-inline">
                <label class="mb-2 mr-sm-2 col-form-label-lg">Dari tanggal</label>
                <input type="date" name="tgl_start" class="form-control form-control-lg mb-2 mr-sm-2" value="{{ $rekapKeuangan->tgl_start ?? null}}">
                <label class="mb-2 mr-sm-2 col-form-label-lg">sampai tanggal</label>
                <input type="date" name="tgl_end" class="form-control form-control-lg mb-2 mr-sm-2" value="{{ $rekapKeuangan->tgl_end ?? null}}">
                <button type="submit" class="btn btn-primary btn-lg mb-2">Rekap</button>
            </div>
        </form>
        @isset($rekapKeuangan->daftarRekap[0])
            <button type="button" class="btn btn-lg btn-light mb-2"><span class="oi oi-print"></span></button>
        @endisset
    </div>
    @isset($rekapKeuangan)
        @if($rekapKeuangan->daftarRekap->count() > 0)
        <table class="table table-light text-dark table-bordered my-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Detail</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($rekapKeuangan->daftarRekap as $rekap)
                    @if ($rekap->jenis == 'Penjualan')
                        <tr class="table-warning">
                            @php($c = $rekap->daftarMenu->count())
                            <td rowspan="{{ $c }}">{{ $i++ }}</td>
                            <td rowspan="{{ $c }}">{{ date('d F Y', strtotime($rekap->tanggal)) }}</td>
                            <td rowspan="{{ $c }}">{{ $rekap->jenis }}</td>
                            <td>{{ $rekap->daftarMenu[0]->nama }}</td>
                            <td>{{ $rekap->daftarMenu[0]->pivot->jumlah }}</td>
                            <td rowspan="{{ $c }}" class="text-right">{{ $rekap->hargaTotal() }}</td>
                        </tr>
                        @foreach ($rekap->daftarMenu as $menu)
                            @if($loop->first)
                                @continue
                            @endif
                            <tr class="table-warning">
                                <td>{{ $menu->nama }}</td>
                                <td>{{ $menu->pivot->jumlah }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="table-success">
                            <td>{{ $i++ }}</td>
                            <td>{{ date('d F Y', strtotime($rekap->tanggal)) }}</td>
                            <td>{{ $rekap->jenis }}</td>
                            <td>{{ $rekap->bahan->nama }}</td>
                            <td>{{ $rekap->jumlah }}</td>
                            <td class="text-right">{{ $rekap->harga }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless text-dark text-right m-0">
                        <tr>
                            <td><strong>Pemasukan</strong></td>
                            <td>{{ $rekapKeuangan->pemasukan }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pengeluaran</strong></td>
                            <td>{{ $rekapKeuangan->pengeluaran }}</td>
                        </tr>
                        <tr>
                            <td><strong>Keuntungan</strong></td>
                            <td>{{ $rekapKeuangan->keuntungan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @else
            <div class="text-center">
                <h3 class="mt-5">Tidak ada transaksi/pembelian pada periode tersebut. Silahkan pilih tanggal lain.</h3>
            </div>
        @endif
    @else
        <div class="text-center">
            <h3 class="mt-5">Silahkan pilih periode rekapitulasi terlebih dahulu.</h3>
        </div>
    @endisset
@endsection