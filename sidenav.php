			<ul class="nav nav-pills nav-stacked">
           <li>Catagories</li>
<?php include 'dbconn.php' ?>
<?php 
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$rowcount = 0;
	$lastcat = "null";
	$sql="SELECT * FROM catagory;";
	foreach($dbh->query($sql) as $row) {
		echo "<li role='presentation'><a href='products.php?cat=";
		echo $row['cat_id'];
		echo "'>";
		echo $row['catagory'];
		echo "</a></li>";
	}
	$dbh = null;
}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
}
?>
            </ul>
