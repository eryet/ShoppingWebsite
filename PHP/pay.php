<?php
session_start();
include_once("dbconfig.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
//check whether the user has logged in or not
if ( ! isSet($_SESSION['Name'] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: index.html");
}
?>
<?php
		date_default_timezone_set("Asia/Taipei");
		global $db;
		$place = $_POST['address'];
		$uname = $_SESSION['Name'];
		if(isset($_SESSION["cart_item"])){
			$sql = "INSERT INTO billlist (Name, address) VALUES ('".$uname."', '".$place."')";
			if (mysqli_query($db,$sql)){
				$bill =	mysqli_insert_id($db);
				foreach ($_SESSION["cart_item"] as $item){
					$sql2 = "INSERT INTO orderlist(Name, billID, PID, quantity, address) VALUES ('".$uname."','".$bill."', '".$item["PID"]."','".$item["quantity"]."','".$place."')";
					if (mysqli_query($db,$sql2)){
						echo '<script language="javascript">';
						echo 'alert("Checkout succesfully!!");';
						echo 'window.location.href="user.php";';
						echo '</script>';
						unset ($_SESSION["cart_item"]);
						unset ($_SESSION["total_price"]);
					}
				}
		   } else {
			echo '<script language="javascript">';
			echo 'alert("Error occured!!");';
			echo 'window.location.href="user.php";';
			echo '</script>';
			}
		}	
?>