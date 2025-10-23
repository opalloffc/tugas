<?php
$conn = mysqli_connect("localhost", "root", "", "produk"); 
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
