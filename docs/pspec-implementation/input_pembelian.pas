Program Input_Pembelian
type	
	Tanggal = record
        d: integer;
        m: integer;
        y: integer;
	end;
	
	Bahan = record
        id_bahan: string;
        nama_bahan: string;
        stok: real;
        satuan: string;
	end;
	
	Pembelian = record
		tgl_pembelian: Tanggal;
		bahan: Bahan;
		jumlah: integer;
		harga: real;
	end;
	
Var
	daftar_bahan: array of Bahan;
	
Function cari_bahan(n: nama_bahan):Bahan;
	var
		i := integer;
	begin
		i := 0;
		while (daftar_bahan[i] <> nil) and (n <> daftar_bahan[i].nama_bahan) do
			i := i+1;
		if (n = daftar_bahan[i].nama_bahan) then
			cari_bahan :: daftar_bahan[i];
		else
			cari_bahan :: nil;
	end;
Function buat_pembelian(tgl: Tanggal, b: Bahan, j: integer, h: real): Pembelian;
	var
		p : Pembelian;
	begin
		p.tgl_pembelian := tgl;
		p.bahan := b;
		p.jumlah := integer;
		p.harga := real;
		buat_pembelian := p;
	end;
	
Procedure pembelian_baru();
	var
		b : bahan
		p : Pembelian;
		n : string;
		tgl : Tanggal;
		j : integer;
		h : real;
	begin
		writeln('Cari Bahan');
		readln(n);
		b := cari_bahan(n);
		if (b <> nil) then
			writeln('Tanggal Pembelian : ');
			read(tgl);
			writeln('Jumlah : ');
			read(j);
			writeln('Harga : ');
			read(h);
			p := buat_pembelian(tgl,b,j,h);
		else
			writeln('Pencarian tidak ditemukan.');
	end;
	

begin
	pembelian_baru();
	writeln(p);
end;