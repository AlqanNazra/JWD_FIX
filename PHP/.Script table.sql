CREATE TABLE `db_umkm_pariwisata` (
    `id_pesanan` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `nama_pemesanan` VARCHAR(125) NOT NULL,
    `nomor_hape` VARCHAR(12) NOT NULL,
    `tanggal_mulai_wisata` DATE NOT NULL,
    `tanggal_pesanan` DATETIME NOT NULL,
    `durasi_wisata` INT(11) NOT NULL,
    `id_paket_wisata` INT(11) NOT NULL,
    `layanan_penginapan` char(1) NOT NULL,
    `layanan_transportasi` char(1) NOT NULL,
    `layanan_makanan` char(1) NOT NULL,
    `jumlah_peserta` INT(11) NOT NULL,
    `harga_paket` DECIMAL(10,2) NOT NULL,
    `jumlah_tagihan` DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (`id_pesanan`)
) COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=13;
