<?php
/*
include 'koneksi.php'

$id_pesanan = $_GET['id_pesanan'];
$query ="DELETE from db_umkm_pariwisata where id_pesanan='$id_pesanan'";
mysqli_query($db,$query);
header("location:table.php");

*/
?>
<?php
include 'koneksi.php';

if (isset($_GET['hapus']) && isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];
    $query = "DELETE FROM db_umkm_pariwisata WHERE id_pesanan='$id_pesanan'";

    if (mysqli_query($db, $query)) {
        header("Location: table.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($db);
    }
}
?>
