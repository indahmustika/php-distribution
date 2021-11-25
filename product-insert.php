<?php 

function postProduct($InventoryName, $Image, $Volume, $BuyPrice, $Unit, $Weight, $UserCreated){
	include_once('connect.php');
	$sql = "INSERT INTO inventory VALUES (NULL, '$InventoryName', '$Image', '$Volume', '$BuyPrice', NULL,'$Unit', '$Weight', '$UserCreated')";
	mysqli_query($connect, $sql);
}

$InventoryName  = $_POST['InventoryName'];
$Image			= $_POST['Image'];
$Volume			= $_POST['Volume'];
$BuyPrice		= $_POST['BuyPrice'];
$Unit			= $_POST['Unit'];
$Weight			= $_POST['Weight'];
$UserCreated 	= $_POST['UserCreated'];
postProduct($InventoryName, $Image, $Volume, $BuyPrice, $Unit, $Weight, $UserCreated);
header("location:product-view.php"); 

?>