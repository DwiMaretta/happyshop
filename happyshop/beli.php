<?php 
session_start();
//mendapatkan id_produk dari url
$id_produk=$_GET['id'];

//jika sudah ada produk itu di keranjang,maka produk itu jumlah nya di +1
if (isset($_SESSION['keranjang'][$id_produk])) 
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
//selain itu ( blm ada di keranjang) maka produk itu dianggap di beli 1
else
{
	$_SESSION['keranjang'][$id_produk]=1;
}

//larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>
