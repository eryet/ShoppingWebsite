<?php
session_start();
require("prdModel.php");
include_once("dbconfig.php");
//check whether the user has logged in or not
if ( ! isSet($_SESSION['Name'] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: index.html");
}
global $db;
$pid = $_POST['PID'];
$_SESSION["PID"] = $pid;
$check="SELECT * FROM products WHERE PID ='".$pid."' ";
$result = mysqli_query($db,$check);
if(mysqli_num_rows($result) == 1)
{
	// Fetch a result row as an associative array
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$price = $row['price'];
	$detail = $row['detail'];
}
else
{
	echo '<script language="javascript">';
	echo 'alert("doesnt have that product id");';
	echo 'window.location.href="admin.php";';
	echo '</script>';
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
<form name="productForm" method="post" action="update_product.php">
	<p>prodcut id=<?php echo $pid; ?></p>
	<td colspan="2">
		<label>Name</label>&nbsp;<input type="text" name="name"id="name" value="<?=$name?>" required>
	</td>
	<td colspan="2">
		<label>price</label>&nbsp;<input type="number" name="price" id="price" value="<?=$price?>">
	</td>
	<td colspan="2">
		<label>detail</label>&nbsp;<input type="text" name="detail" id="detail" value="<?=$detail?>">
	</td>
	<input type="hidden" name="PID" id="PID" value="<?=$pid?>">
</table>
<td>
	<input type="submit" name="changeproduct" value="Change Product" class="click">
</td>
</body>
</html> 