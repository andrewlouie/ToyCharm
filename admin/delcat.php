<?php include '../dbconn.php' ?>
<?php
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
    $sql = "DELETE FROM catagory WHERE cat_id = " . $_GET['q'] . ";";
echo $sql;
    $sth = $dbh->prepare($sql);	
    $sth->execute();
    echo $dbh->lastInsertId();
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
