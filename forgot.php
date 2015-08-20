<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<title>Toy Charm</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/stylesheet2.css" rel="stylesheet" type="text/css">

	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link href="favicon.ico" rel="icon" type="image/x-icon">

	<script src="js/jquery-1.11.2.min.js"></script> <script src="js/bootstrap.js"></script>    
</head>

<body>
<?php include 'headnav.php' ?>
<br>
<div class="main-container">
<div class="container container-fluid">
<h2>Forgot Your Password?</h2><h3>
<form class="loginform" action="forgot.php" method="post">
<?php
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
if (isset($_POST['email'])) {
try {
	$randpass = randomPassword();
	$sql = "UPDATE users SET password = '" . md5($randpass) . "' WHERE email = '" . $_POST['email'] . "';";
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	if ($stmt->rowCount()){
    	mail($_POST['email'], 'Toy Charm Password', 'Your new temporary password for Toy Charm is "' . $randpass . '" (without quotes).  This was request at ' . date("h:i:sa") . ' on ' . date("Y-m-d") . ' by IP# ' . $_SERVER['REMOTE_ADDR']);
    	echo 'Your new temporary password has been sent to your email.<br>';
	} 
	else {
		echo 'Your email address was not found<br>';
		echo "<label>Email address: </label><input name='email' type='text' class='text' id='email' placeholder='Email address'><br>";
	}
	$dbh = null;
	}
	catch (PDOException $e) {
		echo "Error!: " . $e->getMessage();
		die();
}
}
else echo "<label>Email address: </label><input name='email' type='text' class='text' id='email' placeholder='Email address'><br>";
echo "<br><br><label></label><input type='submit' class='aabtn' value='Send me a new password'></form>";
?>

</div></div>
<?php include 'footer.php' ?>
</body>
</html>