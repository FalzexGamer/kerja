<!DOCTYPE html>

<?php
include "include/conn.php";
session_start();

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$login = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

	if (mysqli_num_rows($login) > 0) {
		$data = mysqli_fetch_assoc($login);
		$_SESSION["username"] = $data["username"];
		$_SESSION["is_signin"] = true;

		header("location:users.php");
	} else {
		$login_message = "Not Registered";
	}
}
?>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
	data-sidebar-image="none">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description"
		content="Kanakku provides clean Admin Templates for managing Sales, Payment, Invoice, Accounts and Expenses in HTML, Bootstrap 5, ReactJs, Angular, VueJs and Laravel.">
	<meta name="keywords"
		content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="Dreamguys - Bootstrap Admin Template">
	<!-- Twitter -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@dreamstechnologies">
	<meta name="twitter:title" content="Finance & Accounting Admin Website Templates | Kanakku">
	<meta name="twitter:description"
		content="Kanakku is a Sales, Invoices & Accounts Admin template for Accountant or Companies/Offices with various features for all your needs. Try Demo and Buy Now.">
	<meta name="twitter:image" content="https://kanakku.dreamstechnologies.com/assets/img/kanakku.jpg">
	<meta name="twitter:image:alt" content="Kanakku">

	<!-- Facebook -->
	<meta property="og:url" content="https://kanakku.dreamstechnologies.com/">
	<meta property="og:title" content="Finance & Accounting Admin Website Templates | Kanakku">
	<meta property="og:description"
		content="Kanakku is a Sales, Invoices & Accounts Admin template for Accountant or Companies/Offices with various features for all your needs. Try Demo and Buy Now.">
	<meta property="og:image" content="https://kanakku.dreamstechnologies.com/assets/img/kanakku.jpg">
	<meta property="og:image:secure_url" content="https://kanakku.dreamstechnologies.com/assets/img/kanakku.jpg">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="600">
	<title>Kanakku - Bootstrap Admin HTML Template</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Font family -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
		rel="stylesheet">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- Layout Js -->
	<script src="assets/js/layout.js"></script>
</head>

<body>

	<!-- Main Wrapper -->
	<div class="main-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">

				<img class="img-fluid logo-dark mb-2 logo-color" src="assets/img/logo2.png" alt="Logo">
				<img class="img-fluid logo-light mb-2" src="assets/img/logo2-white.png" alt="Logo">
				<div class="loginbox">

					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Login</h1>
							<p class="account-subtitle">Access to our dashboard</p>

							<form action="" method="post">
								<div class="input-block mb-3">
									<label class="form-control-label">Username</label>
									<input type="text" name="username" class="form-control">
								</div>
								<div class="input-block mb-3">
									<label class="form-control-label">Password</label>
									<div class="pass-group">
										<input type="password" name="password" class="form-control pass-input">
										<span class="fas fa-eye toggle-password"></span>
									</div>
								</div>
								<div class="input-block mb-3">
									<div class="row">
										<div class="col-6">
											<div class="form-check custom-checkbox">
												<input type="checkbox" class="form-check-input" id="cb1">
												<label class="custom-control-label" for="cb1">Remember me</label>
											</div>
										</div>
									</div>
								</div>
								<button class="btn btn-lg  btn-primary w-100" type="submit" name="login">Login</button>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Theme Settings JS -->
	<script src="assets/js/theme-settings.js"></script>
	<script src="assets/js/greedynav.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>

</html>