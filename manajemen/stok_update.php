<?php 
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$nomor  = $_POST['nomor'];
$jumlah  = $_POST['jumlah'];
$nominal  = $_POST['nominal'];

mysqli_query($koneksi, "update stok set stok_tanggal='$tanggal', stok_nama='$nama', stok_nomor='$nomor', stok_jumlah='$jumlah', stok_nominal='$nominal' where stok_id='$id'") or die(mysqli_error($koneksi));
header("location:stok.php");