<?php 
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$nama  = $_POST['nama'];
$nomor  = $_POST['nomor'];
$jumlah = $_POST['jumlah'];
$nominal  = $_POST['nominal'];

mysqli_query($koneksi, "insert into stok values (NULL,'$tanggal','$nama','$nomor','$jumlah','$nominal')");
header("location:stok.php");