<?php
session_start();
include_once("dbconfig.php");
//check whether the user has logged in or not
if ( ! isSet($_SESSION['Name'] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: index.html");
} else if($_SESSION['RoleID'] == 'User') {
	// if roleid is user 
	header("Location: user.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css">
<title>Shopping Website</title>
</head>
<body>
<hr>
<?php
	echo "Hello ", $_SESSION['Name'],
	", Your Role is: ", $_SESSION['RoleID'],"<HR>";
?>
<h1>Deliver Page</h1>
<h2>Product List/Change Status</h2>
<td><a href="logout.php">Logout</a></td>
<table width="200" border="1">
  <tr>
    <td>Order ID</td>
    <td>Date/time</td>
	<td>Name</td>
	<td>Bill ID</td>
    <td>Product id</td>
    <td>quantity</td>
	<td>adderess</td>
	<td>status</td>
  </tr>
<?php
	global $db;
	$sql = "SELECT ol.orderID,ol.Name,ol.billID,(select bl.date from billlist as bl where ol.billid = bl.billid) as a, ol.PID, ol.quantity,ol.address,ol.status FROM orderlist as ol order by ol.address";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	//mysqli_stmt_bind_param($stmt, "ss", $ID, $passWord); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	while ($rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" , $rs['orderID'] , "</td>";
	echo "<td>" , $rs['a'], "</td>";
	echo "<td>" , $rs['Name'] , "</td>";
	echo "<td>" , $rs['billID'], "</td>";
	echo "<td>{$rs['PID']}</td>";
	echo "<td>{$rs['quantity']}</td>";
	echo "<td>" , $rs['address'], "</td>";
	echo "<td>" , $rs['status'], "</td>";
}
?>
</table>
<form name="orderlist" method="post" action="change_status_deliever.php">
<p>change status based on orderID</p>
<input type="number" name="orderid" id="orderid" required>
<td>
	<input type="submit" name="changestatus" value="Change Status" class="click">
</td>
</form>
</body>
</html>