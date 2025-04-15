<!DOCTYPE html>

<?php
include('include/conn.php');
include('include/session.php')
?>

<?php
// ADD Group
if (isset($_POST["add_group"])) {
	$name = mysqli_escape_string($conn, $_POST["name"]);
	$createBy = $username;
	$add_group = mysqli_query($conn, ("INSERT INTO group_desc(name,createBy,createTime) VALUES('$name','$createBy','$date')"));
	if ($add_group) {
		header("location:group.php?SuccessAddgroup");
	} else {
		$message = 'Something wrong!';
	}
}

//  EDIT Group

if (isset($_POST["edit_group"])) {
	$edit_id = mysqli_escape_string($conn, $_POST["edit_id"]);
	$edit_name = mysqli_escape_string($conn, $_POST["edit_name"]);
	$updateBy = $username;
	$edit_group = mysqli_query($conn, ("UPDATE group_desc SET name='$edit_name', updateBy ='$updateBy', lastUpdate='$date' WHERE id = '$edit_id'"));
	if ($edit_group) {
		header("location:group.php?SuccessEditgroup");
	} else {
		$message = 'Something wrong!';
	}
}

//  DELETE Group

if (isset($_POST["delete_group"])) {
	$delete_id = mysqli_escape_string($conn, $_POST["delete_id"]);
	$delete_group = mysqli_query($conn, ("DELETE FROM group_desc WHERE id = '$delete_id'"));
	if ($delete_group) {
		header("location:group.php?SuccessDeletegroup");
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
						<h5>Group </h5>
						<div class="list-btn">
							<ul class="filter-list">
								<li>
									<a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter"><span class="me-2"><img src="assets/img/icons/filter-icon.svg" alt="filter"></span>Filter </a>
								</li>
								<li class="">
									<div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Download">
										<a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
										<div class="dropdown-menu dropdown-menu-right">
											<ul class="d-block">
												<li>
													<a class="d-flex align-items-center download-item" href="javascript:void(0);" download><i class="far fa-file-pdf me-2"></i>PDF</a>
												</li>
												<li>
													<a class="d-flex align-items-center download-item" href="javascript:void(0);" download><i class="far fa-file-text me-2"></i>CVS</a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Print"><span><i class="fe fe-printer"></i></span> </a>
								</li>
								<li>
									<a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_group"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add group</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Search Filter -->
				<div id="filter_inputs" class="card filter-card">
					<div class="card-body pb-0">
						<div class="row">
							<div class="col-sm-6 col-md-3">
								<div class="input-block mb-3">
									<label>Name</label>
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="input-block mb-3">
									<label>Email</label>
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="input-block mb-3">
									<label>Phone</label>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Search Filter -->

				<!-- All Invoice -->
				<div class="card invoices-tabs-card">
					<div class="invoices-main-tabs">
						<div class="row align-items-center">
							<div class="col-lg-12">
								<div class="invoices-tabs">
									<ul>
										<li><a href="product-list.php">Product</a></li>
										<li><a href="category.php">Category</a></li>
										<li><a href="units.php">Units</a></li>
										<li><a href="group.php" class="active">Group</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /All Invoice -->

				<!-- Table -->
				<div class="row">
					<div class="col-sm-12">
						<div class=" card-table">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-center table-hover datatable">
										<thead class="thead-light">
											<tr>
												<th>#</th>
												<th>Group Name</th>
												<th>Total Products</th>
												<th class="no-sort">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// View group
											$show_group = mysqli_query($conn, "SELECT * FROM group_desc");
											while ($res = mysqli_fetch_assoc($show_group)) {
												$group_name = $res["name"];
												// Count group
												$sum_group = mysqli_query($conn, "SELECT count(group_desc) as totalgroup FROM products WHERE group_desc='$group_name'");
												$group = mysqli_fetch_array($sum_group)
											?>
												<tr>
													<td><?php echo $res["id"] ?></td>
													<td><a href="" class="product-list-item-img"><img src="assets/img/product-list-img.jpg" alt="product-list"><span><?php echo $res["name"] ?></span></a></td>
													<td><?php echo $group["totalgroup"] ?></td>
													<td class="d-flex align-items-center">
														<a class=" btn-action-icon me-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit_group_<?php echo $res["id"] ?>"><i class="fe fe-edit"></i></a>
														<a class=" btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal_<?php echo $res["id"] ?>"><i class="fe fe-trash-2"></i></a>
													</td>
												</tr>
												<!-- Edit group Modal -->
												<div class="modal custom-modal fade" id="edit_group_<?php echo $res["id"] ?>" role="dialog">
													<div class="modal-dialog modal-dialog-centered modal-md">
														<div class="modal-content">
															<div class="modal-header border-0 pb-0">
																<div class="form-header modal-header-title text-start mb-0">
																	<h4 class="mb-0">Edit group</h4>
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
																				<div class="form-group-item border-0 pb-0 mb-0">
																					<div class="row">
																						<div class="col-lg-12 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Name <span class="text-danger">*</span></label>
																								<input type="text" class="form-control" name="edit_name" value="<?php echo $res["name"] ?>" placeholder="Enter Title">
																							</div>
																						</div>
																						<!-- <div class="col-lg-12 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Slug</label>
																								<input type="text" class="form-control" value="advertising" placeholder="Enter Slug">
																							</div>
																						</div> -->
																						<div class="col-lg-12 col-sm-12">
																							<div class="input-block mb-3">
																								<label>Parent group</label>
																								<select class="select">
																									<option>None</option>
																									<option>Coupons</option>
																									<option>News</option>
																									<option>Plugins</option>
																									<option>Themes</option>
																									<option>Tutorial</option>
																								</select>
																							</div>
																						</div>
																						<div class="col-lg-12 col-sm-12">
																							<div class="input-block mb-0 pb-0">
																								<label>Image</label>
																								<div class="input-block service-upload mb-0">
																									<span><img src="assets/img/icons/drop-icon.svg" alt="upload"></span>
																									<h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
																									<p class="text-muted">Maximum size: 50MB</p>
																									<input type="file" multiple="" id="image_sign2">
																									<div id="frames2"></div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</button>
																	<button type="submit" data-bs-dismiss="modal" name="edit_group" class="btn btn-primary paid-continue-btn">Update</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- /Edit Vendor Modal -->

												<!-- Delete Items Modal -->
												<div class="modal custom-modal fade" id="delete_modal_<?php echo $res["id"] ?>" role="dialog">
													<div class="modal-dialog modal-dialog-centered modal-md">
														<div class="modal-content">
															<div class="modal-body">
																<div class="form-header">
																	<h3>Delete group</h3>
																	<p>Are you sure want to delete?</p>
																</div>
																<form action="" method="post">
																	<input type="hidden" name="delete_id" class="form-control" value="<?php echo $res["id"] ?>">
																	<div class="modal-btn delete-action">
																		<div class="row">
																			<div class="col-6">
																				<button type="submit" name="delete_group" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
																			</div>
																			<div class="col-6">
																				<button type="submit" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
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
				<!-- /Table -->

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
						<!-- Product -->
						<div class="accordion" id="accordionMain1">
							<div class="card-header-new" id="headingOne">
								<h6 class="filter-title">
									<a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										group Name
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
													<input type="text" class="form-control" id="member_search1" placeholder="Search Product">
													<span><img src="assets/img/icons/search.svg" alt="img"></span>
												</div>
												<div class="selectBox-cont">
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Advertising
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Food
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Furniture
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Repairs
													</label>
													<!-- View All -->
													<div class="view-content">
														<div class="viewall-One">
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Laptop
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Shoes
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Accessories
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Phone
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Bags
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Speaker
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
						<!-- /Product -->

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
		<!-- /Add Asset -->

		<!-- Add group Modal -->
		<div class="modal custom-modal fade" id="add_group" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<div class="form-header modal-header-title text-start mb-0">
							<h4 class="mb-0">Add group</h4>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

						</button>
					</div>
					<form action="#" method="post">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="card-body">
										<div class="form-group-item border-0 pb-0 mb-0">
											<div class="row">
												<div class="col-lg-12 col-sm-12">
													<div class="input-block mb-3">
														<label>Name <span class="text-danger">*</span></label>
														<input type="text" name="name" class="form-control" placeholder="Enter Title">
													</div>
												</div>
												<!-- <div class="col-lg-12 col-sm-12">
													<div class="input-block mb-3">
														<label>Slug</label>
														<input type="text" class="form-control" placeholder="Enter Slug">
													</div>
												</div> -->
												<div class="col-lg-12 col-sm-12">
													<div class="input-block mb-3">
														<label>Parent group</label>
														<select class="select">
															<option>None</option>
															<option>Coupons</option>
															<option>News</option>
															<option>Plugins</option>
															<option>Themes</option>
															<option>Tutorial</option>
														</select>
													</div>
												</div>
												<div class="col-lg-12 col-sm-12">
													<div class="input-block mb-0 pb-0">
														<label>Image</label>
														<div class="input-block service-upload mb-0">
															<span><img src="assets/img/icons/drop-icon.svg" alt="upload"></span>
															<h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
															<p class="text-muted">Maximum size: 50MB</p>
															<input type="file" multiple="" id="image_sign">
															<div id="frames"></div>
														</div>
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
							<button type="submit" data-bs-dismiss="modal" name="add_group" class="btn btn-primary paid-continue-btn">Add group</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add group Modal -->



		<?php include('inventory-modal.php') ?>

	</div>
	<!-- /Main Wrapper -->

	<?php include('include/footer.php') ?>

</body>

</html>