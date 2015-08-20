<?php include '../dbconn.php' ?>
<?php
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
    foreach($dbh->query('SELECT item,title FROM toys ORDER BY date DESC') as $row) {
	echo $row["item"];
	echo "||";
	echo $row["title"];
	echo "||";
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
