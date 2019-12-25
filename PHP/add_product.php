<?php
session_start();
require("prdModel.php");
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
<h1>admin mode</h1>
<td><a href="logout.php">Logout</a></td>
<td><a href="admin.php">back to product list</a></td>
<table>
<form name="productForm" method="post" action="add.php">
	<p>Add product</p>
	<td colspan="2">
		<label>Name</label>&nbsp;<input type="text" name="name" required>
	</td>
	<td colspan="2">
		<label>price</label>&nbsp;<input type="number" name="price" required>
	</td>
	<td colspan="2">
		<label>detail</label>&nbsp;<input type="text" name="detail" required>
	</td>
</table>
<td>
	<input type="submit" name="addproduct" value="Add Product" class="click">
</td>
</body>
</html> 