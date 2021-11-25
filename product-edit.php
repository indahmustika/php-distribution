<?php 

session_start();
$id 	= $_GET['id'];
$conn 	= mysqli_connect("localhost", "root", "", "distribution");
$sql 	= "SELECT * FROM inventory WHERE InventoryId = '$id'";
$rows   = array();
$query 	= mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query)) {
	$rows[] = $row;
}

?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Edit Product</title>
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
	<div id="wrapper">

		<ul class="navbar-nav bg-white shadow sidebar sidebar-light accordion" id="accordionSidebar">
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-3 static-top shadow" style="height: 50px;">
				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
					<div class="sidebar-brand-icon text-gray-400"><i class="fas fa-circle"></i></div>
					<div class="sidebar-brand-text mx-3 text-gray-400">Distribution</div>
				</a>
			</nav>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3"><i class="fas fa-fw fa-cog"></i>Product</a>
				<div id="collapse3" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-primary text-light py-2 collapse-inner rounded">
						<a class="collapse-item text-light" href="product-view.php">Manage Product</a>
						<a class="collapse-item text-light" href="product-input.php">Add Product</a>
					</div>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2"><i class="fa fa-user"></i>Order</a>
				<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-primary text-light py-2 collapse-inner rounded">
						<a class="collapse-item text-light" href="order-seller.php">Confirmed Order</a>
					</div>
				</div>
			</li>
		</ul>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="height: 50px;">
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['Username']; ?></a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="index.php">
									<i class="fas fa-sign-out-alt mr-2 text-gray-400"></i>Logout
								</a>
							</div>
						</li>
					</ul>
				</nav>

				<div class="container-fluid">
					<h1 class="h2 mb-2 text-gray-800">Product</h1><br>
					<div class="card shadow mb-4">
						<div class="card-header bg-white py-3">
							<h5 class="m-0 text-primary">Edit Product</h5>
						</div>
						<div class="card-body">
							<form action="product-update.php" method="POST">
								<?php foreach($rows as $valueget): ?>
									<input type="hidden" name="InventoryId" value="<?php echo $valueget[0]; ?>">
									<div class="row text-dark mx-4">
										<div class="col-sm-7">
											<div class="row mb-3">
												<div class="col-sm-3"><label>Name</label></div>
												<div class="col-sm-8"><input class="form-control" type="text" name="InventoryName" placeholder="Enter Name" value="<?php echo $valueget[1]; ?>"></div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3"><label>Image</label></div>
												<div class="col-sm-8"><input class="form-control" type="file" name="Image" required></div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3"><label>Volume</label></div>
												<div class="col-sm-8"><input class="form-control" type="text" name="Volume" placeholder="P x L x T" value="<?php echo $valueget[3]; ?>"></div>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="row mb-3">
												<div class="col-sm-4"><label>Buy</label></div>
												<div class="col-sm-8">
													<div class="input-group">
														<span class="input-group-text">Rp</span>
														<input class="form-control" type="number" name="BuyPrice" placeholder="Enter Buy Price" value="<?php echo $valueget[4]; ?>">
													</div>
												</div>
											</div>
											<div class="row mb-4">
												<div class="col-sm-4"><label>Weight</label></div>
												<div class="col-sm-8">
													<div class="input-group">
														<input class="form-control" type="number" name="Weight" placeholder="Enter Weight" value="<?php echo $valueget[7]; ?>">
														<div class="input-group-append">
															<select class="form-control" name="Unit">
																<option hidden selected><?php echo $valueget[6]; ?></option>
																<option disabled>Select Unit</option>
																<option>Tons</option>
																<option>Kilograms</option>
																<option>Grams</option>
																<option>Pounds</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-2"></div>
												<div class="col-sm-5"></div>
												<div class="col-sm-5"><input type="submit" name="save" value="Update Product" class="btn btn-primary btn-block shadow"></div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="js/sb-admin-2.min.js"></script>
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="js/demo/datatables-demo.js"></script>
</body>
</html>