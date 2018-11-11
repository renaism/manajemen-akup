<?php

namespace Tests\Unit;

use App\Bahan;
use App\Http\Controllers\BahanController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BahanTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testAcceptExample()
    {
        // Create bahan with stok in both acceptable extreme
        $bahan_lb = factory('App\Bahan')->make([
            'stok' => 0
        ]);
        $bahan_up = factory('App\Bahan')->make([
            'stok' => 999999.99
        ]);

        $this->call('POST', 'bahan', [
            'nama' => $bahan_lb->nama,
            'satuan' => $bahan_lb->satuan,
            'stok' => $bahan_lb->stok
        ]);

        $this->call('POST', 'bahan', [
            'nama' => $bahan_up->nama,
            'satuan' => $bahan_up->satuan,
            'stok' => $bahan_up->stok
        ]);

        // Get created bahan
        $daftar_bahan = Bahan::all();

        // Assertion
        $this->assertCount(2, $daftar_bahan);
    }

    public function testRejectExample()
    {
        // Create bahan with stok in both unacceptable extreme
        $bahan_lb = factory('App\Bahan')->make([
            'stok' => -0.01
        ]);
        $bahan_up = factory('App\Bahan')->make([
            'stok' => 1000000.00
        ]);

        $this->call('POST', 'bahan', [
            'nama' => $bahan_lb->nama,
            'satuan' => $bahan_lb->satuan,
            'stok' => $bahan_lb->stok
        ]);

        $this->call('POST', 'bahan', [
            'nama' => $bahan_up->nama,
            'satuan' => $bahan_up->satuan,
            'stok' => $bahan_up->stok
        ]);

        // Try to get bahan
        $daftar_bahan = Bahan::all();

        // Assertion
        $this->assertCount(0, $daftar_bahan);
    }
}
