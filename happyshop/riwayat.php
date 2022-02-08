<?php 
session_start();
//koneksi database
include 'koneksi.php'; 

//jika tidak ada sesson pelanggan (blm login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login'); </script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>


<html>
<head>
	<title>Riwayat </title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
	
<?php  include 'menu.php'; ?>

<section class="riwayat">
	<div class="container">
		<h3>Riwayat Belanja</h3>
		
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>TANGGAL</th>
					<th>STATUS</th>
					<th>TOTAL</th>
					<th>OPSI</th>
				</tr>
			</thead>
			<tbody>
					<?php
					$nomor=1;
						$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

						$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
						while($pecah = $ambil->fetch_assoc()){
					 ?>
					<tr>
						<td> <?php echo $nomor; ?> </td>
						<td> <?php echo $pecah["tanggal_pembelian"] ?> </td>
						<td> 
							<?php echo $pecah["status_pembelian"] ?>
							<br>
							<?php if (!empty($pecah['resi_pengiriman'])): ?>
								Resi: <?php echo $pecah['resi_pengiriman']; ?>
							<?php endif ?>

						</td>
						<td> Rp. <?php echo number_format($pecah["total_pembelian"] ) ?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">NOTA</a>
							<?php if ($pecah['status_pembelian']=="pending"): ?>

							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Input PEMBAYARAN</a>
							<?php else: ?>
							<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
								Lihat Pembayaran
							</a>

						<?php endif ?>
						</td>
					</tr>

					<?php $nomor++; ?>
				<?php } ?>
				</tbody>
		</table>
	</div>
</section>
</body>
</html>