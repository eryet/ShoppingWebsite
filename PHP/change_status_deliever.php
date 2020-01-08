<?php
session_start();
require("prdModel.php");
include_once("dbconfig.php");
if ( ! isSet($_SESSION['Name'] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: index.html");
} else if($_SESSION['RoleID'] == 'User') {
	// if roleid is user 
	header("Location: user.php");
}
global $db;
$orderid = $_POST['orderid'];
$_SESSION["orderid"] = $orderid;
$check="SELECT * FROM orderlist WHERE orderID ='".$orderid."' ";
$result = mysqli_query($db,$check);
if(mysqli_num_rows($result) == 1)
{
	// Fetch a result row as an associative array
	$row = mysqli_fetch_assoc($result);
	$status = $row['status'];
}
else
{
	echo '<script language="javascript">';
	echo 'alert("doesnt have that orderid");';
	echo 'window.location.href="orderliststatus.php";';
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
<h1>Deliver mode</h1>
<h2>change status</h2>
<td><a href="logout.php">Logout</a></td>
<td><a href="deliver.php">back to order list</a></td>
<table>
<form name="productlist" method="post" action="update_status.php">
	<p>Order id=<?php echo $orderid; ?></p>
	<td colspan="2">
		<label>status</label>&nbsp;<input type="text" name="status" id="status" value="<?=$status?>" required>
	</td>
	<input type="hidden" name="orderid" id="orderid" value="<?=$orderid?>">
</table>
<td>
	<input type="submit" name="changestatus" value="Change Status" class="click">
</td>
</body>
</html> 