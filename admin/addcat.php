<?php include '../dbconn.php' ?>
<?php
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
    $sql = "INSERT INTO catagory (cat_id,catagory) VALUES (NULL, '" . $_GET['q'] . "');";
    $sth = $dbh->prepare($sql);	
    $sth->execute();
    echo $dbh->lastInsertId();
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
