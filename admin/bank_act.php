<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$nomor  = $_POST['nomor'];
$pemilik  = $_POST['pemilik'];
$saldo  = $_POST['saldo'];

mysqli_query($koneksi, "insert into bank values (NULL,'$nama', '$nomor', '$pemilik', '$saldo')");
header("location:bank.php");