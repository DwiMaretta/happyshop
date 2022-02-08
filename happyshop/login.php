<?php 
 session_start();
 $koneksi = new mysqli("localhost","root","","apbo");
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<?php include 'menu.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-mmd-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Login Pelanggan</h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>

						<button class="btn btn-primary" name="simpan">Login</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php 
//jika ada tombol simpan (tombol simpan ditekan)
if (isset ($_POST["simpan"]))
{
	$email = $_POST["email"];
	$password =$_POST["password"];
	//lakukan query ngecek akun di tabel pelanggan di db
	$ambil =$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan ='$email' AND password_pelanggan='$password'");

	//ngitung akun yg terambil
	$akunyangcocok =$ambil->num_rows;

	//jika 1 akun yang cocok, maka diloginkan
	if ($akunyangcocok==1) 
	{
		//anda sukses login
		//mendapatkan akun dlm bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan disession pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda sukses login');</script>";
		
		//jk sudah belanja
		if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
		{
			echo "<script>location='checkout.php';</script>";
		}
		else
		{
			echo "<script>location='index.php';</script>";
		}
	}
	else
	{
		//anda gagal login
		echo "<script>alert('anda gagal login, periksa akun anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}
 ?>


</body>
</html>