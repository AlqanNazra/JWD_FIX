<!DOCTYPE html>
<html>
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
    <title>Table Pemesanan Paket Wisata</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
<h2>List Pesanan Wisata</h2>
<table border="1">
    <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>NOMOR HP</th>
        <th>Jumlah Peserta</th>
        <th>Jumlah Hari</th>
        <th>Akomodasi</th>
        <th>Transportasi</th>
        <th>Service/Makanan</th>
        <th>Harga Paket</th>
        <th>Total Tagihan</th>
        <th>Aksi</th>
    </tr>
    <?php
    include 'koneksi.php';

    // Pastikan nama tabel dan kolom sesuai dengan yang ada di database
    $pesanan = mysqli_query($db, "SELECT * FROM db_umkm_pariwisata");
    $no = 1;

    while ($row = mysqli_fetch_assoc($pesanan)) {
        
        echo "<td>{$no}</td>";
        echo "<td>" . $row['nama_pemesanan'] . "</td>";
        echo "<td>" . $row['nomor_hape'] . "</td>";
        echo "<td>" . $row['jumlah_peserta'] . "</td>";
        echo "<td>" . $row['durasi_wisata'] . "</td>";
        echo "<td>" . ($row['layanan_penginapan'] == 'Y' ? 'Y' : 'N') . "</td>";
        echo "<td>" . ($row['layanan_transportasi'] == 'Y' ? 'Y' : 'N') . "</td>";
        echo "<td>" . ($row['layanan_makanan'] == 'Y' ? 'Y' : 'N') . "</td>";
        echo "<td>" . number_format($row['harga_paket'], 0, ',', '.') . "</td>";
        echo "<td>" . number_format($row['jumlah_tagihan'], 0, ',', '.') . "</td>";
        echo "<td>
        <a href='form_edit.php?id_pesanan=".$row['id_pesanan']."' class='buton buton-edit'>Edit</a> |
        <a href='delete.php?hapus=true&id_pesanan=".$row['id_pesanan']."' class='buton buton-delete'
            onclick='return confirm(\"Apakah Anda ingin menghapus data ini\")'>Delete</a>
        </td>";
    echo "</tr>";
    
        $no++;
    }
    ?>
</table>
</body>
</html>
