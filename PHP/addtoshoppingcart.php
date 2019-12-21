<?php
session_start();
require("prdModel.php");
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
<?php
$pid=$_GET['PID'];
$quan=$_POST["quantity"];
echo "<td>".$pid."</td>";
echo "".$quan."</tr></td>";
?>
</body>
</html>