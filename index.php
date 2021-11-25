<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login</title>
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
	<div id="container">
		<div class="col-4 offset-4">
			<div class="card shadow mt-5">
				<div class="card-body">
					<div class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
						<div class="sidebar-brand-icon text-gray-400"><i class="fas fa-circle"></i></div>
						<div class="sidebar-brand-text mx-3 text-gray-400"><b>DISTRIBUTION</b></div>
					</div><hr>
					<form action="index-login.php" method="POST">
						<div class="row mb-3 mt-2">
							<div class="col-sm-4"><label>Username</label></div>
							<div class="col-sm-8"><input class="form-control" type="text" name="Username"></div>
						</div>
						<div class="row mb-4">
							<div class="col-sm-4"><label>Password</label></div>
							<div class="col-sm-8"><input class="form-control" type="password" name="Password"></div>
						</div>
						<input type="submit" name="save" value="Enter" class="btn btn-primary btn-block shadow">
					</form>
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