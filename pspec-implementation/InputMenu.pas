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

begin
	//Input
	write('Id Menu : ');
	readln(menu.id_menu);
	write('Nama Menu  : ');
	readln(menu.nama_menu);
	write('Harga Menu: ');
	readln(menu.harga_menu);
	write('Input data menu berhasil di inputkan ! (Tekan ENTER)');
	readln;
end;
	
