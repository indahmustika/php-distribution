<?php 

function deleteProduct($InventoryId){
	include_once('connect.php');
	$sql = "DELETE FROM inventory WHERE InventoryID = '$InventoryId'";
	mysqli_query($connect, $sql);
}

$InventoryId = $_GET['id'];
deleteProduct($InventoryId);
header("location:product-view.php"); 

?>