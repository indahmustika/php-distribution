<?php 

function insertOrder($UserInternalId, $InvInternalId, $Quantity){
	$connect  = mysqli_connect("localhost", "root", "", "distribution");
	$sql = "INSERT INTO checkout VALUES (NULL, '$UserInternalId', '$InvInternalId', '$Quantity', 'Waiting')";
	mysqli_query($connect, $sql);
}
function deleteCart($CartId){
	$connect  = mysqli_connect("localhost", "root", "", "distribution");
	$sql = "DELETE FROM cart WHERE CartId = '$CartId'";
	mysqli_query($connect, $sql);
}

$UserInternalId = $_POST['UserInternalId'];
$InvInternalId	= $_POST['InvInternalId'];
$Quantity		= $_POST['Quantity'];
$CartId			= $_POST['CartId'];
insertOrder($UserInternalId, $InvInternalId, $Quantity);
deleteCart($CartId);
header("location:order-view.php"); 

?>