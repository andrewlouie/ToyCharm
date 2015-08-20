<?php include '../dbconn.php' ?>
<?php
$date = $_POST['date'];
$itemno = $_POST['q'];
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$longdesc = $dbh->quote($_POST['d']);
	$title = $dbh->quote($_POST['b']);
	$pics = $dbh->quote($_POST['c']);
	$shortdesc = $dbh->quote($_POST['e']);
	$price = $dbh->quote($_POST['f']);
	$featured = $dbh->quote($_POST['g']);
	$quantity = $dbh->quote($_POST['h']);
	$visible = $dbh->quote($_POST['i']);
	$catid = $dbh->quote($_POST['j']);

	if ($itemno == 0) {
		$sql="INSERT INTO toys (item, title, shortdesc, date, price, pics, featured, longdesc, quantity, visible, cat_id) VALUES (NULL, $title, $shortdesc, '$date', $price, $pics, $featured, $longdesc, $quantity, $visible, $catid)";
	}
	else {
		$sql="UPDATE toys SET title = $title, shortdesc = $shortdesc, date = '$date', price = $price, pics = $pics, featured =  $featured, longdesc = $longdesc, quantity = $quantity, visible = $visible, cat_id = $catid WHERE item = '$itemno'";
	}
	$sth = $dbh->prepare($sql);	
	$sth->execute();
	echo $dbh->lastInsertId();
	$dbh = null;
}
catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>