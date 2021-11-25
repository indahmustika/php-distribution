<?php 

function insertContainer($Code, $Volume){
	include_once('connect.php');
	$sql = "INSERT INTO container VALUES (NULL, '$Code', '$Volume', 'Empty')";
	mysqli_query($connect, $sql);
}

$Code 	= $_POST['Code'];
$Volume = $_POST['Volume'];
insertContainer($Code, $Volume);
header("location:container-view.php"); 

?>