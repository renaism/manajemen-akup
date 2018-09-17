program input_transaksi;

type
    Bahan = record
        id_bahan: string;
        nama_bahan: string;
        stok: real;
        satuan: string;
    end;

    BahanMenu = record
        bahan: Bahan;
        jumlah: real;
    end;

    Menu = record
        id_menu: string;
        nama_menu: string;
        harga_menu: real;
        daftar_bahan: array of BahanMenu;
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

var
    daftar_transaksi: array of Transaksi;
    daftar_bahan: array of Bahan;
    daftar_menu: array of Menu;
    new_transaksi: Transaksi;
    pesan_lagi: string;
    stok_cukup: boolean;
    i: integer;

procedure pilih_menu(var d_pesanan: array of Pesan);
var
    n_menu: string;
    i, jml: integer;
    p: Pesan;
begin
    // Input nama menu yang ingin dipesan
    write('Nama menu: ');
    readln(n_menu);
    // Cari menu di daftar menu
    i := 0;
    while (i < length(daftar_menu) and daftar_menu[i] <> n_menu) do
        i := i+1;
    // Jika ketemu, input jumlah yang ingin dipesan
    if (daftar_menu[i] = n_menu) then
    begin
        write('Jumlah: ');
        readln(jml);
        // Bikin instansi pesan baru
        p.menu := daftar_menu[i];
        p.jumlah := jml;
        // Masukkan pesan ke daftar pesanan
        setlength(d_pesanan, length(d_pesanan) + 1);
        d_pesanan[length(d_pesanan) - 1] := p;
    end;
end;

function cari_bahan(b: Bahan, d_bahan: array of Bahan): integer;
var
    i: integer;
begin
    i := 0;
    while (i < length(d_bahan)) and (b.id_bahan <> d_bahan[i].id_bahan) do
        i := i + 1;
    if b.id_bahan = d_bahan[i].id_bahan then
        cari_bahan := i
    else
        cari_bahan := -1;
end;

function cek_ketersediaan(d_pesanan: array of Pesan): boolean;
var
    d_bahan: array of Bahan;
    m: Menu;
    i_b: Bahan;
    i, j, jml, jml_tot: integer;
begin
    d_bahan := daftar_bahan;
    for i := 0 to length(d_pesanan) do
    begin
        m := d_pesanan[i].menu;
        jml := d_pesanan[i].jumlah;
        for j := 0 to length(m.daftar_bahan) do
        begin
            i_b := cari_bahan(m.daftar_bahan[i].bahan, d_bahan); 
            jml_tot := jml * m.daftar_bahan[i].jumlah;
            if jml_tot <= d_bahan[i_b].stok then
                d_bahan[i_b].stok := d_bahan[i_b].stok - jml_tot
            else
                cek_ketersediaan := false;
        end;
    end;
    cek_ketersediaan := true;
end;

procedure proses_transaksi(t: Transaksi)
var
    d_pesanan: array of Pesan;
    i, j: integer;
begin
    d_pesanan := t.daftar_pesanan;
    for i := 0 to length(d_pesanan) do
    begin
        m := d_pesanan[i].menu;
        jml := d_pesanan[i].jumlah;
        for j := 0 to length(m.daftar_bahan) do
        begin
            i_b := cari_bahan(m.daftar_bahan[i].bahan, daftar_bahan); 
            jml_tot := jml * m.daftar_bahan[i].jumlah;
            daftar_bahan[i_b].stok := d_bahan[i_b].stok - jml_tot
        end;
    end;
    setlength(daftar_transaksi, length(daftar_transaksi) + 1);
    daftar_transaksi[length(daftar_transaksi) - 1] := t;
end;

procedure transaksi_baru();
var
    t: Transaksi;
begin
    // Inisialisasi transaksi baru
    t.id_transaksi = "TRXXXXX";
    setlength(t.daftar_pesanan, 0);
    // Input menu sampai selesai
    repeat
        pilih_menu(t.daftar_pesanan);
        write('Tambah menu? (y/n): ');
        readln(pesan_lagi);    
    until (pesan_lagi <> 'y');
    stok_cukup := cek_ketersediaan(t.daftar_pesanan);
    if stok_cukup then
        proses_transaksi(t);
end;

begin
    setlength(daftar_transaksi, 0);
    write('Tekan enter untuk menginput transaksi baru...');
    readln;
    transaksi_baru();
end.
