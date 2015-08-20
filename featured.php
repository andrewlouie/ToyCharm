<div class="container-fluid">
<div class="row">
<?php include 'dbconn.php' ?>
<?php 
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$rowcount = 0;
	$lastcat = "null";
	$sql="SELECT item,title,IF(INSTR(pics,',')=0,pics,left(pics,INSTR(pics,',')-1)) AS pics,price FROM toys WHERE featured = 1 AND visible = 1 ORDER BY RAND() LIMIT 4;";
	foreach($dbh->query($sql) as $row) {
		echo "<div class='col-xs-6 col-sm-3'><div class='aaback aa";
		switch ($rowcount) {
		case 0: echo "red"; break;
		case 1: echo "orange"; break;
		case 2: echo "purple"; break;
		case 3: echo "blue";
		}
		$rowcount++;
		echo "'><div class='aaitem wrapper'>";
		echo "<a href='item.php?id=";
		echo $row['item'];
		echo "'><img src='images/";
		echo $row['pics'];
		echo "' alt='";
		echo $row['title'];
		echo "'/></a><div class='ribbon-wrapper-green'><div class='ribbon-green'>$";
		echo $row['price'];
		echo "</div></div></div><span class='aafeattitle'><a href='item.php?id=";
		echo $row['item'];
		echo "'>";
		echo $row['title'];
		echo "</a></span></div></div>";
	}
	$dbh = null;
}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
}
?>
</div>
