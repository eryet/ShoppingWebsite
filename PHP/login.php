<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$name = $_POST['Name'];
	$password = $_POST['Password'];
	$password = md5($password);

	$dbconnect = mysqli_connect('localhost','root','','shopping') or die("Cannot connect to Database ");
	$check = "SELECT * FROM user WHERE Name='".$name."' AND Password='".$password."' ";
	$result = mysqli_query($dbconnect,$check);
	if(mysqli_num_rows($result) == 1) 
	{
		$row = mysqli_fetch_array($result);
		$_SESSION['Name'] = $name;
	}
	else
	{
		echo '<script type="text/javascript"> alert("Wrong password/Wrong name");
		</script>';
	}
}

if(isset($_SESSION['Name'])){

	$admin=$_SESSION['Name'];
	if($admin == 'eryet'){
	header("Location: ../admin.html");
	}
	else
	header("Location: ../user.html");
}
?>