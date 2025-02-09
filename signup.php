<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login Admin</title>

	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">

	<style>
	</style>
</head>

<?php
include 'conn.php';

$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Include file which makes the
	// Database Connection.


	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
	$jenjang = mysqli_real_escape_string($conn, $_POST['jenjang']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);

	$sql = "Select * from tbl_user where username='$username'";

	$result = mysqli_query($conn, $sql);

	$num = mysqli_num_rows($result);

	// This sql query is use to check if
	// the username is already present
	// or not in our Database
	if ($num == 0) {
		if (($password == $password) && $exists == false) {

			// $hash = password_hash($password,
			// 					PASSWORD_DEFAULT);

			// Password Hashing is used here.
			$sql = "INSERT INTO tbl_user (jenjang, name, username,
				password) VALUES ('$jenjang','$name','$username',
				'$password')";

			$result = mysqli_query($conn, $sql);
			if ($result) {
				$showAlert = true;
			}
		} else {
			$showError = "Passwords do not match";
		}
	} // end if

	if ($num > 0) {
		$exists = "Username not available";
	}
} //end if

?>

<!doctype html>

<html lang="en">

<head>

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!-- Icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,
		shrink-to-fit=no">
</head>

<body>

	<?php

	if ($showAlert) {
		echo "<script>alert('ANDA BERHASIL MEMBUAT AKUN')</script>";
		echo "<script>window.location='login.php';</script>";
	}

	if ($showError) {

		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
		<strong>Error!</strong> ' . $showError . '
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close">
			<span aria-hidden="true">×</span>
	</button>
	</div> ';
	}

	if ($exists) {
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
	
		<strong>Error!</strong> ' . $exists . '
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div> ';
	}

	?>

	<body class="bg-gradient-primary">

		<div class="container">

			<!-- Outer Row -->
			<div class="row justify-content-center">

				<div class="col-xl-10 col-lg-12 col-md-9">

					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg">
									<div class="p-5">
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-4">Signup Here</h1>
										</div>
										<form class="user" method="POST" action="#">
											<div class="form-group">
												<label for="name">Nama</label>
												<input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Masukkan nama...">
											</div>

											<br>

											<div class="form-group">
												<label for="username">Username</label>
												<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan username...">
											</div>

											<br>

											<div class="form-group">
												<label for="password">Password</label>
												<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan password...">
											</div>

											<br>

											<div class="form-group">
												<label for="jenjang">Jenjang</label>
												<select class="form-select" id="jenjang" name="jenjang">
													<?php
													$data = mysqli_query($conn, "SELECT * FROM tbl_jenjang");
													while ($d = mysqli_fetch_array($data)) {
														echo "<option value='" . $d['id_jenjang'] . "'>" . $d['jenjang'] . "</option>";
													}
													?>
												</select>
											</div>

											<br>

											<button class="btn btn-primary btn-user btn-block" type="submit" name="submit">
												Save
											</button>
											<div>
												<a href="login.php"><i class="bi bi-arrow-left"></i></a>
											</div>
											<hr>
										</form>
										<!-- <div class="text-center">
                                        <a class="small" href="gateway.php">KEMBALI KE LAMAN SEBELUMNYA</a>
                                    </div> -->
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>
	</body>

</html>