<?php

require 'data.php';
require 'koneksi.php'; // Tambahkan koneksi di sini jika belum

$hasil = 0;
$seluruh = 0;
$id_pesanan = 0;
$layanan_penginapan = 'N';
$layanan_transportasi = 'N';
$layanan_makanan = 'N';




function hitungBiaya($layanan, $durasi, $peserta) {
    $hasil = hasiljumlah($layanan);

    if (is_numeric($hasil) && is_numeric($peserta) && is_numeric($durasi) && $peserta > 0 && $durasi > 0) {
        $seluruh = $hasil * $peserta * $durasi;
        return ['hasil' => $hasil, 'seluruh' => $seluruh];
    }

    return ['hasil' => 0, 'seluruh' => 0];
}

if (isset($_POST['hitungBiaya'])) {
    $durasi = $_POST['durasiwisata'];
    $peserta = $_POST['peserta'];
    $layanan = isset($_POST['layanan']) ? $_POST['layanan'] : [];

    $biaya = hitungBiaya($layanan, $durasi, $peserta);
    $hasil = $biaya['hasil'];
    $seluruh = $biaya['seluruh'];
}
if (isset($_POST['layanan']['penginapan'])) {
    $layanan_penginapan = 'Y';
}

if (isset($_POST['layanan']['transportasi'])) {
    $layanan_transportasi = 'Y';
}

if (isset($_POST['layanan']['makanan'])) {
    $layanan_makanan = 'Y';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nomer = $_POST['nomer_hape'];
    $durasi = $_POST['durasiwisata'];
    $peserta = $_POST['peserta'];
    $tanggal_pesanan = date('Y-m-d');
    $tanggal_mulai_wisata = $_POST['tanggal_mulai'];

    $layanan = isset($_POST['layanan']) ? implode(", ", $_POST['layanan']) : '';

    $biaya = hitungBiaya($_POST['layanan'], $durasi, $peserta);
    $hasil = $biaya['hasil'];
    $seluruh = $biaya['seluruh'];

    // Query insert
    $sql = "INSERT INTO db_umkm_pariwisata (nama_pemesanan, nomor_hape, durasi_wisata, layanan_penginapan, layanan_transportasi, layanan_makanan, jumlah_peserta, harga_paket, jumlah_tagihan, tanggal_pesanan, tanggal_mulai_wisata)
            VALUES ('$nama', '$nomer', '$durasi', '$layanan_penginapan', '$layanan_transportasi', '$layanan_makanan', '$peserta', '$hasil', '$seluruh', '$tanggal_pesanan', '$tanggal_mulai_wisata')";

    if ($db->query($sql) === TRUE) {
        echo "Data berhasil disimpan";
        header("Location: main.html"); 
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
<nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
                Bandung barat
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="main.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form.php">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="table.php">Daftar Pesanan</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Paket Wisata</title>
    <link rel="stylesheet" href="style_form.css">
</head>
<body>
    <div class="form_kotanier">
    <form action="" method="POST">
        <fieldset>
        <?php if ($id_pesanan): ?>
        <div class="form-group">
            <label for="id_pesanan">ID Pemesanan Anda:</label>
            <input type="text" name="id_pesanan" value="<?php echo $id_pesanan; ?>" readonly>
         </div>
            <?php endif; ?>
         
            <div class="Nama">
                <label for="nama">Nama: </label> <br>
                <input type="text" name="nama" placeholder="nama lengkap" required/>
            </div>
            <div class="Durasi">
                <label for="nomer_hape">Nomer HP/Telp: </label> <br>
                <input type="text" name="nomer_hape" placeholder="Nomer HP/Telp" required/>
            </duv>
            <div class="Durasi">
                <label for="durasiwisata">Durasi wisata: </label> <br>
                <input type="text" name="durasiwisata" required/>
            </div>
            <div class="form-group">
                <label for="tanggal_pesan">Tanggal Pesanan:</label>
                <input type="text" name="tanggal_pesan" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai Wisata:</label>
                <input type="date" name="tanggal_mulai" required>
            </div>
            <div class="layanan">
             <label for="layanan">Layanan wisata: </label> <br>
                <div>
                    <label>Penginapan (1.000.000)</label>
                    <input type="checkbox" name="layanan[penginapan]" value="1000000"> Penginapan
                </div>
                <div>
                    <label>Transportasi (1.200.000)</label>
                    <input type="checkbox" name="layanan[transportasi]" value="1200000"> Transportasi
                </div>
                <div>
                    <label>Servis/makan (500.000)</label>
                    <input type="checkbox" name="layanan[makanan]" value="500000"> Servis/makan
                </div>
            </div>


            <div class="perseta">
                <label for="peserta">Jumlah Peserta: </label> <br>
                <input type="text" name="peserta" placeholder="peserta" required/>
            </div>

            <div class="Total">
                <label for="hasil">Total Hasil Layanan: </label> <br>
                <input type="text" name="hasil" value="<?php echo number_format($hasil, 0, ',', '.'); ?>" readonly/>
            </div>
            <div class="Total">
                <label for="seluruh">Total Biaya Keseluruhan: </label> <br>
                <input type="text" name="seluruh" value="<?php echo number_format($seluruh, 0, ',', '.'); ?>" readonly/>
            </div>
            <div class="input">
                <input type="submit" href="index.html" name="simpan" value="SIMPAN">
                <input type="submit" name="hitungBiaya" value="Jalankan Fungsi">
                <input type="reset" value="Reset">
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>

