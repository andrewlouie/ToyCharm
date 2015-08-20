<?php include '../dbconn.php' ?>
<?php
$q = $_REQUEST["q"];
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$sql = "DELETE FROM toys WHERE item = " . $q;
	$sth = $dbh->prepare($sql);	
	$sth->execute();
	$dbh = null;
}
catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>