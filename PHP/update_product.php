<?php
require_once("dbconfig.php");

if(isset($_POST['changeproduct']))
{
	global $db;
	$name = $_POST['name'];
	$price = $_POST['price'];
	$detail = $_POST['detail'];
	$upid = $_POST["PID"];

	$sql = "UPDATE products SET name = '".$name."', price = '".$price."', detail = '".$detail."' WHERE PID = '".$upid."' ";

	if ($db->query($sql) === TRUE) {
		echo '<script language="javascript">';
		echo 'alert("update succesfully!!");';
		echo 'window.location.href="admin.php";';
		echo '</script>';
	}
}
?>