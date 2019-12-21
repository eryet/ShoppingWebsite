<?php
session_start();
require("prdModel.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
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
<hr>
<?php
	echo "Hello ", $_SESSION['Name'],
	", Your Role is: ", $_SESSION['RoleID'],"<HR>";
	$result=getPrdList();
?>
<h1>User mode</h1>
<h1>Shopping Cart</h1>
<h2>CONFIRM UR ORDER</h2>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
<form name="productForm" method="post" action="pay.php">	
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>quantity</td>
	<td>price</td>
	<td>total unit price</td>
  </tr>
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><?php echo $item["PID"]; ?></td>
				<td><?php echo $item["name"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td><?php echo "$ ".$item["price"]; ?></td>
				<td><?php echo "$ ". number_format($item_price,2); ?></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
				$_SESSION["total_price"] = $total_price;
		}
		?>

<tr>
<td colspan="2" align="left">Total:</td>
<td> <?php echo $total_quantity; ?></td>
<td colspan="2" align="right"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
</tr>
</table>		
  <?php
} else {
?>
<p>Your Cart is Empty<p>
<?php 
}
?>
<a href="user.php">Still wanna Add/remove product</a>
<p>Address:</p><input type="text" name="address" id="address" required>
<input type="submit" name="confirmcheckout" value="Confirm pay" class="click">
</form>
</body>
</html> 