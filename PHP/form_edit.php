<?php
include 'koneksi.php';

if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];
} else {
    echo "ID Pesanan tidak ditemukan.";
    exit;
}

$pesanan = mysqli_query($db, "SELECT * FROM db_umkm_pariwisata WHERE id_pesanan='$id_pesanan'");
$row = mysqli_fetch_array($pesanan);

// Check if $row is valid
if (!$row) {
    echo "Data tidak ditemukan.";
    exit;
}

// Membuat data layanan menjadi dinamis dalam bentuk array
$layanan = array(
    'layanan_penginapan' => 1000000,
    'layanan_transportasi' => 1200000,
    'layanan_makanan' => 500000
);

// Check if 'layanan' exists in $row; if not, use an empty string
$selected_layanan = isset($row['layanan']) ? explode(',', $row['layanan']) : array();

// Membuat function untuk set aktif checkbox
function is_checked($value, $input) {
    return in_array($value, $input) ? 'checked' : '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Pesanan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">Zay</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item"><a class="nav-link" href="main.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="form.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="table.php">Shop</a></li>
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

    <form method="post" action="update.php">
        <input type="hidden" value="<?php echo isset($row['id_pesanan']) ? $row['id_pesanan'] : ''; ?>" name="id_pesanan">
        <table>
            <tr><td>Nama</td><td><input type="text" value="<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>" name="nama"></td></tr>
            <tr><td>Nomer HP/TLP</td><td><input type="text" value="<?php echo isset($row['nomer_hape']) ? $row['nomer_hape'] : ''; ?>" name="nomer_hape"></td></tr>
            <tr><td>Durasi Wisata</td><td><input type="text" value="<?php echo isset($row['durasi']) ? $row['durasi'] : ''; ?>" name="durasi"></td></tr>
            <tr><td>Peserta</td><td><input type="text" value="<?php echo isset($row['peserta']) ? $row['peserta'] : ''; ?>" name="peserta"></td></tr>

            <!-- Tambahkan layanan wisata sebagai checkbox -->
            <tr>
                <td>Layanan Wisata</td>
                <td>
                    <?php
                    foreach ($layanan as $key => $value) {
                        $checked = is_checked($key, $selected_layanan);
                        echo "<input type='checkbox' name='layanan[]' value='$key' $checked> " . ucwords(str_replace('_', ' ', $key)) . " (Rp " . number_format($value, 0, ',', '.') . ")<br>";
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" value="simpan">SIMPAN PERUBAHAN</button>
                    <a href="table.php">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
