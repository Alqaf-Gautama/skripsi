<?php 
require('../config.php');

if (isset($_SESSION['login_admin'])) header("location: index.php");
$username = null;
$err_user = false;
$err_pass = false;

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
	$get = mysqli_fetch_assoc($result);

	if ($get) {
		$get_password = $get['password'];

		if (password_verify($password, $get_password)) {
			$_SESSION['login_admin'] = $get_password;
			header("location: index.php");
			exit();
		} else $err_pass = true;
	} else $err_user = true;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- App css -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

	<script src="assets/js/modernizr.min.js"></script>

</head>


<body class="bg-accpunt-pages">

	<!-- HOME -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">

					<div class="wrapper-page">

						<div class="account-pages">
							<div class="account-box">
								<div class="account-logo-box">
									<h2 class="text-uppercase text-center">
										<a href="index.html" class="text-success">
											<span>
												<h2>LOGIN TO ADMIN</h2>
											</span>
										</a>
									</h2>
									<h6 class="text-uppercase text-center font-bold mt-4">Login</h6>
								</div>
								<div class="account-content">
									<form class="form-horizontal" method="post">

										<div class="form-group m-b-20 row">
											<div class="col-12">
												<label for="uname">Username</label>
												<input class="form-control" name="username" type="text" id="uname" required="" placeholder="Enter your Username">
												<?php if ($err_user == true) { ?>
													<div class="text-danger">
														Username tidak ditemukan
													</div>
												<?php } ?>
											</div>
										</div>

										<div class="form-group row m-b-20">
											<div class="col-12">

												<label for="password">Password</label>
												<input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
												<?php if ($err_pass == true) { ?>
													<div class="text-danger">
														Password tidak sesuai
													</div>
												<?php } ?>
											</div>
										</div>

										<div class="form-group row text-center m-t-10">
											<div class="col-12">
												<button class="btn btn-block btn-gradient waves-effect waves-light" type="submit" name="login">Login</button>
											</div>
										</div>

									</form>         

								</div>
							</div>
						</div>
						<!-- end card-box-->


					</div>
					<!-- end wrapper -->

				</div>
			</div>
		</div>
	</section>
	<!-- END HOME -->


	<!-- jQuery  -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/metisMenu.min.js"></script>
	<script src="assets/js/waves.js"></script>
	<script src="assets/js/jquery.slimscroll.js"></script>

	<!-- App js -->
	<script src="assets/js/jquery.core.js"></script>
	<script src="assets/js/jquery.app.js"></script>

</body>
</html>