<?php 
include '../koneksi.php';
$id  = $_GET['id'];


$barang = mysqli_query($koneksi,"select * from barang where barang_id='$id'");
$t = mysqli_fetch_assoc($barang);
$stok_lama = $t['perbarui_stok'];

$rek = mysqli_query($koneksi,"select * from stok where stok_id='$stok_lama'");
$r = mysqli_fetch_assoc($rek);

$jenis = $t['barang_jenis'];
$nominal = $t['barang_jumlah'];

if($jenis == "Pemasukan"){

	$saldo_sekarang = $r['stok_jumlah'];
	$total = $saldo_sekarang-$nominal;
	mysqli_query($koneksi,"update stok set stok_jumlah='$total' where stok_id='$stok_lama'");

}elseif($jenis == "Pengeluaran"){

	$saldo_sekarang = $r['stok_jumlah'];
	$total = $saldo_sekarang+$nominal;
	mysqli_query($koneksi,"update stok set stok_jumlah='$total' where stok_id='$stok_lama'");

}	


mysqli_query($koneksi, "delete from barang where barang_id='$id'");
header("location:barang.php");