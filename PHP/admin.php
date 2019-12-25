<?php
session_start();
require("prdModel.php");
//check whether the user has logged in or not
if ( ! isSet($_SESSION['Name'] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: ../index.html");
} else if($_SESSION['RoleID'] == 'User') {
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
	$result=getPrdList();
?>
<h1>admin mode</h1>
<td><a href="logout.php">Logout</a></td>
<td><a href="add_product.php">add product</a></td>
<td><a href="delete_product.php">delete product</a></td>
<td><a href="user.php">head to user interface</a></td>
<td><a href="orderliststatus.php">order list</a></td>   
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>price</td>
	<td>detail</td>
  </tr>
<?php
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['PID'] . "</td>";
	echo "<td>{$rs['name']}</td>";
	echo "<td>" , $rs['price'], "</td>";
	echo "<td>{$rs['detail']}</td>";
	//echo "<td>"<input type="hidden" value=".$rs['name']."></td>";
	//echo "<td><input type="submit" name="changeproduct" value="Change Product" class="click"></td>";
}
?>
</table>
<form name="productForm" method="post" action="change_product.php">
<p>change product based on product id</p>
<input type="number" name="PID" id="PID" required>
<td>
	<input type="submit" name="changeproduct" value="Change Product" class="click">
</td>
</form>
</body>
</html> 