<?php 

function updateProduct($InventoryId, $SellPrice){
	include_once('connect.php');
	$sql = "UPDATE inventory SET SellPrice = '$SellPrice' WHERE InventoryId = '$InventoryId'";
	mysqli_query($connect, $sql);
}

$InventoryId	= $_POST['InventoryId'];
$SellPrice		= $_POST['SellPrice'];
updateProduct($InventoryId, $SellPrice);
header("location:product-sold.php"); 

?>