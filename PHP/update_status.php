<?php
require_once("dbconfig.php");

if(isset($_POST['changestatus']))
{
	global $db;
	$status = $_POST['status'];
	$orderid = $_POST["orderid"];

	$sql = "UPDATE orderlist SET status = '".$status."' WHERE orderID = '".$orderid."' ";

	if ($db->query($sql) === TRUE) {
		echo '<script language="javascript">';
		echo 'alert("update succesfully!!");';
		echo 'window.location.href="orderliststatus.php";';
		echo '</script>';
	}
}
?>