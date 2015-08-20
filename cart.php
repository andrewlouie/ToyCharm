<?php include 'dbconn.php' ?>
<?php 
$loc = "";
if (isset($_COOKIE['username'])) {
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$sql = "SELECT IF(prov='Other',country,prov) AS prov FROM users WHERE email = '" . $_COOKIE['username'] . "';";
    foreach($dbh->query($sql) as $row) {
		$loc = $row['prov'];
} 
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
<?php
echo "<script>loc = '" . $loc . "'; </script>";
?>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<title>Toy Charm</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/stylesheet2.css" rel="stylesheet" type="text/css">

	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link href="favicon.ico" rel="icon" type="image/x-icon">
	<script src="js/jquery-1.11.2.min.js"></script> <script src="js/bootstrap.js"></script>    
<script>
function deleteItem(item) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("aacart").deleteRow(item.parentNode.parentNode.rowIndex);
			document.getElementById('itemsincart').innerHTML = xmlhttp.responseText;
			a = 0;
			for (i=1;i<document.getElementById('aacart').rows.length-2;i++) {
				a = a + parseFloat(document.getElementById('aacart').rows[i].cells[5].innerHTML.substring(1));
			}
			for (i=0;i<document.querySelectorAll('[name^="quantity"]').length;i++) {
			document.querySelectorAll('[name^="quantity"]')[i].setAttribute('name','quantity_' + (i+1));
			document.querySelectorAll('[name^="item_name_"]')[i].setAttribute('name','item_name_' + (i+1));
			document.querySelectorAll('[name^="item_number_"]')[i].setAttribute('name','item_number_' + (i+1));
			document.querySelectorAll('[name^="amount_"]')[i].setAttribute('name','amount_' + (i+1));
			}
			shippp = shipping(a);
			document.getElementsByName('shipping_1')[0].value = shippp;
			if (shippp == 0) document.getElementById('aashippingcell').innerHTML = "TBD";
			else document.getElementById('aashippingcell').innerHTML = "$" + shippp;
			document.getElementById('aatotalcell').innerHTML = "<strong>$" + (a + shippp).toFixed(2) + "</strong>";

		}
	}
	xmlhttp.open("GET", "deleteitm.php?item=" + item.parentNode.parentNode.rowIndex, true);
	xmlhttp.send();
}
function updateCart(item) {
	if (item.parentNode.previousSibling.previousSibling.previousSibling.childNodes[0].value < 1) { alert("Quantity must be a positive number"); return; }
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			item.parentNode.previousSibling.previousSibling.previousSibling.childNodes[0].value = xmlhttp.responseText;
			document.getElementsByName('quantity_' + item.parentNode.parentNode.rowIndex)[0].value = xmlhttp.responseText;
			item.parentNode.previousSibling.innerHTML = "$" + (item.parentNode.previousSibling.previousSibling.innerHTML.substring(1) * xmlhttp.responseText).toFixed(2);
			a = 0;
			for (i=1;i<document.getElementById('aacart').rows.length-2;i++) {
				a = a + parseFloat(document.getElementById('aacart').rows[i].cells[5].innerHTML.substring(1));
			}
			shippp = shipping(a);
			document.getElementsByName('shipping_1')[0].value = shippp;
			if (shippp == 0) document.getElementById('aashippingcell').innerHTML = "TBD";
			else document.getElementById('aashippingcell').innerHTML = "$" + shippp;
			document.getElementById('aatotalcell').innerHTML = "<strong>$" + (a + shippp).toFixed(2) + "</strong>";
		}
	}
	xmlhttp.open("GET", "updateitm.php?item=" + item.parentNode.parentNode.rowIndex + "&qty=" + item.parentNode.previousSibling.previousSibling.previousSibling.childNodes[0].value, true);
	xmlhttp.send();
}
</script>
</head>

<body>
<?php include 'headnav.php' ?>
<script>
function shipping(total) {
	if (total == 0) return 0;
	switch(loc) {
	case "British Columbia": 
	if (total <= 49.99) shipp = 6.99;
	else if (total <= 99.99) shipp = 8.99;
	else if (total <= 249.99) shipp = 11.99;
	else shipp = 13.99;
	break;
	case "Alberta":
	if (total <= 49.99) shipp = 8.99;
	else if (total <= 99.99) shipp = 10.99;
	else if (total <= 249.99) shipp = 12.99;
	else shipp = 14.99;
	break;
	case "Manitoba":
	case "Ontario":
	case "Saskatchewan":
	if (total <= 49.99) shipp = 11.99;
	else if (total <= 99.99) shipp = 13.99;
	else if (total <= 249.99) shipp = 16.99;
	else shipp = 17.99;
	break;
	case "Quebec":
	if (total <= 49.99) shipp = 12.99;
	else if (total <= 99.99) shipp = 14.99;
	else if (total <= 249.99) shipp = 17.99;
	else shipp = 18.99;
	break;
	case "Newfoundland":
	case "New Brunswick":
	case "Nova Scotia":
	case "PEI":
	if (total <= 49.99) shipp = 13.99;
	else if (total <= 99.99) shipp = 15.99;
	else shipp = 18.99;
	break;
	case "Nunavut":
	case "Yukon":
	case "Northwest Territories":
	if (total <= 49.99) shipp = 24.99;
	else if (total <= 99.99) shipp = 29.99;
	else shipp = 34.99;
	break;
	case "United States":
	if (total <= 49.99) shipp = 19.99;
	else if (total <= 99.99) shipp = 23.99;
	else if ($total <= 249.99) shipp = 29.99;
	else shipp = 0;
	break;
	default:
	shipp = 0;
	break;
    }
	return shipp;
}
</script>
<br>
<div class="main-container">
<div class="container container-fluid">
<h2>Shopping Cart</h2>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<table id="aacart" class="table-responsive table-hover table-striped">
<tr><th></th><th>Item Number</th><th>Product Title</th><th>Quantity</th><th>Price</th><th>Total</th><th>Update</th><th>Remove</th></tr>

<?php 
$total = 0;
for ($i=0;$i<count($_SESSION['cart']);$i++) {
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
    foreach($dbh->query("SELECT title,IF(INSTR(pics,',')=0,pics,left(pics,INSTR(pics,',')-1)) AS pics,IF(ISNULL(saleprice),price,saleprice) AS price FROM TOYS WHERE item = " . $_SESSION['cart'][$i]) as $row) {
	echo "<tr><td>";
	echo "<img src='images/";
	echo $row['pics'];
	echo "'></td><td>";
	echo $_SESSION['cart'][$i];
	echo "</td><td><a href='item.php?id=";
	echo $_SESSION['cart'][$i];
	echo "'>";
	echo $row['title'];
	echo "</a></td><td><input type='number' min='1' step='1' value='";
	echo $_SESSION['cart2'][$i];
	echo "'></td><td>$";
	echo number_format($row['price'],2);
	echo "</td><td>$";
	echo number_format($row['price'] * $_SESSION['cart2'][$i],2);
	echo "</td><td>";
	echo "<input type='button' value='Update' onclick='updateCart(this)'>";
	echo "</td><td>";
	echo "<input type='button' value='Delete' onclick='deleteItem(this)'>";
	echo "<input type='hidden' name='item_name_";
	echo $i + 1;
	echo "' value='";
	echo $row['title'];
	echo "'>";
	echo "<input type='hidden' name='item_number_";
	echo $i + 1;
	echo "' value='";
	echo $_SESSION['cart'][$i];
	echo "'>";
	echo "<input type='hidden' name='amount_";
	echo $i + 1;
	echo "' value='";
	echo $row['price'];
	echo "'>";
	echo "<input type='hidden' name='quantity_";
	echo $i + 1;
	echo "' value='";
	echo $_SESSION['cart2'][$i];
	echo "'>";
	echo "</td></tr>";
	$total = $total + ($row['price'] * $_SESSION['cart2'][$i]);
	switch ($loc) {
	case "British Columbia": 
	if ($total <= 49.99) $shipping = 6.99;
	elseif ($total <= 99.99) $shipping = 8.99;
	elseif ($total <= 249.99) $shipping = 11.99;
	else $shipping = 13.99;
	break;
	case "Alberta":
	if ($total <= 49.99) $shipping = 8.99;
	elseif ($total <= 99.99) $shipping = 10.99;
	elseif ($total <= 249.99) $shipping = 12.99;
	else $shipping = 14.99;
	break;
	case "Manitoba":
	case "Ontario":
	case "Saskatchewan":
	if ($total <= 49.99) $shipping = 11.99;
	elseif ($total <= 99.99) $shipping = 13.99;
	elseif ($total <= 249.99) $shipping = 16.99;
	else $shipping = 17.99;
	break;
	case "Quebec":
	if ($total <= 49.99) $shipping = 12.99;
	elseif ($total <= 99.99) $shipping = 14.99;
	elseif ($total <= 249.99) $shipping = 17.99;
	else $shipping = 18.99;
	break;
	case "Newfoundland":
	case "New Brunswick":
	case "Nova Scotia":
	case "PEI":
	if ($total <= 49.99) $shipping = 13.99;
	elseif ($total <= 99.99) $shipping = 15.99;
	else $shipping = 18.99;
	break;
	case "Nunavut":
	case "Yukon":
	case "Northwest Territories":
	if ($total <= 49.99) $shipping = 24.99;
	elseif ($total <= 99.99) $shipping = 29.99;
	else $shipping = 34.99;
	break;
	case "United States":
	if ($total <= 49.99) $shipping = 19.99;
	elseif ($total <= 99.99) $shipping = 23.99;
	elseif ($total <= 249.99) $shipping = 29.99;
	else $shipping = 0;
	break;
	default:
	$shipping = 0;
	break;
    }
	}
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
}
echo "<tr><td></td><td></td><td><strong>SHIPPING</strong></td><td></td><td></td><td id='aashippingcell'>";
if ($loc == "" || count($_SESSION['cart']) == 0) { echo "TBD"; $shipping = 0; }
elseif (!isset($shipping) || $shipping == 0) { echo "Please contact for shipping info"; $shipping = 0; }
else echo "$" . number_format($shipping,2);
echo "</td><td><input type='hidden' name='shipping_1' value='" . $shipping . "'></td><td></td>";
echo "<tr><td></td><td></td><td><strong>TOTAL</strong></td><td></td><td></td><td id='aatotalcell'><strong>$" . number_format($total + $shipping,2) . "</strong></td><td></td><td></td>";
?>

</table>

<!-- Don't forget shipping input -->
<?php
if ($loc != "") {
echo "<input type='hidden' name='cmd' value='_cart'><input type='hidden' name='upload' value='1'><input type='hidden' name='business' value='ToyCharm@gmail.com'><input type='hidden' name='item_name' value='Item Name'><input type='hidden' name='currency_code' value='CAD'><input type='hidden' name='amount' value='0.00'><input type='image' src='include/paypal2.jpg' name='submit' alt='Make payments with PayPal - it's fast, free and secure!' class='pull-right'></form>";
}
else echo "</form><form action='newacct.php' method='post'><input type='submit' value='CHECK OUT' class='aabtn pull-right'></form>";
?>
</div></div>
<?php include 'footer.php' ?>
</body>
</html>