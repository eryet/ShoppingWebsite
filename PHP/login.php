<?php
require_once("dbconfig.php");
session_start();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	global $db;
	$name=$_POST['Name'];
	$password=$_POST['Password'];
	$password=md5($password);
	$check="SELECT * FROM user WHERE Name='".$name."' AND Password='".$password."' ";
	$result=mysqli_query($db,$check);
	if(mysqli_num_rows($result) == 1)                         
	{
		// Fetch a result row as an associative array
		$row = mysqli_fetch_assoc($result);
		// result array_$row[RoleID]
		if ($row['RoleID'] == 'Admin') {
			$role = $row['RoleID'];
			$_SESSION['RoleID']= $role;
			$_SESSION['Name']= $name;
			header("Location: admin.php");
		}
		else {
			$role = $row['RoleID'];
			$_SESSION['RoleID']= $role;
			$_SESSION['Name']= $name;
			header("Location: user.php");
		}
	}	
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Wrong Password/Name");';
		echo 'window.location.href="../index.html";';
		echo '</script>';
	}
	// can set on admin.php to force people out of it
	// if(isset($_SESSION['Name'])){

}
?>