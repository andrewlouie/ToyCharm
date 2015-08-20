<?php include '../dbconn.php' ?>
<?php
$q = $_REQUEST["q"];
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
    foreach($dbh->query("SELECT * from toys WHERE item = '$q'") as $row) {
        echo $row["title"];
	echo "||";
	echo $row["date"];
	echo "||";
	echo $row["pics"];
	echo "||";
	echo $row["longdesc"];
	echo "||";
	echo $row["shortdesc"];
	echo "||";
	echo $row["price"];
	echo "||";
	echo $row["featured"];
	echo "||";
	echo $row["visible"];
	echo "||";
	echo $row["quantity"];
	echo "||";
	echo $row["cat_id"];
    }
    $dbh = null;
} catch (PDOException $e) {
    die();
}
?>

