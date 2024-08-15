<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nomer = $_POST['nomer_hape'];
    $durasi = $_POST['durasiwisata'];
    $peserta = $_POST['peserta'];
    $tanggal_pesanan = date('Y-m-d');
    $tanggal_mulai_wisata = $_POST['tanggal_mulai'];
    $id_pesanan = $_POST['id_pesanan'];

    $layanan_penginapan = isset($_POST['layanan_penginapan']) ? $_POST['layanan_penginapan'] : '';
    $layanan_transportasi = isset($_POST['layanan_transportasi']) ? $_POST['layanan_transportasi'] : '';
    $layanan_makanan = isset($_POST['layanan_makanan']) ? $_POST['layanan_makanan'] : '';

    $biaya = hitungBiaya([$layanan_penginapan, $layanan_transportasi, $layanan_makanan], $durasi, $peserta);
    $hasil = $biaya['hasil'];
    $seluruh = $biaya['seluruh'];

    // Jika id_pesanan ada, lakukan update; jika tidak ada, lakukan insert
    if (!empty($id_pesanan)) {
        $stmt = $db->prepare("UPDATE db_umkm_pariwisata SET nama_pemesanan=?, nomor_hape=?, durasi_wisata=?, layanan_penginapan=?, layanan_transportasi=?, layanan_makanan=?, jumlah_peserta=?, harga_paket=?, jumlah_tagihan=?,tanggal_mulai_wisata=? WHERE id_pesanan=?");
        $stmt->bind_param('ssssssssssss', $nama, $nomer, $durasi, $layanan_penginapan, $layanan_transportasi, $layanan_makanan, $peserta, $hasil, $seluruh,$tanggal_pesanan,$tanggal_mulai_wisata, $id_pesanan);
    } else {
        $stmt = $db->prepare("INSERT INTO db_umkm_pariwisata (nama_pemesanan, nomor_hape, durasi_wisata, layanan_penginapan, layanan_transportasi, layanan_makanan, jumlah_peserta, harga_paket, jumlah_tagihan,jumlah_tagihan=?,tanggal_mulai_wisata=?) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?)");
        $stmt->bind_param('sssssssssss', $nama, $nomer, $durasi, $layanan_penginapan, $layanan_transportasi, $layanan_makanan, $peserta, $hasil, $seluruh$tanggal_pesanan,$tanggal_mulai_wisata);
    }

    if ($stmt->execute()) {
        header("Location: table.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}
?>
