<!DOCTYPE html>

<?php
include('include/conn.php');
include('include/session.php')
?>

<?php
// show 
$select_profile = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$res = mysqli_fetch_assoc($select_profile);

// Edit Profile
if (isset($_POST["save"])) {
	$edit_name = mysqli_escape_string($conn, $_POST["edit_name"]);
	$edit_ic_number = mysqli_escape_string($conn, $_POST["edit_ic_number"]);
	$edit_phone = mysqli_escape_string($conn, $_POST["edit_phone"]);
	$edit_password = mysqli_escape_string($conn, $_POST["edit_password"]);
	$edit_confirm_password = mysqli_escape_string($conn, $_POST["edit_confirm_password"]);
	$date = date("Y-m-d");
	if ($edit_password == $edit_confirm_password) {
		$edit_user = mysqli_query($conn, ("UPDATE users SET name ='$edit_name' ,nokp = '$edit_ic_number',phone='$edit_phone',password='$edit_confirm_password',reg_date='$date' WHERE username = '$username'"));
		$message = "Profile updated";
		header("location:inventory.php?SuccessEditUser");
	} else {
		$message = "Password and confirm password Are not the match";
	}
}


?>

<?php include('include/head.php') ?>

<body>


	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include('include/header.php') ?>
		<!-- /Header -->

		<!-- Sidebar -->
		<?php include('include/sidebar.php') ?>
		<!-- /Sidebar -->

		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">
				<!-- Page Header -->

				<!-- /Page Header -->

				<div class="row">
					<div class="col-xl-3 col-md-4">

						<div class="card">
							<div class="card-body">
								<div class="page-header">
									<div class="content-page-header">
										<h5>Settings</h5>
									</div>
								</div>
								<!-- Settings Menu -->
								<div class="widget settings-menu mb-0">
									<ul>
										<li class="nav-item">
											<a href="settings.html" class="nav-link active">
												<i class="fe fe-user"></i> <span>Account Settings</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="company-settings.html" class="nav-link">
												<i class="fe fe-settings"></i> <span>Company Settings</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="invoice-settings.html" class="nav-link">
												<i class="fe fe-file"></i> <span>Invoice Settings</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="template-invoice.html" class="nav-link">
												<i class="fe fe-layers"></i> <span>Invoice Templates</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="payment-settings.html" class="nav-link">
												<i class="fe fe-credit-card"></i> <span>Payment Methods</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="bank-account.html" class="nav-link">
												<i class="fe fe-aperture"></i> <span>Bank Settings</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="tax-rats.html" class="nav-link">
												<i class="fe fe-file-text"></i> <span>Tax Rates</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="plan-billing.html" class="nav-link">
												<i class="fe fe-credit-card"></i> <span>Plan & Billing</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="two-factor.html" class="nav-link">
												<i class="fe fe-aperture"></i> <span>Two Factor</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="custom-filed.html" class="nav-link">
												<i class="fe fe-file-text"></i> <span>Custom Fields</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="email-settings.html" class="nav-link">
												<i class="fe fe-mail"></i> <span>Email Settings</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="preferences.html" class="nav-link">
												<i class="fe fe-settings"></i> <span>Preference Settings</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="email-template.html" class="nav-link">
												<i class="fe fe-airplay"></i> <span>Email Templates</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="seo-settings.html" class="nav-link">
												<i class="fe fe-send"></i> <span>SEO Settings</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="saas-settings.html" class="nav-link">
												<i class="fe fe-target"></i> <span>SaaS Settings</span>
											</a>
										</li>
									</ul>
								</div>
								<!-- /Settings Menu -->
							</div>
						</div>
					</div>
					<div class="col-xl-9 col-md-8">
						<form action="" method="post">
							<div class="card">
								<div class="card-body w-100">
									<?php
									if (isset($message)) {
									?>
										<h6 class="text-light bg-danger p-2 rounded"><?php echo $message ?></h6>
									<?php } ?>
									<div class="content-page-header">
										<h5 class="setting-menu">Account Settings</h5>
									</div>
									<div class="row">
										<div class="profile-picture">
											<div class="upload-profile me-2">
												<div class="profile-img">
													<img id="blah" class="avatar" src="assets/img/profiles/avatar-10.jpg" alt="profile-img">
												</div>
											</div>
											<div class="img-upload">
												<label class="btn btn-primary">
													Upload new picture <input type="file">
												</label>
												<a class="btn btn-remove">Delete</a>
												<p class="mt-1">Logo Should be minimum 152 * 152 Supported File format JPG,PNG,SVG</p>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-title">
												<h5>General Information</h5>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="input-block mb-3">
												<label>Username</label>
												<input type="text" class="form-control" placeholder="Enter Username" value="<?php echo $res["username"] ?>" readonly>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="input-block mb-3">
												<label>Name</label>
												<input type="text" class="form-control" name="edit_name" placeholder="Enter Name" value="<?php echo $res["name"] ?>">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="input-block mb-3">
												<label>Mobile Number</label>
												<input type="text" class="form-control" name="edit_phone" placeholder="Enter Mobile Number" value="<?php echo $res["phone"] ?>">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="input-block mb-3">
												<label>IC Number</label>
												<input type="text" class="form-control" name="edit_ic_number" placeholder="Enter IC Number" value="<?php echo $res["nokp"] ?>">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="input-block mb-3">
												<label>New Password</label>
												<input type="password" class="form-control" name="edit_password" placeholder="Enter New Password" value="<?php echo $res["password"] ?>">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="input-block mb-3">
												<label>Confirm Password</label>
												<input type="password" class="form-control" name="edit_confirm_password" placeholder="Confirm Password" value="<?php echo $res["password"] ?>">
											</div>
										</div>
										<!-- <div class="col-lg-6 col-12">
										<div class="input-block mb-3">
											<label>Email</label>
											<input type="text" class="form-control" placeholder="Enter Email Address">
										</div>
									</div> -->
										<!-- <div class="col-lg-6 col-12">
										<div class="input-block mb-0">
											<label>Gender</label>
											<select class="select">
												<option>Select Gender</option>
												<option>Male</option>
												<option>Female</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="input-block mb-3">
											<label>Date of Birth</label>
											<div class="cal-icon cal-icon-info">
												<input type="text" class="datetimepicker form-control" placeholder="Select Date">
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-title">
											<h5>Address Information</h5>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="input-block mb-3">
											<label>Address</label>
											<input type="text" class="form-control" placeholder="Enter your Address">
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="input-block mb-3">
											<label>Country</label>
											<input type="text" class="form-control" placeholder="Enter your Country">
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="input-block mb-3">
											<label>State</label>
											<input type="text" class="form-control" placeholder="Enter your State">
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="input-block mb-3">
											<label>City</label>
											<input type="text" class="form-control" placeholder="Enter your City">
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="input-block mb-3">
											<label>Postal Code</label>
											<input type="text" class="form-control" placeholder="Enter Your Postal Code">
										</div>
									</div> -->
										<div class="col-lg-12">
											<div class="btn-path text-end">
												<a href="javascript:void(0);" class="btn btn-cancel bg-primary-light me-3">Cancel</a>
												<button name="save" class="btn btn-primary">Save Changes</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->

	<?php include('inventory-modal.php') ?>

	</div>
	<!-- /Main Wrapper -->

	<?php include('include/footer.php') ?>

</body>

</html>