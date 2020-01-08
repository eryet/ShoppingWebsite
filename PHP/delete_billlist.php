<?php
session_start();
require_once("dbconfig.php");

	global $db;
	$billid = $_POST['billid'];
	$user= $_SESSION['Name'];
	$check = "SELECT ol.deliverystatus FROM orderlist as ol WHERE billID = $billid and deliverystatus = 0";
	$result = mysqli_query($db,$check);
	if(mysqli_num_rows($result) == 0) {
			$sql = "DELETE FROM orderlist WHERE billID = $billid and deliverystatus = 0";
			mysqli_query($db, $sql);
			echo '<script language="javascript">';
			echo 'alert("Cant delete,item has been delieverd!!!");';
			echo 'window.location.href="orderlist.php";';
			echo '</script>';
	} else {
		$sql = "DELETE FROM orderlist WHERE billID = $billid and deliverystatus = 0";
		mysqli_query($db, $sql);
		$sql = "DELETE FROM billlist WHERE billID = $billid";
		if ($db->query($sql) === TRUE) {
			$sql = "UPDATE user SET Credit = Credit + 1 WHERE Name = '$user'";
			mysqli_query($db, $sql);
			echo '<script language="javascript">';
			echo 'alert("delete succesfully!!, credit +1,when reach credit 5 cannot continue purchase!!");';
			echo 'window.location.href="orderlist.php";';
			echo '</script>';
		} else {
			echo '<script language="javascript">';
			echo 'alert("error!!");';
			echo 'window.location.href="orderlist.php";';
			echo '</script>';
		}
	}
?>