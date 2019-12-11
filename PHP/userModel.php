<?php
require_once("dbconfig.php");

function getUserProfile($name, $password) {
	global $db;
	$sql = "SELECT Name, Password  FROM user WHERE Name=? and Password=?";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($name, $password); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
			
	if ($row=mysqli_fetch_assoc($result)) {
		//return user profile
		$ret=array('Name' => $row['Name'], 'RoleID' => $row['RoleID']);
	} else {
		//Name, password are not correct
		$ret=NULL;
	}
	return $ret;

}