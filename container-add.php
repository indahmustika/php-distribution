<?php 

session_start();
include_once('connect.php');
$user 	= $_SESSION['Username'];
$id 	= $_GET['id'];
$sql 	= "
SELECT checkout.OrderId, checkout.UserInternalId, checkout.InvInternalId, checkout.Quantity, inventory.InventoryName, inventory.Image, inventory.SellPrice, user.Name, user.Email, user.Phone, inventory.BuyPrice, checkout.Status, 
inventory.Volume, inventory.Unit, inventory.Weight
FROM checkout 
INNER JOIN inventory ON checkout.InvInternalId = inventory.InventoryId 
INNER JOIN user ON checkout.UserInternalId = user.Username
WHERE checkout.Status = 'Waiting'";
$rows   = array();
$query 	= mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
	$rows[] = $row;
}

$sql1 	= "SELECT * FROM shipping INNER JOIN 
(SELECT checkout.OrderId, checkout.UserInternalId, checkout.InvInternalId, checkout.Quantity, inventory.InventoryName, inventory.Image, inventory.SellPrice, user.Name, user.Email, user.Phone, inventory.BuyPrice, checkout.Status, 
	inventory.Volume, inventory.Unit, inventory.Weight
	FROM checkout 
	INNER JOIN inventory ON checkout.InvInternalId = inventory.InventoryId 
	INNER JOIN user ON checkout.UserInternalId = user.Username
) AS detail
ON shipping.OrderInternalId = detail.OrderId
WHERE shipping.ContainerInternalId = '$id'";
$rows1   = array();
$query1  = mysqli_query($connect, $sql1);
while ($row1 = mysqli_fetch_array($query1)) {
	$rows1[] = $row1;
}

$sql2 	 = "SELECT * FROM container WHERE ContainerId = '$id'";
$rows2   = array();
$query2  = mysqli_query($connect, $sql2);
while ($row2 = mysqli_fetch_array($query2)) {
	$rows2[] = $row2;
}

?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Shipping</title>
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
				<div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-primary text-light py-2 collapse-inner rounded">
						<a class="collapse-item text-light" href="product-sell.php">Sell Product</a>
					</div>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2"><i class="fa fa-user"></i>Container</a>
				<div id="collapse2" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
					<h1 class="h2 mb-2 text-gray-800">Container</h1><br>
					<div class="card shadow mb-4 text-dark">
						<div class="card-header bg-white py-3">
							<?php foreach($rows2 as $value2): ?>
							<?php $remarks = $value2[3]; ?>
							<h5 class="m-0 text-primary">Shipping Order [<?php echo $remarks; ?>]
								<?php if($remarks != 'Shipped'){?>
									<button style="float: right;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal1">Add Shipping Order</button>
								<?php }?>
							</h5>
						</div>
						<div class="card-body">
							<?php //foreach($rows2 as $value2): ?>
								<div class="alert alert-secondary">
									<div class="text-dark text-gray-600"><b>Container Information</b></div><hr>
									<div class="text-dark">
										<div class="row mb-2">
											<div class="col-sm-3 text-dark">Container Code</div>
											<div class="col-sm-9 text-dark">: <?php echo $value2[1]; ?></div>
										</div>
										<div class="row">
											<div class="col-sm-3 text-dark">Container Volume</div>
											<div class="col-sm-9 text-dark">: <?php echo $value2[2]; ?></div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>

							<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-xl">
									<div class="modal-content">
										<div class="card shadow mb-0">
											<div class="card-header py-3 bg-white">
												<h5 class="m-0 text-primary text-center">Add Shipping Order</h5>
											</div>
											<div class="card-body">
												<?php if(empty($rows)){?>
													<div class="alert alert-white col-sm-4 offset-4 text-center">
														<h5>Empty Order</h5>
														<h5><i class="mt-4 fa fa-shopping-cart fa-6x text-gray-400"></i></h5><br>
													</div>
												<?php }?>
												<div class="card-columns">
													<?php foreach($rows as $value): ?>
														<div class="card">
															<div class="card-header bg-white text-center text-gray-500"><b>Confirmed Order #<?php echo $value[0];?></b></div>
															<div class="alert alert-info mx-3 my-3">
																<div class="row mb-2">
																	<small class="col-sm-4 text-dark text-muted">Name</small>
																	<small class="col-sm-8 text-dark text-muted"><?php echo $value[7]; ?></small>
																</div>
																<div class="row">
																	<small class="col-sm-4 text-dark text-muted">Phone</small>
																	<small class="col-sm-8 text-dark text-muted"><?php echo $value[9]; ?></small>
																</div>
															</div>
															<img class="card-img-top" src="images/<?php echo $value[5]; ?>" style="object-fit: cover">
															<div class="card-body">
																<h5 class="card-text text-center"><?php echo $value[4]; ?></h5>
																<p class="card-text text-primary text-center"><b>Order Qty : <?php echo $value[3]; ?></b></p>
																<hr>
																<div class="row mb-2">
																	<div class="col-sm-4">Price</div>
																	<div class="col-sm-8 text-right">Rp. <?php echo $value[10]; ?></div>
																</div>
																<div class="row mb-2">
																	<div class="col-sm-4">Total</div>
																	<div class="col-sm-8 text-right">Rp. <?php echo ($value[10] * $value[3])?></div>
																</div>
															</div>
															<div class="alert alert-info mx-3 my-0">
																<div class="row mb-2">
																	<small class="col-sm-4 text-dark text-muted">Dimensi</small>
																	<small class="col-sm-8 text-dark text-muted"><?php echo $value[12]; ?></small>
																</div>
																<div class="row">
																	<small class="col-sm-4 text-dark text-muted">Weight</small>
																	<small class="col-sm-8 text-dark text-muted"><?php echo $value[14]; ?> <?php echo $value[13]; ?></small>
																</div>
															</div>
															<div class="card-body">
																<a class="btn btn-primary btn-block" href="container-load.php?container=<?php echo $id?>&order=<?php echo $value[0]?>">Load Order</a>
															</div>
														</div>
													<?php endforeach; ?>
												</div>					
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card-columns mt-3">
								<?php foreach($rows1 as $value1): ?>
									<div class="card">
										<div class="card-header bg-white text-center text-gray-500"><b>Shipped Order #<?php echo $value1[0];?></b></div>
										<div class="alert alert-info mx-3 my-3">
											<div class="row mb-2">
												<small class="col-sm-4 text-dark text-muted">Name</small>
												<small class="col-sm-8 text-dark text-muted"><?php echo $value1[10]; ?></small>
											</div>
											<div class="row">
												<small class="col-sm-4 text-dark text-muted">Phone</small>
												<small class="col-sm-8 text-dark text-muted"><?php echo $value1[12]; ?></small>
											</div>
										</div>
										<img class="card-img-top" src="images/<?php echo $value1[8]; ?>" style="object-fit: cover">
										<div class="card-body">
											<h5 class="card-text text-center"><?php echo $value1[7]; ?></h5>
											<p class="card-text text-primary text-center"><b>Order Qty : <?php echo $value1[6]; ?></b></p>
											<hr>
											<div class="row mb-2">
												<div class="col-sm-4">Price</div>
												<div class="col-sm-8 text-right">Rp. <?php echo $value1[13]; ?></div>
											</div>
											<div class="row">
												<div class="col-sm-4">Total</div>
												<div class="col-sm-8 text-right">Rp. <?php echo ($value1[13] * $value1[6])?></div>
											</div>
										</div>
										<div class="alert alert-info mx-3">
											<div class="row mb-2">
												<small class="col-sm-4 text-dark text-muted">Dimensi</small>
												<small class="col-sm-8 text-dark text-muted"><?php echo $value1[15]; ?></small>
											</div>
											<div class="row">
												<small class="col-sm-4 text-dark text-muted">Weight</small>
												<small class="col-sm-8 text-dark text-muted"><?php echo $value1[17]; ?> <?php echo $value1[16]; ?></small>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>

						</div>
						<?php if(!empty($rows1) && $remarks == 'Loaded'){?>
							<div class="card-footer">
								<h5 class="text-center"><a class="btn btn-primary" style="float: center;" href="container-ship.php?container=<?php echo $id?>"><i class="fa fa-shipping-fast"></i> Ship Order</a></h5>
							</div>
						<?php }?>
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