<?php
session_start();
require_once("dbconfig.php");

if(isset($_POST['changestatus']))
{
	global $db;
	$status = $_POST['status'];
	$orderid = $_POST["orderid"];

	if ($_SESSION['RoleID'] == 'Admin') {
			$sql = "UPDATE orderlist SET status = '".$status."' WHERE orderID = '".$orderid."' ";
			mysqli_query($db, $sql);
			echo '<script language="javascript">';
			echo 'alert("update succesfully!!");';
			echo 'window.location.href="orderliststatus.php";';
			echo '</script>';
	} else if ($_SESSION['RoleID'] == 'Deliver') {
			$sql = "UPDATE orderlist SET status = '".$status."' WHERE orderID = '".$orderid."' ";
			mysqli_query($db, $sql);
			if ($db->query($sql) === TRUE){
				$sql2 = "UPDATE orderlist SET deliverystatus = 1 WHERE orderID = '".$orderid."' ";
				mysqli_query($db, $sql2);
				echo '<script language="javascript">';
				echo 'alert("update succesfully!!");';
				echo 'window.location.href="deliver.php";';
				echo '</script>';
			}
	}
}
?>