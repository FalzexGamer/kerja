<!DOCTYPE html>

<?php
include('include/conn.php');
include('include/session.php')
?>

<?php

// ADD USER

if (isset($_POST["add_user"])) {
	$username = mysqli_escape_string($conn, $_POST["username"]);
	$name = mysqli_escape_string($conn, $_POST["name"]);
	$ic_number = mysqli_escape_string($conn, $_POST["ic_number"]);
	$phone = mysqli_escape_string($conn, $_POST["phone"]);
	$password = mysqli_escape_string($conn, $_POST["password"]);
	$confirm_password = mysqli_escape_string($conn, $_POST["confirm_password"]);
	$salary = mysqli_escape_string($conn, $_POST["salary"]);
	$role = mysqli_escape_string($conn, $_POST["role"]);
	$date = date("Y-m-d");
	if ($password == $confirm_password) {
		$add_user = mysqli_query($conn, ("INSERT INTO users(username,name,nokp,phone,password,branch_id,salary,reg_date) VALUES('$username','$name','$ic_number','$phone','$confirm_password','$role','$salary','$date')"));
		header("location:users.php?SuccessAddUser");
	} else {
		$message = 'Password and confirm password not matches';
	}
}

// EDIT USER
if (isset($_POST["edit_user"])) {
	$edit_id = mysqli_escape_string($conn, $_POST["edit_id"]);
	$edit_username = mysqli_escape_string($conn, $_POST["edit_username"]);
	$edit_name = mysqli_escape_string($conn, $_POST["edit_name"]);
	$edit_ic_number = mysqli_escape_string($conn, $_POST["edit_ic_number"]);
	$edit_phone = mysqli_escape_string($conn, $_POST["edit_phone"]);
	$edit_password = mysqli_escape_string($conn, $_POST["edit_password"]);
	$edit_confirm_password = mysqli_escape_string($conn, $_POST["edit_confirm_password"]);
	$edit_salary = mysqli_escape_string($conn, $_POST["edit_salary"]);
	$edit_role = mysqli_escape_string($conn, $_POST["edit_role"]);
	$date = date("Y-m-d");
	if ($edit_password == $edit_confirm_password) {
		$edit_user = mysqli_query($conn, ("UPDATE users SET username ='$edit_username',name ='$edit_name' ,nokp = '$edit_ic_number',phone='$edit_phone',password='$edit_confirm_password',branch_id='$edit_role',salary='$edit_salary',reg_date='$date' WHERE id = '$edit_id'"));
		header("location:users.php?SuccessEditUser");
	} else {
		$edit_user = mysqli_query($conn, ("UPDATE users SET username ='$edit_username',name ='$edit_name' ,nokp = '$edit_ic_number',phone='$edit_phone',branch_id='$edit_role',salary='$edit_salary',reg_date='$date' WHERE id = '$edit_id'"));
	}
}

// DELETE USERS

if (isset($_POST["delete_user"])) {
	$delete_id = mysqli_escape_string($conn, $_POST["delete_id"]);
	$delete_user = mysqli_query($conn, ("DELETE FROM users WHERE id = '$delete_id'"));
	if ($delete_user) {
		header("location:units.php?SuccessDeleteUnitOfMeasurement");
	} else {
		$message = 'Something wrong!';
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
				<div class="page-header">
					<div class="content-page-header ">
						<h5>Users</h5>
						<div class="list-btn">
							<ul class="filter-list">
								<li>
									<a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter"><span class="me-2"><img src="assets/img/icons/filter-icon.svg" alt="filter"></span>Filter </a>
								</li>
								<li>
									<a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_user"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add user</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<div class="col-sm-12">
						<div class="card-table">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-center table-hover datatable">
										<thead class="thead-light">
											<tr>
												<th>#</th>
												<th>Username</th>
												<th>IC Number</th>
												<th>Mobile Number </th>
												<th>Branch ID</th>
												<th>Created on</th>
												<th>Status</th>
												<th Class="no-sort">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$show_user = mysqli_query($conn, "SELECT * FROM users");
											while ($res = mysqli_fetch_assoc($show_user)) {
											?>
												<tr>
													<td><?php echo $res["id"] ?></td>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-14.jpg" alt="User Image"></a>
															<a href="profile.html"><?php echo $res["name"] ?><span><?php echo $res["username"] ?></span></a>
														</h2>
													</td>
													<td><?php echo $res["nokp"] ?></td>
													<td><?php echo $res["phone"] ?></td>
													<td><?php echo $res["branch_id"] ?></td>
													<td><?php echo $res["reg_date"] ?></td>
													<td><span class="badge  bg-success-light">Active</span></td>
													<td class="d-flex align-items-center">
														<div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<ul>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit_user_<?php echo $res["id"] ?>"><i class="far fa-edit me-2"></i>Edit</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal_<?php echo $res["id"] ?>"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																</ul>
															</div>
														</div>
													</td>
												</tr>
												<!-- Edit User -->
												<div class="modal custom-modal modal-lg fade" id="edit_user_<?php echo $res["id"] ?>" role="dialog">
													<div class="modal-dialog modal-dialog-centered modal-md">
														<div class="modal-content">
															<div class="modal-header border-0 pb-0">
																<div class="form-header modal-header-title text-start mb-0">
																	<h4 class="mb-0">Edit User</h4>
																</div>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

																</button>
															</div>
															<form action="" method="post">
																<input type="hidden" name="edit_id" class="form-control" value="<?php echo $res["id"] ?>">
																<div class="modal-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="card-body">
																				<div class="form-groups-item">
																					<h5 class="form-title">Profile Picture</h5>
																					<div class="profile-picture">
																						<div class="upload-profile">
																							<div class="profile-img">
																								<img id="blah" class="avatar" src="assets/img/profiles/avatar-10.jpg" alt="profile-img">
																							</div>
																							<div class="add-profile">
																								<h5>Upload a New Photo</h5>
																								<span>Profile-pic.jpg</span>
																							</div>
																						</div>
																						<div class="img-upload">
																							<a class="btn btn-primary me-2">Upload</a>
																							<a class="btn btn-remove">Remove</a>
																						</div>
																					</div>
																					<div class="row">
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Username</label>
																								<input type="text" name="edit_username" class="form-control" value="<?php echo $res["username"] ?>" placeholder="Enter Username" required>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Name</label>
																								<input type="text" name="edit_name" class="form-control" value="<?php echo $res["name"] ?>" placeholder="Enter Name" required>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Ic Number</label>
																								<input type="text" name="edit_ic_number" class="form-control" value="<?php echo $res["nokp"] ?>" placeholder="Enter User Number IC" required>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Phone Number</label>
																								<input type="text" name="edit_phone" class="form-control" value="<?php echo $res["phone"] ?>" placeholder="Enter Phone Number" required>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Salary</label>
																								<input type="text" name="edit_salary" class="form-control" value="<?php echo $res["salary"] ?>" placeholder="Enter Salary" required>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Branch ID</label>
																								<select name="edit_role" class="select" required>
																									<option selected><?php echo $res["branch_id"] ?></option>
																									<option>1</option>
																									<option>2</option>
																									<option>3</option>
																								</select>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="pass-group" id="3">
																								<div class="input-block">
																									<label>Password</label>
																									<input type="password" name="edit_password" value="<?php echo $res["password"] ?>" class="form-control pass-input" placeholder="Enter Password">
																									<span class="toggle-password feather-eye"></span>
																								</div>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="pass-group" id="passwordInput2">
																								<div class="input-block">
																									<label>Confirm Password</label>
																									<input type="password" name="edit_confirm_password" class="form-control pass-input" placeholder="Confirm Password">
																									<span class="toggle-password feather-eye"></span>
																								</div>
																							</div>
																						</div>
																						<div class="col-lg-4 col-md-6 col-sm-12">
																							<div class="input-block ">
																								<label>Status</label>
																								<select class="select">
																									<option>Select Status</option>
																									<option>Active</option>
																									<option>Inactive</option>
																								</select>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" data-bs-dismiss="modal" class="btn btn-back cancel-btn me-2">Cancel</button>
																	<button type="submit" name="edit_user" class="btn btn-primary paid-continue-btn">Edit User</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- /Edit User -->
												<!-- Delete Items Modal -->
												<div class="modal custom-modal fade" id="delete_modal_<?php echo $res["id"] ?>" role="dialog">
													<div class="modal-dialog modal-dialog-centered modal-md">
														<div class="modal-content">
															<div class="modal-body">
																<div class="form-header">
																	<h3>Delete Users</h3>
																	<p>Are you sure want to delete?</p>
																</div>
																<form action="" method="post">
																	<input type="hidden" name="delete_id" class="form-control" value="<?php echo $res["id"] ?>">
																	<div class="modal-btn delete-action">
																		<div class="row">
																			<div class="col-6">
																				<button type="submit" name="delete_user" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
																			</div>
																			<div class="col-6">
																				<a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
												<!-- /Delete Items Modal -->
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Wrapper -->

		<!-- Add Asset -->
		<div class="toggle-sidebar">
			<div class="sidebar-layout-filter">
				<div class="sidebar-header">
					<h5>Filter</h5>
					<a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
				</div>
				<div class="sidebar-body">
					<form action="#" autocomplete="off">
						<!-- Customer -->
						<div class="accordion" id="accordionMain1">
							<div class="card-header-new" id="headingOne">
								<h6 class="filter-title">
									<a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Customer
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
									</a>
								</h6>
							</div>

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
								<div class="card-body-chat">
									<div class="row">
										<div class="col-md-12">
											<div id="checkBoxes1">
												<div class="form-custom">
													<input type="text" class="form-control" id="member_search1" placeholder="Search here">
													<span><img src="assets/img/icons/search.svg" alt="img"></span>
												</div>
												<div class="selectBox-cont">
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> John Smith
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Johnny
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Robert
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Sharonda
													</label>
													<!-- View All -->
													<div class="view-content">
														<div class="viewall-One">
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Pricilla
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Randall
															</label>
														</div>
														<div class="view-all">
															<a href="javascript:void(0);" class="viewall-button-One"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
														</div>
													</div>
													<!-- /View All -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Customer -->

						<!-- Select Date -->
						<div class="accordion" id="accordionMain2">
							<div class="card-header-new" id="headingTwo">
								<h6 class="filter-title">
									<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
										Select Date
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
									</a>
								</h6>
							</div>

							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
								<div class="card-body-chat">
									<div class="input-block mb-3">
										<label class="form-control-label">From</label>
										<div class="cal-icon">
											<input type="email" class="form-control datetimepicker" placeholder="DD-MM-YYYY">
										</div>
									</div>
									<div class="input-block mb-3">
										<label class="form-control-label">To</label>
										<div class="cal-icon">
											<input type="email" class="form-control datetimepicker" placeholder="DD-MM-YYYY">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Select Date -->

						<!-- By Status -->
						<div class="accordion accordion-last" id="accordionMain3">
							<div class="card-header-new" id="headingThree">
								<h6 class="filter-title">
									<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
										By Status
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
									</a>
								</h6>
							</div>

							<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
								<div class="card-body-chat">
									<div id="checkBoxes2">
										<div class="form-custom">
											<input type="text" class="form-control" id="member_search2" placeholder="Search here">
											<span><img src="assets/img/icons/search.svg" alt="img"></span>
										</div>
										<div class="selectBox-cont">
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Active
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Restricted
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /By Status -->
						<div class="filter-buttons">
							<button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
								Apply
							</button>
							<button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">
								Reset
							</button>
						</div>
					</form>

				</div>
			</div>
		</div>
		<!--/Add Asset -->

		<!-- Add User -->
		<div class="modal custom-modal modal-lg fade" id="add_user" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<div class="form-header modal-header-title text-start mb-0">
							<h4 class="mb-0">Add User</h4>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

						</button>
					</div>

					<form action="" method="post">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="card-body">
										<div class="form-groups-item">
											<h5 class="form-title">Profile Picture</h5>
											<div class="profile-picture">
												<div class="upload-profile">
													<div class="profile-img">
														<img id="blah" class="avatar" src="assets/img/profiles/avatar-10.jpg" alt="profile-img">
													</div>
													<div class="add-profile">
														<h5>Upload a New Photo</h5>
														<span>Profile-pic.jpg</span>
													</div>
												</div>
												<div class="img-upload">
													<a class="btn btn-primary me-2">Upload</a>
													<a class="btn btn-remove">Remove</a>
												</div>
											</div>
											<?php
											if (isset($message)) {
											?>
												<h6 class="text-light bg-danger p-2 rounded"><?php echo $message ?></h6>
											<?php } ?>
											<div class="row">
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="input-block mb-3">
														<label>Username</label>
														<input type="text" name="username" class="form-control" placeholder="Enter Username" required>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="input-block mb-3">
														<label>Name</label>
														<input type="text" name="name" class="form-control" placeholder="Enter Name" required>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="input-block mb-3">
														<label>Ic Number</label>
														<input type="text" name="ic_number" class="form-control" placeholder="Enter User Number IC" required>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="input-block mb-3">
														<label>Phone Number</label>
														<input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" required>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="input-block mb-3">
														<label>Salary</label>
														<input type="text" name="salary" class="form-control" placeholder="Enter Salary" required>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="input-block mb-3">
														<label>Branch ID</label>
														<select name="role" class="select" required>
															<option selected>Select Branch</option>
															<option>1</option>
															<option>2</option>
															<option>3</option>
														</select>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="pass-group" id="3">
														<div class="input-block">
															<label>Password</label>
															<input type="password" name="password" class="form-control pass-input" placeholder="Enter Password" required>
															<span class="toggle-password feather-eye"></span>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="pass-group" id="passwordInput2">
														<div class="input-block">
															<label>Confirm Password</label>
															<input type="password" name="confirm_password" class="form-control pass-input" placeholder="Confirm Password" required>
															<span class="toggle-password feather-eye"></span>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="input-block ">
														<label>Status</label>
														<select class="select">
															<option>Select Status</option>
															<option>Active</option>
															<option>Inactive</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-bs-dismiss="modal" class="btn btn-back cancel-btn me-2">Cancel</button>
							<button type="submit" name="add_user" class="btn btn-primary paid-continue-btn">Add User</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add User -->

		<?php include('inventory-modal.php') ?>

	</div>
	<!-- /Main Wrapper -->

	<?php include('include/footer.php') ?>

</body>

</html>