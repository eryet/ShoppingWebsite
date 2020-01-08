<?php
require_once("dbconfig.php");

function getPrdList() {
	global $db;

	$sql = "SELECT PID, name, price, detail FROM products order by PID";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	//mysqli_stmt_bind_param($stmt, "ss", $ID, $passWord); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}

function getTopPrdList() {
	global $db;
	$sql ="SELECT ol.PID, SUM(ol.quantity) as amount,(select name from products as bl where ol.PID = bl.PID) as a FROM orderlist as ol GROUP BY ol.PID ORDER BY SUM(ol.quantity) DESC"; 
	//$sql = "SELECT ol.orderID,ol.Name,ol.billID,(select bl.date from billlist as bl where ol.billid = bl.billid) as a, ol.PID, ol.quantity,ol.address,ol.status FROM orderlist as ol order by ol.address";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	//mysqli_stmt_bind_param($stmt, "ss", $ID, $passWord); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}

function getVipList() {
	global $db;
	$sql ="SELECT Name, SUM(billprice) as amount FROM billlist GROUP BY Name ORDER BY SUM(billprice) DESC";
	//$sql = "SELECT ol.orderID,ol.Name,ol.billID,(select bl.date from billlist as bl where ol.billid = bl.billid) as a, ol.PID, ol.quantity,ol.address,ol.status FROM orderlist as ol order by ol.address";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	//mysqli_stmt_bind_param($stmt, "ss", $ID, $passWord); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}


?>