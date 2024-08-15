<?php
include 'koneksi.php'; 
include 'data.php';

if (isset($_POST['id_pesanan'])) {
    $id_pesanan = $_POST['id_pesanan'];
} else {
    echo "ID Pesanan tidak ditemukan.";
    exit;
}

$nama = $_POST['nama'];
$nomer = $_POST['nomer_hape'];
$durasi = $_POST['durasi'];
$peserta = $_POST['peserta'];

// Check the correct name for your input fields
$layanan_penginapan = isset($_POST['layanan_penginapan']) ? $_POST['layanan_penginapan'] : '';
$layanan_transportasi = isset($_POST['layanan_transportasi']) ? $_POST['layanan_transportasi'] : '';
$layanan_makanan = isset($_POST['layanan_makanan']) ? $_POST['layanan_makanan'] : '';

// Function to calculate the biaya (ensure this function exists and returns an array)
$biaya = hasiljumlah([$layanan_penginapan, $layanan_transportasi, $layanan_makanan], $durasi, $peserta);

// Ensure $biaya is an array with 'hasil' and 'seluruh' keys
$hasil = isset($biaya['hasil']) ? $biaya['hasil'] : 0;
$seluruh = isset($biaya['seluruh']) ? $biaya['seluruh'] : 0;

// Sanitize inputs to prevent SQL injection
$id_pesanan = mysqli_real_escape_string($db, $id_pesanan);
$nama = mysqli_real_escape_string($db, $nama);
$nomer = mysqli_real_escape_string($db, $nomer);
$durasi = mysqli_real_escape_string($db, $durasi);
$peserta = mysqli_real_escape_string($db, $peserta);
$layanan_penginapan = mysqli_real_escape_string($db, $layanan_penginapan);
$layanan_transportasi = mysqli_real_escape_string($db, $layanan_transportasi);
$layanan_makanan = mysqli_real_escape_string($db, $layanan_makanan);
$hasil = mysqli_real_escape_string($db, $hasil);
$seluruh = mysqli_real_escape_string($db, $seluruh);

// Adjust column names based on your schema
$query = "UPDATE db_umkm_pariwisata SET 
    nama_pemesanan='$nama',
    nomor_hape='$nomer',
    durasi_wisata='$durasi',
    jumlah_peserta='$peserta',
    layanan_penginapan='$layanan_penginapan',
    layanan_transportasi='$layanan_transportasi',
    layanan_makanan='$layanan_makanan',
    harga_paket='$hasil',
    jumlah_tagihan='$seluruh'
WHERE id_pesanan='$id_pesanan'";

if (mysqli_query($db, $query)) {
    header("Location: table.php");
    exit; // Ensure script exits after redirection
} else {
    echo "Error: " . mysqli_error($db);
}
?>
