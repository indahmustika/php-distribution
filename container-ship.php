<?php 

function updateOrder($OrderInternalId){
	$connect  = mysqli_connect("localhost", "root", "", "distribution");
	$sql = "UPDATE checkout SET Status = 'Shipped' WHERE OrderId = '$OrderInternalId'";
	mysqli_query($connect, $sql);
}
function updateContainer($ContainerInternalId){
	$connect  = mysqli_connect("localhost", "root", "", "distribution");
	$sql = "UPDATE container SET Remarks = 'Shipped' WHERE ContainerId = '$ContainerInternalId'";
	mysqli_query($connect, $sql);
}

$ContainerInternalId = $_GET['container'];
$conn 	= mysqli_connect("localhost", "root", "", "distribution");
$sql  	= "SELECT * FROM shipping WHERE ContainerInternalId = '$ContainerInternalId'";
$rows   = array();
$query 	= mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query)) {
	$rows[] = $row;
}
foreach($rows as $value):
	updateOrder($value[2]);	
endforeach;

updateContainer($ContainerInternalId);
header("location:container-add.php?id=$ContainerInternalId"); 

?>