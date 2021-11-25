<?php 

function updateProduct($InventoryId, $InventoryName, $Image, $Volume, $BuyPrice, $Unit, $Weight){
	include_once('connect.php');
	$sql = "UPDATE inventory SET InventoryName = '$InventoryName', Image = '$Image', Volume = '$Volume', BuyPrice = '$BuyPrice', Unit = '$Unit', Weight = '$Weight' WHERE InventoryId = '$InventoryId'";
	mysqli_query($connect, $sql);
}

$InventoryId	= $_POST['InventoryId'];
$InventoryName  = $_POST['InventoryName'];
$Image			= $_POST['Image'];
$Volume			= $_POST['Volume'];
$BuyPrice		= $_POST['BuyPrice'];
$Unit			= $_POST['Unit'];
$Weight			= $_POST['Weight'];
updateProduct($InventoryId, $InventoryName, $Image, $Volume, $BuyPrice, $Unit, $Weight);
header("location:product-view.php"); 

?>