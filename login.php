<?php include 'dbconn.php' ?>
<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
try {
	$sql = "SELECT password FROM users WHERE email = '" . $_POST['email'] . "';";
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	foreach($dbh->query($sql) as $row) {
		if ($row['password'] == md5($_POST['password'])) {
	    setcookie('username', $_POST['email'], time()+60*60*24*30);
        setcookie('miscel', md5($_POST['password']), time()+60*60*24*30);
		header ("Location:members.php");
		exit();
	} }
	$dbh = null;
	}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
} }
?>
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
<h2>Login</h2><h3>
<form class="loginform" method="post" action="login.php">
<label>Email address: </label>
<?php
echo "<input name='email' type='text' class='text' id='email' placeholder='Email address'";
if (isset($_POST['email'])) echo " value='" . $_POST['email'] . "'";
echo ">";
?>
<br>
<label>Password: </label><input name="password" type="password" class="text" id="password"><br><br>
<?php 
if (isset($_POST['email'])) echo "<label></label><span style='color:red;font-style:italic;font-weight:bold;'>Invalid login/password</span><br><br>";
?>
<label></label><a href="forgot.php">Forgot your password?</a><br><br>

<label></label><input name="submit" type="submit" class="aabtn" id="submit" value="Login"><br><br>
<label></label><a href="newacct.php">New user?</a><br>
</form>
</div></div>
<?php include 'footer.php' ?>
</body>
</html>