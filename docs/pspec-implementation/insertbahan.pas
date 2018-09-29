program insert_bahan;

uses crt;

type
        Bahan = record
                id_bahan : string;
                nama_bahan : string;
                stok : real;
                satuan : string;
        end;

var
        daftar_bahan : array[0..100] of Bahan;
        i : integer;

begin
        write('Masukkan Id Bahan : ');
        readln(daftar_bahan[i].id_bahan);
        write('Masukkan Nama Bahan : ');
        readln(daftar_bahan[i].nama_bahan);
        write('Id dan nama bahan telah tersimpan');
        readln;
end.