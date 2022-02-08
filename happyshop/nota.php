<?php 
session_start();
include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>nota pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">

</head>
<body>

	<!-- navbar -->
<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
		

		<!-- nota disini copas aja dr nota yang ada di admin -->
				<h2>Detail Pembelian </h2>
		<?php

		$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON
				pembelian.id_pelanggan=pelanggan.id_pelanggan 
				WHERE pembelian.id_pembelian='$_GET[id]'"); 
		$detail = $ambil->fetch_assoc();		
		?>
<!--jika pelanggan tidak sama dgn lgin maka dilarikan ke riwayat karena dia tidak berhak melihat nota orang lain-->
<?php
	$idpelangganyangbeli = $detail["id_pelanggan"];

	$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
	if ($idpelangganyangbeli!==$idpelangganyanglogin)
	{
		echo "<script>alert('jangan Nakal');</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}
 ?>
	
		<p>
			<?php echo $detail['telepon_pelanggan']; ?> <br>
			<?php echo $detail['email_pelanggan']; ?> <br>
		</p>

		<p>

			tanggal:<?php echo $detail['tanggal_pembelian']; ?> <br>
			total: <?php echo $detail['total_pembelian']; ?>
		</p>
	<div class ="row">
		<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No. Pembelian: <?php echo $detail['id_pembelian'] ?></strong></br>
		Tanggal: <?php echo $detail['tanggal_pembelian'];  ?> <br>
			Total: Rp. <?php echo number_format( $detail['total_pembelian']) ?> <br>
		</div>
		<div class="col-md-4">
			<h3>Pelanggan</h3>
				<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
				<p>
			<?php echo $detail['telepon_pelanggan']; ?> <br>
			<?php echo $detail['email_pelanggan']; ?> <br>
		</p>
		</div>
		<div class="col-md-4">
			<h3>Pengiriman</h3>
			<strong><?php echo $detail['nama_kota'] ?></strong><br>
			Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
			Alamat: <?php echo $detail['alamat_pengiriman']; ?>
		</div>
	</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>no</th>
					<th>nama produk</th>
					<th>harga</th>
					<th>berat</th>
					<th>jumlah</th>
					<th>subberat</h2>
					<th>subtotal</th>
				</tr>
			</thead>
			</tbody>
				<?php $nomor=1; ?>
				<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
				<?php while($pecah = $ambil->fetch_assoc()){ ?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah['nama']; ?></td>
					<td>RP. <?php echo number_format($pecah['harga']); ?></td>
					<td><?php echo $pecah['berat']; ?> Gr.</td>
					<td><?php echo $pecah['jumlah']; ?></td>
					<td><?php echo $pecah['subberat']; ?> Gr.</td>
					<td>Rp. <?php echo number_format ($pecah['subharga']); ?></td>
				</tr>
				<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		</table>

<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan Melakukan pembayaran Rp <?php echo number_format($detail['total_pembelian']); ?> Ke <br>
				<strong> BANK MANDIRI 137-001088-3276 An. Meramorfosisi Team </strong>
			</p>
		</div>
	</div>
</div>

	</div>
</section>

</body>
</html>