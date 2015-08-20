	<script>
function getsupport()
	{
	document.getElementById("cart").submit();
	}

	</script>


<div class="container container-fluid">
<div class="pull-right">
<ul class="aanav"><li><a href="contact.php">CONTACT US</a></li><li><a href="faq.php">FAQ</a></li>
<li><?php 
if (!isset($_COOKIE['username'])) { echo "<a href='newacct.php'>CREATE ACCOUNT</a></li><li>"; echo "<a href='login.php'>LOG IN</a>"; }
else { echo "<a href='members.php'>MY ACCOUNT</a></li><li>"; echo "<a href='logout.php'>LOG OUT</a>"; }
?>
</li><li>
<a href="cart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> CART <span id="itemsincart"><?php session_start(); if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
if (!isset($_SESSION['cart2'])) $_SESSION['cart2'] = array(); echo count($_SESSION['cart']); ?></span> ITEMS</a>
<div class="arrow-up"></div><div class="itemadded">Item Added</div>
</li>
</ul>
</div>
<br>
<hr>
<div class="row">
<div class="col-sm-6 aaoops"><a href="index.php">
<img src="include/logo.png" alt="Toy Glee Logo"/></a>
</div>
<div class="col-sm-6">
<span class="pull-right"><?php if (!isset($_COOKIE['username'])) { echo "Welcome!  <a href='login.php'>Login</a> or <a href='newacct.php'>Create</a> an account."; }
else { echo "Welcome to Toy Charm!"; }
?>
</span><br>
<form role="search" action="products.php">
<input type="button" id="aasearchbtn" name="aasearchbtn" value="SEARCH"><input type="text" class="form-control" placeholder="search for anything..." id="aasearchbox" name="searchbox"></form>
</div></div>
<br><br>
<div class="row hidden-sm hidden-xs">
<div class="col-md-1 aasides"></div>
<!--<div class="col-md-1 aacat"><a href="products.php?new=y"><img src="include/new.png" width="80" height="80" alt=""/></a></div>
<div class="col-md-1 aacat"><a href="products.php?sale=y"><img src="include/sale.png" width="80" height="80" alt=""/></a></div>-->

<?php include 'dbconn.php' ?>
<?php 
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$rowcount = 0;
	$lastcat = "null";
	$sql="SELECT * FROM catagory;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$result = array();
	$result = $sth->fetchAll();
	foreach($result as $row) {		
echo "<div class='col-md-1 aacat'><a href='products.php?cat=";
echo $row['cat_id'];
echo "'><img src='include/";
echo $row['small image'];
echo "' width='80' height='80' alt='";
echo $row['catagory'];
echo "'/></a></div>";
	}
	echo "<div class='col-md-1 aacat'><a href='products.php?sale=y'><img src='include/sale.png' width='80' height='80' alt='Sale'></a></div>";
	echo "<div class='col-md-1 aacat'><a href='products.php?sort=4'><img src='include/new.png' width='80' height='80' alt='New'></a></div>";
	echo "<div class='col-md-1 aasides aacat'></div></div><div class='row'><div class='col-md-1 hidden-sm hidden-xs'></div>";
	foreach($result as $row) {
		echo "<div class='col-md-1 aacat2' style='background-color:#";
echo $row['colour'];
echo "'><a href='products.php?cat=";
echo $row['cat_id'];
echo "'>";
echo $row['catagory'];
echo "</a></div>";
	}
	$_SESSION['cats'] = $result;	
	$dbh = null;
}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
}
?>
<div class="col-md-1 aacat2" style='background-color:#f58b33'><a href="products.php?sale=y">Sale</a></div>
<div class="col-md-1 aacat2"  style='background-color:#c0242c'><a href="products.php?sort=4">New</a></div>

<div class="col-md-1 hidden-sm hidden-xs"></div>
</div></div>