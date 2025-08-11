<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$jenis  = $_POST['jenis'];
$kategori  = $_POST['kategori'];
$jumlah  = $_POST['jumlah'];
$keterangan  = $_POST['keterangan'];


$barang = mysqli_query($koneksi,"select * from barang where barang_id='$id'");
$t = mysqli_fetch_assoc($barang);
$stok_lama = $t['perbarui_stok'];

$rek = mysqli_query($koneksi,"select * from stok where stok_id='$stok_lama'");
$r = mysqli_fetch_assoc($rek);

// Kembalikan jumlah ke stok lama

if($t['barang_jenis'] == "masuk"){
	$kembalikan = $r['stok_jumlah'] - $t['barang_nominal'];
	mysqli_query($koneksi,"update stok set stok_jumlah='$kembalikan' where stok_id='$stok_lama'");

}else if($t['barang_jenis'] == "keluar"){
	$kembalikan = $r['stok_jumlah'] + $t['barang_jumlah'];
	mysqli_query($koneksi,"update stok set stok_jumlah='$kembalikan' where stok_id='$stok_lama'");

}


if($jenis == "masuk"){

	$rekening2 = mysqli_query($koneksi,"select * from stok where stok_id='$stok'");
	$rr = mysqli_fetch_assoc($rekening2);
	$jumlah_sekarang = $rr['stok_jumlah'];
	$total = $jumlah_sekarang+$nominal;
	mysqli_query($koneksi,"update stok set stok_jumlah='$jumlah' where stok_id='$stok'");

}elseif($jenis == "keluar"){

	$rekening2 = mysqli_query($koneksi,"select * from stok where stok_id='$stok'");
	$rr = mysqli_fetch_assoc($rekening2);
	$jumlah_sekarang = $rr['stok_jumlah'];
	$total = $jumlah_sekarang-$nominal;
	mysqli_query($koneksi,"update stok set stok_jumlah='$total' where stok_id='$stok'");

}	

mysqli_query($koneksi, "update barang set barang_tanggal='$tanggal', barang_jenis='$jenis', barang_kategori='$kategori', barang_nominal='$jumlah', barang_jumlah='$keterangan', where barang_id='$id'") or die(mysqli_error($koneksi));
header("location:barang.php");