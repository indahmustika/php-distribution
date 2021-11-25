<?php 

function insertShipping($ContainerInternalId, $OrderInternalId){
	$connect  = mysqli_connect("localhost", "root", "", "distribution");
	$sql = "INSERT INTO shipping VALUES (NULL, '$ContainerInternalId', '$OrderInternalId')";
	mysqli_query($connect, $sql);
}
function updateOrder($OrderInternalId){
	$connect  = mysqli_connect("localhost", "root", "", "distribution");
	$sql = "UPDATE checkout SET Status = 'Loaded' WHERE OrderId = '$OrderInternalId'";
	mysqli_query($connect, $sql);
}
function updateContainer($ContainerInternalId){
	$connect  = mysqli_connect("localhost", "root", "", "distribution");
	$sql = "UPDATE container SET Remarks = 'Loaded' WHERE ContainerId = '$ContainerInternalId'";
	mysqli_query($connect, $sql);
}

$ContainerInternalId = $_GET['container'];
$OrderInternalId 	 = $_GET['order']; 
insertShipping($ContainerInternalId, $OrderInternalId);
updateOrder($OrderInternalId);
updateContainer($ContainerInternalId);
header("location:container-add.php?id=$ContainerInternalId"); 

?>