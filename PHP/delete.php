<?php
	session_start();
    include_once("dbconfig.php");

			global $db;
			$pid = ($_POST['PID']);
	
	
$sql = "DELETE FROM products WHERE PID='".$pid."'"; 

if (mysqli_query($db, $sql)) 
{
	echo '<script language="javascript">';
	echo 'alert("Product deleted successfully!!");';
	echo 'window.location.href="delete_product.php";';
	echo '</script>';
}
else 
{
	echo '<script language="javascript">';
	echo 'alert("No such product");';
	echo 'window.location.href="delete_product.php";';
	echo '</script>';
}