program input_menu;

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
var
        daftar_menu : array[0..100] of menu;
	i : integer;

begin
	//Input
	write('Id Menu : ');
	readlen(daftar_menu[i].id_menu);
	write('Nama Menu  : ');
	readln(daftar_menu[i].nama_menu);
	write('Harga Menu: ');
	readln(daftar_menu[i].harga_menu);
	write('Input data menu berhasil di inputkan ! (Tekan ENTER)');
	readln;
end;
	
