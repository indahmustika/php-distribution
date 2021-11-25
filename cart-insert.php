<?php 

function insertCart($UserInternalId, $InvInternalId, $Quantity){
	include_once('connect.php');
	$sql = "INSERT INTO cart VALUES (NULL, '$UserInternalId', '$InvInternalId', '$Quantity')";
	mysqli_query($connect, $sql);
}

$UserInternalId = $_POST['UserInternalId'];
$InvInternalId	= $_POST['InvInternalId'];
$Quantity		= $_POST['Quantity'];
insertCart($UserInternalId, $InvInternalId, $Quantity);
header("location:cart-view.php"); 

?>