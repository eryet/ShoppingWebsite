<?php
require_once("dbconfig.php");
require_once("userModel.php");
session_start();
	
if($_SERVER['REQUEST_METHOD']=='POST')
{
	global $db;
	$name = $_POST['Name'];
	$password = $_POST['Password'];
	$password = md5($password);
	$role = "SELECT roleID FROM user WHERE Name='".$name."' AND Password='".$password."' ";
	$check = "SELECT * FROM user WHERE Name='".$name."' AND Password='".$password."' ";
	$result = mysqli_query($db,$check);
	if(mysqli_num_rows($result) == 1) 
	{
		$row = mysqli_fetch_array($result);
		$_SESSION['Name'] = $name;
		$_SESSION['RoleID'] = $role;
		$userProfile = getUserProfile($name ,$role);
		$_SESSION['loginProfile'] = $userProfile;
		header("Location: ../user.html");
	}
	
	else
	{
		echo '<script type="text/javascript"> alert("Wrong password/Wrong name");
		</script>';
	}
	// can set on admin.php to force people out of it
	// if(isset($_SESSION['Name'])){

}
?>