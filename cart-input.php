<?php 

session_start();
include_once('connect.php');
$sql 	= "SELECT * FROM inventory WHERE SellPrice IS NOT NULL";
$rows   = array();
$query 	= mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
	$rows[] = $row;
}

?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Product Catalog</title>
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
						<a class="collapse-item text-light" href="cart-input.php">Product Catalog</a>
					</div>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2"><i class="fa fa-user"></i>Order</a>
				<div id="collapse2" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-primary text-light py-2 collapse-inner rounded">
						<a class="collapse-item text-light" href="cart-view.php">Cart Order</a>
						<a class="collapse-item text-light" href="order-view.php">Confirmed Order</a>
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
					<h1 class="h2 mb-2 text-gray-800">Product Catalog</h1><br>
					<div class="card shadow mb-4 text-dark">
						<div class="card-body">
							<div class="card-columns">
								<?php foreach($rows as $value): ?>
									<div class="card">
										<img class="card-img-top" src="images/<?php echo $value[2]; ?>" style="object-fit: cover">
										<div class="card-body">
											<h5 class="card-text text-center"><?php echo $value[1]; ?></h5>
											<p class="card-text text-primary text-center"><b>Rp. <?php echo $value[5]; ?></b></p>
											
											<div class="text-center"><button type="button" class="btn btn-primary text-light shadow" data-toggle="modal" data-target="#exampleModal1-<?php echo $value[0]; ?>"><i class="fas fa-shopping-cart"></i> Add To Cart</button></div>
											<div class="modal fade" id="exampleModal1-<?php echo $value[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="card shadow mb-0">
															<div class="card-header py-3 bg-white">
																<h5 class="m-0 text-center text-primary"><?php echo $value[1]; ?></h5>
															</div>
															<div class="card-body">
																<div class="row">
																	<div class="col-sm-5">
																		<img class="card-img-top" src="images/<?php echo $value[2]; ?>" style="object-fit: cover">
																	</div>
																	<div class="col-sm-7">
																		<h6 class="mt-2">Product Detail</h6><hr>
																		<div class="row">
																			<p class="col-sm-4">Dimensi</p>
																			<p class="col-sm-8"><?php echo $value[3]; ?></p>
																		</div>
																		<div class="row">
																			<div class="col-sm-4"><p>Weight</p></div>
																			<p class="col-sm-8"><?php echo $value[7]; ?> <?php echo $value[6]; ?></p>
																		</div>
																		<div class="row">
																			<p class="col-sm-4">Price</h5>
																				<p class="col-sm-8">Rp. <?php echo $value[4]; ?></p>
																			</div>
																			<h6 class="mt-2">Add To Cart</h6><hr>
																			<div class="row mb-2">
																				<p class="col-sm-4">Quantity</p>
																				<div class="col-sm-7">
																					<form action="cart-insert.php" method="POST">
																						<input type="hidden" name="InvInternalId" value="<?php echo $value[0]?>">
																						<input type="hidden" name="UserInternalId" value="<?php echo $_SESSION['Username']?>">
																						<div class="input-group">
																							<input class="form-control" type="number" name="Quantity" value="1">
																							<div class="input-group-append">
																								<input type="submit" name="save" value="Add To Cart" class="btn btn-primary btn-block shadow">
																							</div>
																						</div>
																					</form>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</p>
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