<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "db_umkm_pariwisata";
$db = mysqli_connect($host,$user,'',$database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }
?>