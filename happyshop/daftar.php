<?php  include 'koneksi.php'; ?>

<html>
<head>
	<title>Daftar</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
	
<?php  include 'menu.php'; ?>
<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"> Daftar Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="POST" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama" required>
								</div>
							</div>
								<div class="form-group">
									<label class="control-label col-md-3">Email</label>
									<div class="col-md-7">
										<input type="email" class="form-control" name="email" required>
									</div>
								</div>
									<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="password" required>
								</div>
							</div>

								<div class="form-group">
								<label class="control-label col-md-3">ALAMAT</label>
								<div class="col-md-7">
									<textarea class="form-control" name="alamat"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Telepon</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="telepon" required>
								</div>
							</div>
							<div class="form-group">
									<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="daftar"> Daftar</button>
								</div>
						
							</div>
						</form>
						<?php 

							if (isset($_POST["daftar"]))
							{
								$id_pelanggan=$_POST["id_pelanggan"];
								$nama = $_POST["nama"];
								$email = $_POST["email"];
								$password = $_POST["password"];
								$alamat = $_POST["alamat"];
								$telepon = $_POST["telepon"];

								$ambil = $koneksi->query("SELECT*FROM Pelanggan WHERE email_pelanggan='$email'");
								$yangcocok = $ambil->num_rows;
								if ($yangcocok==1)
								{
									echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
									echo "<script>location='daftar.php';</script>";
								}
								else
								{
									$koneksi->query("INSERT INTO pelanggan(id_pelanggan, email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan)
									VALUES ('$id_pelanggan','$email', '$password', '$nama', '$telepon', '$alamat')");

									echo "<script>alert('Pendaftaran sukses, silahkan login');</script>";
									echo "<script>location='login.php';</script>";
								}

							}
						?>

						
				</div>
			</div>
		</div>
</div>
</body>
</html>