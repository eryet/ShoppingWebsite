<?php
session_start();
require_once("dbconfig.php");
//check whether the user has logged in or not
if ( ! isSet($_SESSION['Name'] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: index.html");
} //else if($_SESSION['RoleID'] == 'User') {
	// if roleid is user 
	//header("Location: user.php");
//}			
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
<h1>User mode</h1>
<td><a href="logout.php">Logout</a></td>
<td><a href="user.php">back to product list</a></td>
<table width="200" border="1">
  <tr>
    <td>Bill ID</td>
    <td>Date/time</td>
	<td>adderess</td>
  </tr>

<?php
	global $db;
	$sql = "SELECT billID, Date, address FROM billlist WHERE name ='".$_SESSION['Name']."' ORDER BY billID";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	//mysqli_stmt_bind_param($stmt, "ss", $ID, $passWord); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	while ($rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" , $rs['billID'] , "</td>";
	echo "<td>" , $rs['Date'] , "</td>";
	echo "<td>{$rs['address']}</td>";
	echo '
		<form name="listorder" method="post" action="orderdetail.php?bill='.$rs['billID'].'">
	    <td><input type="submit" id="listorder" name="listorder" value="Check order detail"></td>
		</form>';
}
?>
</table>
</body>
</html> 