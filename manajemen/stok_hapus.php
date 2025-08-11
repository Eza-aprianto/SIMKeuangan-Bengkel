<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "update barang set perbarui_stok='1' where perbarui_stok='$id'");

mysqli_query($koneksi, "delete from stok where stok_id='$id'");
header("location:stok.php");