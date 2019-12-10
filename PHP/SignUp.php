<?php
	session_start();
	
	$db=mysqli_connect("localhost", "root", "", "shopping");
	if(isset($_POST['SignUp'])) {
		
		$name = ($_POST['Name']);
		$password = ($_POST['Password']);
		$sql;
		$password=md5($password);
    if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
    $sql_name = "SELECT * FROM user WHERE Name='$name'";
  	$check = mysqli_query($db, $sql_name);

  	if (mysqli_num_rows($check) > 0) {
  	  echo "Sorry... username already taken"; 	
  	} else if (mysqli_num_rows($check) == 0) {
		$sql = "Insert into user(Name,Password) values ('$name','$password')";
		$insert = mysqli_query($db, $sql);
		echo "<br>New user created successfully";
		echo "<br>$name";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
?>