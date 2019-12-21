<?php
session_start();
include_once("dbconfig.php");
		
		global $db;
		$name = ($_POST['name']);
		$price = ($_POST['price']);
		$detail = ($_POST['detail']);

$sql = "INSERT INTO products(name,price,detail) VALUES ('$name','$price','$detail')";

if (mysqli_query($db,$sql)){
	echo '<script language="javascript">';
	echo 'alert("New Product Added! Add more!");';
	echo 'window.location.href="add_product.php";';
	echo '</script>';
} 
else 
{
	echo '<script language="javascript">';
	echo 'alert("Error occured!!");';
	echo 'window.location.href="add_product.php";';
	echo '</script>';
}
?>
