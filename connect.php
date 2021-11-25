<?php 
	$HostName = "localhost"; 
	$HostUser = "root";
	$HostPass = "";
	$Database = "distribution";
	$connect  = mysqli_connect($HostName, $HostUser, $HostPass, $Database) or die('Unable to Connect');
?>