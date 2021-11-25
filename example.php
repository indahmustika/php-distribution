<?php 

include_once('connect.php');
$sql 	= "SELECT * FROM inventory";
$rows   = array();
$query 	= mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
	$rows[] = $row;
}

?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Input Product</title>
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
	<div id="wrapper">

		<ul class="navbar-nav bg-white shadow sidebar sidebar-light accordion" id="accordionSidebar">
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-3 static-top shadow" style="height: 50px;">
				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
					<div class="sidebar-brand-icon text-gray-400"><i class="fas fa-trash"></i></div>
					<div class="sidebar-brand-text mx-3 text-gray-400">Inventory</div>
				</a>
			</nav>
			<li class="nav-item"><a class="nav-link" href=""><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
			<hr class="sidebar-divider"><div class="sidebar-heading">Interface</div>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i class="fas fa-fw fa-cog"></i>Components</a>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-primary text-light py-2 collapse-inner rounded">
						<h6 class="collapse-header text-light">Custom Components:</h6>
						<a class="collapse-item text-light" href="buttons.html">Buttons</a>
						<a class="collapse-item text-light" href="cards.html">Cards</a>
					</div>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities"><i class="fas fa-fw fa-wrench"></i>Utilities</a>
				<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
					<div class="bg-primary py-2 collapse-inner rounded">
						<h6 class="collapse-header text-light">Custom Utilities:</h6>
						<a class="collapse-item text-light" href="utilities-color.html">Colors</a>
						<a class="collapse-item text-light" href="utilities-border.html">Borders</a>
						<a class="collapse-item text-light" href="utilities-animation.html">Animations</a>
						<a class="collapse-item text-light" href="utilities-other.html">Other</a>
					</div>
				</div>
			</li>
			<hr class="sidebar-divider d-none d-md-block">
		</ul>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="height: 50px;">
					<form class="d-none d-sm-inline-block form-inline mt-3 navbar-search">
						<div class="input-group">
							<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
									<i class="fas fa-search fa-sm"></i>
								</button>
							</div>
						</div>
					</form>
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Valerie Luna</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
								<a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
							</div>
						</li>
					</ul>
				</nav>

				<div class="container-fluid">
					<h1 class="h2 mb-2 text-gray-800">Product</h1><br>
					<div class="card shadow mb-4 text-dark">
						<div class="card-header bg-white py-3">
							<h5 class="m-0 text-primary">
								Product Catalog
								<a href="product-input.php" class="btn btn-primary shadow" style="float: right;">Add Product</a>
							</h5>
						</div>
						<div class="card-body">
							<div class="card-columns">
								<?php foreach($rows as $value): ?>
								<div class="card">
									<img class="card-img-top" src="images/<?php echo $value[2]; ?>" style="object-fit: cover">
									<div class="card-body">
										<p class="card-text text-center"><?php echo $value[1]; ?>
										<a style="float: right;" href="product-edit.php?id=<?php echo $value[0]; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
										<a style="float: right;" href="product-delete.php?id=<?php echo $value[0]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></p> 
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
	<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="js/sb-admin-2.min.js"></script>
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="js/demo/datatables-demo.js"></script>
</body>
</html>