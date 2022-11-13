<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image :url(index.jpg);
  			background-repeat: no-repeat;
            color:#fff;">
	<?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:index.php?pesan=gagal");
	}

	?>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="halaman_admin.php">SkyResto TreeTop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
      <a type="button" class="btn btn-dark" href="penjualan.php">Penjualan</a><br>
      <a type="button" class="btn btn-dark" href="pengeluaran.php">Pengeluaran</a><br>
      <a type="button" class="btn btn-dark" href="barang.php">Data Barang</a><br>
      <a type="button" class="btn btn-dark" href="karyawan.php">Data Karyawan</a><br>
      <a type="button" class="btn btn-dark" href="produk.php">Data Produk</a><br> <br> <br> <br>
      </div>
    </div>
  </div>
</nav>

<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
  </ol>
</nav>
<br>
	<?php
	include 'koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from karyawan where id='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		<div class="container">
		<form method="post" action="updatekaryawan.php">
			<table>
						<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
					<div id="emailHelp" class="form-text">Nama Karyawan</div>
						<input type="text" class="form-control" name="nama" value="<?php echo $d['nama']; ?>"><br>
					<div class="input-group mb-3"><br>	
						<label class="input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
  							<select class="form-select" id="inputGroupSelect01" name="jenkel" value="<?php echo $d['jenkel']; ?>">
   								<option value="1"></option>
    							<option value="Laki-Laki">Laki-Laki</option>
  								<option value="Perempuan">Perempuan</option>
 						 </select>
					</div>
					<div id="emailHelp" class="form-text">No. Whatsapps</div>
        				<input type="text" class="form-control" name="nohp" value="<?php echo $d['nohp']; ?>">
  					  <div id="emailHelp" class="form-text">Alamat</div>
       					<input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat']; ?>"><br>
       				<div class="input-group mb-3"><br>
 						<label class="input-group-text" for="inputGroupSelect01">Bagian</label>
  							<select class="form-select" id="inputGroupSelect01" name="status" value="<?php echo $d['status']; ?>">
 								<option value="1"></option>
   								<option value="Dapur">Dapur</option>
   								<option value="Kasir">Kasir</option>
   								<option value="Deck">Deck</option>
 							 </select></div><br>
					<td></td>
					<td><input type="submit" value="SIMPAN"></td>
				</tr>		
			</table>
		</form>
		<?php 
	}
	?>
	</div>
<script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>