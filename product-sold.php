<?php 

session_start();
include_once('connect.php');
$sql 	= "SELECT inventory.InventoryId, inventory.InventoryName, inventory.Image, inventory.Volume, inventory.BuyPrice, inventory.SellPrice, inventory.Unit, inventory.Weight, inventory.UserCreated, user.Name 
	FROM inventory 
	INNER JOIN user ON inventory.UserCreated = user.Username 
	WHERE SellPrice IS NOT NULL";
$rows   = array();
$query 	= mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
	$rows[] = $row;
}

?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sold Product</title>
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
						<a class="collapse-item text-light" href="product-sell.php">Sell Product</a>
					</div>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2"><i class="fa fa-user"></i>Container</a>
				<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-primary text-light py-2 collapse-inner rounded">
						<a class="collapse-item text-light" href="container-view.php">Shipping</a>
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
					<div class="card shadow mb-4 text-dark">
						<div class="card-header bg-white py-3">
							<h5 class="m-0 text-primary">
								Sell Product
							</h5>
						</div>
						<div class="card-body">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link" href="product-sell.php">Not For Sell</a>
								</li>
								<li class="nav-item">
									<a class="nav-link active" href="product-sold.php">For Sell</a>
								</li>
							</ul>
							<br>
							<div class="card-columns">
								<?php foreach($rows as $value): ?>
									<div class="card">
										<img class="card-img-top" src="images/<?php echo $value[2]; ?>" style="object-fit: cover">
										<div class="card-body">
											<h5 class="card-text"><center><?php echo $value[1]; ?></center></h5>
											<p class="card-text text-center text-primary"><b>Rp. <?php echo $value[5]; ?></b></p>
										</div>
										<div class="card-footer">
											<small class="text-muted">
												<div class="row">
													<div class="col-sm-3">Dimensi</div>
													<div class="col-sm-9"><?php echo $value[3]; ?></div>
												</div>
												<div class="row">
													<div class="col-sm-3">Weight</div>
													<div class="col-sm-9"><?php echo $value[7]; ?> <?php echo $value[6]; ?></div>
												</div>
												<div class="row">
													<div class="col-sm-3">Buy Price</div>
													<div class="col-sm-9">Rp. <?php echo $value[4]; ?></div>
												</div>	 
												<div class="row">
													<div class="col-sm-3">Seller</div>
													<div class="col-sm-9"><?php echo $value[9]; ?></div>
												</div>
											</small>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
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