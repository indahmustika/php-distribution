<?php 

session_start();
include_once('connect.php');
$user 	= $_SESSION['Username'];
$sql 	= "SELECT cart.CartId, cart.UserInternalId, cart.InvInternalId, cart.Quantity, inventory.InventoryName, inventory.Image, inventory.SellPrice FROM cart INNER JOIN inventory ON cart.InvInternalId = inventory.InventoryId WHERE UserInternalId = '$user'";
$rows   = array();
$query 	= mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
	$rows[] = $row;
}

?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Card Order</title>
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
					<h1 class="h2 mb-2 text-gray-800">Cart Order</h1><br>
					<div class="card shadow mb-4 text-dark">
						<?php if(empty($rows)){?>
							<br><br>
							<div class="alert alert-white col-sm-4 offset-4 text-center">
								<h5>Empty Cart</h5>
								<h5><i class="mt-4 fa fa-shopping-cart fa-6x text-gray-400"></i><h5><br>
								<a class="btn btn-primary shadow" href="cart-input.php"><i></i>Let's Make Some Order!</a>
							</div>
						<?php }?>
						<div class="card-body">
							<div class="card-columns">
								<?php foreach($rows as $value): ?>
									<div class="card">
										<img class="card-img-top" src="images/<?php echo $value[5]; ?>" style="object-fit: cover">
										<div class="card-body">
											<h5 class="card-text text-center"><?php echo $value[4]; ?></h5>
											<p class="card-text text-primary text-center"><b>Rp. <?php echo $value[6]; ?></b></p>
											<hr>
											<form action="order-insert.php" method="POST">
												<div class="row mb-2">
													<div class="col-sm-4">Quantity</div>
													<div class="col-sm-8"><input class="form-control" type="number" id="Quantity" name="Quantity" value="<?php echo $value[3]; ?>"></div>
												</div>
												<div class="row">
													<div class="col-sm-4">Total</div>
													<div class="col-sm-8">
														<div class="input-group">
															<span class="input-group-text">Rp</span>
															<input class="form-control" type="number" id="Total" readonly="" value="<?php echo ($value[6] * $value[3])?>" style="background-color: #fff;">
														</div>
													</div>
												</div>
												<br>
												<input type="hidden" name="UserInternalId" value="<?php echo $user; ?>">
												<input type="hidden" name="InvInternalId" value="<?php echo $value[2]; ?>">
												<input type="hidden" name="CartId" value="<?php echo $value[0]; ?>">
												<input type="hidden" id="Price" value="<?php echo $value[6]; ?>">
												<input type="submit" value="Confirm Order" class="btn btn-primary btn-block shadow">
											</form>
										</div>
									<?php endforeach; ?>
								</div>
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

	<script>
		$('#Quantity').on('input', () => setTotal());

		function setTotal(){
			let quantityValue = $('#Quantity').val();
			let priceValue	  = $('#Price').val();
			let resultValue	  = quantityValue * priceValue;

			$('#Total').val(resultValue);
		}
	</script>
</body>
</html>