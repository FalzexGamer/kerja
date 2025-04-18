<!DOCTYPE html>

<?php
include('include/conn.php');
include('include/session.php')
?>
<?php

// ADD UOM
if (isset($_POST["add_uom"])) {
	$name = mysqli_escape_string($conn, $_POST["name"]);
	$shortname = mysqli_escape_string($conn, $_POST["shortname"]);
	$add_uom = mysqli_query($conn, ("INSERT INTO uom(name,shortname,createTime) VALUES('$name','$shortname','$date')"));
	if ($add_uom) {
		header("location:units.php?SuccessAddUnitOfMeasurement");
	} else {
		$message = 'Something wrong!';
	}
}

//  EDIT UOM

if (isset($_POST["edit_uom"])) {

	$edit_name = mysqli_escape_string($conn, $_POST["edit_name"]);
	$edit_shortname = mysqli_escape_string($conn, $_POST["edit_shortname"]);
	$edit_id = mysqli_escape_string($conn, $_POST["edit_id"]);
	$edit_uom = mysqli_query($conn, ("UPDATE uom SET name='$edit_name', shortname ='$edit_shortname' WHERE id = '$edit_id'"));
	if ($edit_uom) {
		header("location:units.php?SuccessEditUnitOfMeasurement");
	} else {
		$message = 'Something wrong!';
	}
}

//  DELETE UOM

if (isset($_POST["delete_uom"])) {
	$delete_id = mysqli_escape_string($conn, $_POST["delete_id"]);
	$delete_uom = mysqli_query($conn, ("DELETE FROM uom WHERE id = '$delete_id'"));
	if ($delete_uom) {
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
						<h5>Units </h5>
						<div class="list-btn">
							<ul class="filter-list">
								<li class="">
									<div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="download">
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
									<a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="print"><span><i class="fe fe-printer"></i></span> </a>
								</li>
								<li>
									<a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_unit"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Unit</a>
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
										<li><a href="units.php" class="active">Units</a></li>
										<li><a href="group.php" >Group</a></li>
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
						<div class="card-table">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-center table-hover datatable">
										<thead class="thead-light">
											<tr>
												<th>#</th>
												<th>Unit Name</th>
												<th>Short Name</th>
												<th>Total Product</th>
												<th class="no-sort">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// View UOM
											$show_uom = mysqli_query($conn, "SELECT * FROM uom");
											while ($res = mysqli_fetch_assoc($show_uom)) {
												$uom_name = $res["name"];
												// Count UOM
												$sum_uom = mysqli_query($conn, "SELECT count(uom) as total_uom FROM products WHERE uom='$uom_name'");
												$UOM = mysqli_fetch_array($sum_uom)
											?>

												<tr>
													<td><?php echo $res["id"] ?></td>
													<td><?php echo $res["name"] ?></td>
													<td><?php echo $res["shortname"] ?></td>
													<td><?php echo $UOM["total_uom"] ?></td>
													<td class="d-flex align-items-center">
														<a class="btn-action-icon me-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit_unit_<?php echo $res["id"] ?>"><i class="fe fe-edit"></i></a>
														<a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal_<?php echo $res["id"] ?>"><i class="fe fe-trash-2"></i></a>
													</td>
												</tr>
												<!-- Edit Units Modal -->
												<div class="modal custom-modal fade" id="edit_unit_<?php echo $res["id"] ?>" role="dialog">
													<div class="modal-dialog modal-dialog-centered modal-md">
														<div class="modal-content">
															<div class="modal-header border-0 pb-0">
																<div class="form-header modal-header-title text-start mb-0">
																	<h4 class="mb-0">Edit Units</h4>
																</div>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																</button>
															</div>
															<form action="" method="post">
																<input type="hidden" name="edit_id" class="form-control" value="<?php echo $res["id"] ?>">
																<div class="modal-body">
																	<div class="row">
																		<div class="col-lg-12 col-sm-12">
																			<div class="input-block mb-3">
																				<label>Name </label>
																				<input type="text" name="edit_name" class="form-control" value="<?php echo $res["name"] ?>" placeholder="Enter Title">
																			</div>
																		</div>
																		<div class="col-lg-12 col-sm-12">
																			<div class="input-block mb-3">
																				<label>Symbol</label>
																				<input type="text" name="edit_shortname" class="form-control" value="<?php echo $res["shortname"] ?>" placeholder="Enter Slug">
																			</div>
																		</div>
																		<!-- <div class="col-lg-12 col-sm-12">
																			<div class="input-block mb-0">
																				<label>Parent Unit</label>
																				<input type="text" class="form-control" value="kg" placeholder="Parent Unit">
																			</div>
																		</div> -->
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</button>
																	<button type="submit" name="edit_uom" class="btn btn-primary paid-continue-btn">Update</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- /Edit Units Modal -->

												<!-- Delete Items Modal -->
												<div class="modal custom-modal fade" id="delete_modal_<?php echo $res["id"] ?>" role="dialog">
													<div class="modal-dialog modal-dialog-centered modal-md">
														<div class="modal-content">
															<div class="modal-body">
																<div class="form-header">
																	<h3>Delete Units</h3>
																	<p>Are you sure want to delete?</p>
																</div>
																<form action="" method="post">
																	<input type="hidden" name="delete_id" class="form-control" value="<?php echo $res["id"] ?>">
																	<div class="modal-btn delete-action">
																		<div class="row">
																			<div class="col-6">
																				<button type="submit" name="delete_uom" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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
										Product Name
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
														<span class="checkmark"></span> Lorem ipsum dolor sit
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Lorem ipsum dolor sit
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Lorem ipsum dolor sit
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Lorem ipsum dolor sit
													</label>
													<!-- View All -->
													<div class="view-content">
														<div class="viewall-One">
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Lorem ipsum dolor sit
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Lorem ipsum dolor sit
															</label>
															<label class="custom_check w-100">
																<input type="checkbox" name="username">
																<span class="checkmark"></span> Lorem ipsum dolor sit
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

						<!-- Product Code -->
						<div class="accordion" id="accordionMain2">
							<div class="card-header-new" id="headingTwo">
								<h6 class="filter-title">
									<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
										Product Code
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
									</a>
								</h6>
							</div>

							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
								<div class="card-body-chat">
									<div id="checkBoxes3">
										<div class="selectBox-cont">
											<div class="form-custom">
												<input type="text" class="form-control" id="member_search2" placeholder="Search Invoice">
												<span><img src="assets/img/icons/search.svg" alt="img"></span>
											</div>
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> P125389
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> P125390
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> P125391
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> P125392
											</label>
											<!-- View All -->
											<div class="view-content">
												<div class="viewall-Two">
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> P125393
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> P125394
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> P125395
													</label>
												</div>
												<div class="view-all">
													<a href="javascript:void(0);" class="viewall-button-Two"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
												</div>
											</div>
											<!-- /View All -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Product Code -->

						<!-- Unts -->
						<div class="accordion" id="accordionMain3">
							<div class="card-header-new" id="headingThree">
								<h6 class="filter-title">
									<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
										Units
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
									</a>
								</h6>
							</div>

							<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
								<div class="card-body-chat">
									<div id="checkBoxes2">
										<div class="selectBox-cont">
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Inches
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Pieces
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Hours
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Box
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Kilograms
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="bystatus">
												<span class="checkmark"></span> Meter
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Units -->

						<!-- Category -->
						<div class="accordion accordion-last" id="accordionMain4">
							<div class="card-header-new" id="headingFour">
								<h6 class="filter-title">
									<a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
										Category
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
									</a>
								</h6>
							</div>

							<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample4">
								<div class="card-body-chat">
									<div id="checkBoxes4">
										<div class="selectBox-cont">
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Advertising
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Food
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Marketing
											</label>
											<label class="custom_check w-100">
												<input type="checkbox" name="category">
												<span class="checkmark"></span> Software
											</label>
											<!-- View All -->
											<div class="view-content">
												<div class="viewall-Two">
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Repairs
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Stationary
													</label>
													<label class="custom_check w-100">
														<input type="checkbox" name="username">
														<span class="checkmark"></span> Designing
													</label>
												</div>
												<div class="view-all">
													<a href="javascript:void(0);" class="viewall-button-Two"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
												</div>
											</div>
											<!-- /View All -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Category -->

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

		<!-- Add Units Modal -->
		<div class="modal custom-modal fade" id="add_unit" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<div class="form-header modal-header-title text-start mb-0">
							<h4 class="mb-0">Add Units</h4>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

						</button>
					</div>
					<form action="" method="post">
						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12 col-sm-12">
									<div class="input-block mb-3">
										<label>Name <span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name" required>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12">
									<div class="input-block mb-3">
										<label>Symbol/Shortname <span class="text-danger">*</span></label>
										<input type="text" name="shortname" class="form-control" placeholder="Enter Symbol" required>
									</div>
								</div>
								<!-- <div class="col-lg-12 col-sm-12">
									<div class="input-block mb-0">
										<label>Parent Unit <span class="text-danger">*</span></label>
										<input type="text" class="form-control" placeholder="Parent Unit">
									</div>
								</div> -->
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-bs-dismiss="modal" class="btn btn-back cancel-btn me-2">Cancel</button>
							<button type="submit" name="add_uom" class="btn btn-primary paid-continue-btn">Add Unit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Units Modal -->




		<?php include('inventory-modal.php') ?>

	</div>
	<!-- /Main Wrapper -->

	<?php include('include/footer.php') ?>

</body>

</html>