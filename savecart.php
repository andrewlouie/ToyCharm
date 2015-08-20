<?php include 'dbconn.php' ?>
<?php
session_start();
$q = $_REQUEST['q'];
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$sql = "DELETE FROM cart WHERE user_id = " . $q . ";";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	for ($i = 0;$i<count($_SESSION['cart']);$i++) {
	$sql = "INSERT INTO cart (item_id, qty, user_id) VALUES (" . $_SESSION['cart'][$i] . "," . $_SESSION['cart2'][$i] . "," . $q . ");";
	$sth = $dbh->prepare($sql);
	$sth->execute();
}
	$dbh = null;
}
catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>