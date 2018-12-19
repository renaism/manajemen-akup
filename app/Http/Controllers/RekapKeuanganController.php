<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\RekapKeuangan;
use App\Pembelian;
use App\Transaksi;

class RekapKeuanganController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->tgl_start, $request->tgl_end)) {
            return view('keuangan.index');
        } 

        $this->validate($request, [
            'tgl_start' => 'required',
            'tgl_end' => 'required'
        ]);

        if ($request->tgl_end < $request->tgl_start) {
            $tmp = $request->tgl_end;
            $request->tgl_end = $request->tgl_start;
            $request->tgl_start = $tmp;
        }

        $rekapKeuangan = new RekapKeuangan;
        $rekapKeuangan->tgl_start = $request->tgl_start;
        $rekapKeuangan->tgl_end = $request->tgl_end;

        // Mendapatkan daftar transaksi dan pembelian dari tanggal yang ditentukan
        $daftarTransaksi = Transaksi::whereBetween(DB::raw('date(tanggal)'), [$request->tgl_start, $request->tgl_end])->orderBy('tanggal', 'asc')->get();
        $daftarPembelian = Pembelian::whereBetween('tanggal', [$request->tgl_start, $request->tgl_end])->orderBy('tanggal', 'asc')->get();
        
        $daftarRekap = collect();

        // Hitung pemasukan dari daftar transaksi
        $rekapKeuangan->pemasukan = 0;
        foreach ($daftarTransaksi as $transaksi) {
            $transaksi->jenis = 'Penjualan';
            $daftarRekap->push($transaksi);
            foreach ($transaksi->daftarMenu as $menu) {
                $rekapKeuangan->pemasukan += $menu->pivot->harga * $menu->pivot->jumlah;
            }
        }

        // Hitung pengeluaran dari daftar pembelian
        $rekapKeuangan->pengeluaran = 0;
        foreach ($daftarPembelian as $pembelian) {
            $pembelian->jenis = 'Pembelian';
            $daftarRekap->push($pembelian);
            $rekapKeuangan->pengeluaran += $pembelian->harga;
        }

        // Hitung keuntungan dari pemasukan dan pengeluaran
        $rekapKeuangan->keuntungan = $rekapKeuangan->pemasukan - $rekapKeuangan->pengeluaran;

        // Menyatukan data transaksi dan pembelian sehingga terurut berdasarkan tanggal
        $rekapKeuangan->daftarRekap = $daftarRekap->sortBy(function($value, $key) {
            return $value->tanggal;
        });

        return view('keuangan.index')->with('rekapKeuangan', $rekapKeuangan);
    }
}
