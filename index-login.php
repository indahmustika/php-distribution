<?php

session_start();
include_once('connect.php');
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$sql	  = "SELECT * FROM user WHERE Username = '$Username' AND Password = '$Password'";
$query 	  = mysqli_query($connect, $sql);
$row 	  = mysqli_fetch_array($query);

if ($row['Username'] == $Username AND $row['Password'] == $Password) {
	$_SESSION['Username'] = $row['Username'];
	$_SESSION['Role']	  = $row['Role'];
	if ($row['Role'] == "Buyer") {
		header("location:cart-input.php");
	} elseif ($row['Role'] == "Seller"){
		header("location:product-view.php");
	} else {
		header("location:product-sell.php");
	}
} else {
	header("location:index.php");
}

?>