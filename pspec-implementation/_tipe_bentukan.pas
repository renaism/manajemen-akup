{Untuk referensi tipe bentukan}
program _tipe_bentukan;

type
    Bahan = record
        id_bahan: string;
        nama_bahan: string;
        stok: real;
        satuan: string;
    end;

    Menu = record
        id_menu: string;
        nama_menu: string;
        harga_menu: real;
    end;

    BahanMenu = record
        menu: Menu;
        bahan: Bahan;
        jumlah: real;
    end;

    Pesan = record
        menu: Menu;
        jumlah: integer;

    Tanggal = record
        d: integer;
        m: integer;
        y: integer;
    end;

    Transaksi = record
        id_transaksi: string;
        tgl_transaksi: Tanggal;
        daftar_pesanan: array of Pesan;
        harga_total: real;
    end;

    Pembelian = record
        id_pembelian: string;
        bahan: Bahan;
        jumlah: real;
        harga_pembelian: real;
        tgl_pembelian: Tanggal;
    end;

begin
    
end.