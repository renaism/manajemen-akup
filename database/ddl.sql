CREATE TABLE menu (
    id_menu INT NOT NULL AUTO_INCREMENT,
    nama_menu VARCHAR(50),
    harga_menu INT NOT NULL,
    PRIMARY KEY (id_menu)
);

CREATE TABLE bahan (
    id_bahan INT NOT NULL AUTO_INCREMENT,
    nama_bahan VARCHAR(50),
    harga_menu INT NOT NULL,
    satuan VARCHAR(20),
    stok DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (id_bahan)
);

CREATE TABLE mengandung (
    id_menu INT,
    id_bahan INT,
    jumlah INT NOT NULL,
    FOREIGN KEY (id_menu) REFERENCES menu(id_menu),
    FOREIGN KEY (id_bahan) REFERENCES bahan(id_bahan)
);

CREATE TABLE transaksi (
    id_transaksi INT NOT NULL AUTO_INCREMENT,
    tgl_transaksi DATETIME NOT NULL,
    harga_total DECIMAL(13, 2) NOT NULL,
    PRIMARY KEY (id_transaksi)
);

CREATE TABLE pesan (
    id_transaksi INT,
    id_menu INT,
    jumlah INT NOT NULL,
    harga_sub DECIMAL(13, 2) NOT NULL,
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi),
    FOREIGN KEY (id_menu) REFERENCES menu(id_menu)
);

CREATE TABLE pembelian (
    id_pembelian INT NOT NULL AUTO_INCREMENT,
    id_bahan INT,
    tgl_pembelian DATETIME NOT NULL,
    harga_pembelian DECIMAL(13, 2) NOT NULL,
    jumlah INT NOT NULL,
    PRIMARY KEY (id_pembelian),
    FOREIGN KEY (id_bahan) REFERENCES bahan(id_bahan)
);