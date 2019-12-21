<?php
session_start();
include_once("dbconfig.php");
//check whether the user has logged in or not
if ( ! isSet($_SESSION['Name'] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: index.html");
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
<h1>admin mode</h1>
<h2>Product List/Change Status</h2>
<td><a href="logout.php">Logout</a></td>
<td><a href="add_product.php">add product</a></td>
<td><a href="delete_product.php">delete product</a></td>
<td><a href="user.php">head to user interface</a></td>
<td><a href="admin.php">back to product list</a></td>
<table width="200" border="1">
  <tr>
    <td>Order ID</td>
    <td>Date/time</td>
    <td>Product id</td>
    <td>quantity</td>
	<td>adderess</td>
	<td>status</td>
  </tr>
<?php
	global $db;
	$sql = "SELECT orderID, date, Name, PID, quantity, address, status FROM orderlist ORDER BY orderID";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	//mysqli_stmt_bind_param($stmt, "ss", $ID, $passWord); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	while ($rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" , $rs['orderID'] , "</td>";
	echo "<td>" , $rs['date'] , "</td>";
	echo "<td>" , $rs['PID'], "</td>";
	echo "<td>" , $rs['quantity'], "</td>";
	echo "<td>{$rs['address']}</td>";
	echo "<td>{$rs['status']}</td>";
}
?>
</table>
<form name="orderlist" method="post" action="change_status.php">
<p>change status based on orderID</p>
<input type="number" name="orderid" id="orderid" required>
<td>
	<input type="submit" name="changestatus" value="Change Status" class="click">
</td>
</form>
</body>
</html> 