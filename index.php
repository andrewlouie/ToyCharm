<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<title>Toy Charm</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/stylesheet2.css" rel="stylesheet" type="text/css">
	<link href="jCarousel/ma.onsaleslider.css" rel="stylesheet" type="text/css">    

	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link href="favicon.ico" rel="icon" type="image/x-icon">
	<script src="js/jquery-1.11.2.min.js"></script> <script src="js/bootstrap.js"></script>    

</head>

<body>
<?php include 'headnav.php' ?>
<br>
<div class="main-container">
<div class="container container-fluid">
<?php 
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$rowcount = 0;
	$lastcat = "null";
	echo "<h2><a href='products.php?featured=y'>Featured Items</a></h2><div class='row'>";
	$sql="SELECT item,title,IF(INSTR(pics,',')=0,pics,left(pics,INSTR(pics,',')-1)) AS pics,price,saleprice FROM toys WHERE featured = 1 AND visible = 1 ORDER BY RAND() LIMIT 4;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$result = array();
	$result = $sth->fetchAll();
	foreach($result as $row) {		
		echo "<div class='col-sm-3'><div class='aafeatbox'><div class='center-block'><a href='item.php?id=";
		echo $row['item'];
		echo "'><img src='images/";
		echo $row['pics'];
		echo "' alt='";
		echo $row['title'];
		echo "'/></a></div><span class='aabottom'><span class='aalabel2'><a href='item.php?id=";
		echo $row['item'];
		echo "'>";
		echo $row['title'];
		echo "</a></span><span class='aaprice'>";
		if (!is_null($row['saleprice'])) {
		echo "<s>";
		echo "$";
		echo $row['price'];
		echo "</s> $";
		echo $row['saleprice'];
		}
		else {
		echo "$";
		echo $row['price'];	
		}
		echo "</span></span></div></div>";
	}
	echo "</div><hr><h2><a href='products.php?bestsellers=y'>Best Sellers</a></h2><div class='row'>";
	
	$sql="SELECT item,title,IF(INSTR(pics,',')=0,pics,left(pics,INSTR(pics,',')-1)) AS pics,price,saleprice FROM toys WHERE bestseller = 1 AND visible = 1 ORDER BY RAND() LIMIT 4;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$result = array();
	$result = $sth->fetchAll();
	foreach($result as $row) {		
		echo "<div class='col-sm-3'><div class='aafeatbox'><div class='center-block'><a href='item.php?id=";
		echo $row['item'];
		echo "'><img src='images/";
		echo $row['pics'];
		echo "' alt='";
		echo $row['title'];
		echo "'/></a></div><span class='aabottom'><span class='aalabel2'><a href='item.php?id=";
		echo $row['item'];
		echo "'>";
		echo $row['title'];
		echo "</a></span><span class='aaprice'>";
				if (!is_null($row['saleprice'])) {
		echo "<s>";
		echo "$";
		echo $row['price'];
		echo "</s> $";
		echo $row['saleprice'];
		}
		else {
		echo "$";
		echo $row['price'];	
		}
		echo "</span></span></div></div>";
	}
	
	echo "</div><hr><h2><a href='products.php?sort=4'>New Items</a></h2><div class='row'>";
	
	$sql="SELECT item,title,IF(INSTR(pics,',')=0,pics,left(pics,INSTR(pics,',')-1)) AS pics,price,saleprice FROM toys WHERE visible = 1 ORDER BY date DESC LIMIT 4;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$result = array();
	$result = $sth->fetchAll();
	foreach($result as $row) {		
		echo "<div class='col-sm-3'><div class='aafeatbox'><div class='center-block'><a href='item.php?id=";
		echo $row['item'];
		echo "'><img src='images/";
		echo $row['pics'];
		echo "' alt='";
		echo $row['title'];
		echo "'/></a></div><span class='aabottom'><span class='aalabel2'><a href='item.php?id=";
		echo $row['item'];
		echo "'>";
		echo $row['title'];
		echo "</a></span><span class='aaprice'>";
		if (!is_null($row['saleprice'])) {
		echo "<s>";
		echo "$";
		echo $row['price'];
		echo "</s> $";
		echo $row['saleprice'];
		}
		else {
		echo "$";
		echo $row['price'];	
		}
		echo "</span></span></div></div>";
	}
	
	echo "</div><hr><h2><a href='products.php?sale=y'>On Sale</a></h2><div class='row'>";

	$sql="SELECT item,title,IF(INSTR(pics,',')=0,pics,left(pics,INSTR(pics,',')-1)) AS pics,price,saleprice FROM toys WHERE saleprice IS NOT NULL AND visible = 1 ORDER BY RAND() LIMIT 4;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$result = array();
	$result = $sth->fetchAll();
	foreach($result as $row) {		
		echo "<div class='col-sm-3'><div class='aafeatbox'><div class='center-block'><a href='item.php?id=";
		echo $row['item'];
		echo "'><img src='images/";
		echo $row['pics'];
		echo "' alt='";
		echo $row['title'];
		echo "'/></a></div><span class='aabottom'><span class='aalabel2'><a href='item.php?id=";
		echo $row['item'];
		echo "'>";
		echo $row['title'];
		echo "</a></span><span class='aaprice'>";
		if (!is_null($row['saleprice'])) {
		echo "<s>";
		echo "$";
		echo $row['price'];
		echo "</s> $";
		echo $row['saleprice'];
		}
		else {
		echo "$";
		echo $row['price'];	
		}
				echo "</span></span></div></div>";
	}
	
	$dbh = null;
}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
}

?>

</div>    </div></div>
<?php include 'footer.php' ?>
</body>
</html>