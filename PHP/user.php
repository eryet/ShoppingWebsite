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

//cart view  add/remove
//if action =! null
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	// action == add
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE name='". $_GET["name"] ."'");
			// set array $productByCode["name"]
			$itemArray = array($productByCode[0]["name"]=>array('name'=>$productByCode[0]["name"], 'PID'=>$productByCode[0]["PID"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
		
		// 如果購物車不是空的
		if(!empty($_SESSION["cart_item"])) {
			//  in_array — Checks if a value exists in an array
			//  array_keys — Return all the keys or a subset of the keys of an array
			//  (array_keys) - returns the keys, numeric and string, from the array.
			//  (array_keys) - If a search_value is specified, then only the keys for that value are returned. Otherwise, all the keys from the array are returned. 
				if(in_array($productByCode[0]["name"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["name"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	// action == remove
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["name"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	// action = empty
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
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
	", Your Role is: ", $_SESSION['RoleID'],"<HR>
	, Your Credit is: ", $_SESSION['credit'],"<HR>";
	$result=getPrdList();
?>
<h1>User mode</h1>
<td><a href="logout.php">Logout</a></td>
<td><a href="orderlist.php">Check Order</a></td>
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>price</td>
	<td>detail</td>
	<td>quantity</td>
	<td>&nbsp;</td>
  </tr>

<?php
//get table products through prdModel.php/display and submit back through form
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['PID'] . "</td>";
	echo "<td>{$rs['name']}</td>";
	echo "<td>" , $rs['price'], "</td>";
	echo "<td>{$rs['detail']}</td>";
	echo '
		<form name="addproduct" method="post" action="user.php?action=add&name='.$rs['name'].'">
		<td><input type="number" id="quantity" name="quantity" value="1" min="1"></td>
	    <td><input type="submit" id="addtocart" name="addtocart" value="Add to cart"></td>
		</form>';
}
?>
</table>

<h1>Shopping Cart</h1>
<a href="user.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>quantity</td>
	<td>price</td>
	<td>total unit price</td>
	<td>&nbsp;</td>
  </tr>
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><?php echo $item["PID"]; ?></td>
				<td><?php echo $item["name"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td><?php echo $item["price"]; ?></td>
				<td><?php echo number_format($item_price,2); ?></td>
				<td>
				<a href="user.php?action=remove&name=<?php echo $item["name"]; ?>">
				remove item</a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="left">Total:</td>
<td> <?php echo $total_quantity; ?></td>
<td colspan="2" align="right"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td><a href="checkout.php">checkout</a></td>
</tr>
</table>		
  <?php
} else {
?>
<p>Your Cart is Empty<p>
<?php 
}
?>
</body>
</html> 