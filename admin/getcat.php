<?php include '../dbconn.php' ?>
<?php
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
    foreach($dbh->query('SELECT * FROM catagory') as $row) {
	echo $row["cat_id"];
	echo "||";
	echo $row["catagory"];
	echo "||";
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
