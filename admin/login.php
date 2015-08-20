<?php 
	if(isset($_POST['login_button'])) {
		$pass = $_POST['password'];
		if( $pass == "bucevents" ) {
			setcookie("authorization","ok" );
			header( "Location:loggedin.php");
			exit();
		}
		else echo "Wrong password, try again";
	}
?>
<html>
<head> <title>Setting Cookie</title> </head>
<body>
<form method="post" 
	action="<?php echo $_SERVER['PHP_SELF']; ?>"  >
	Password: <input type="password" name="password"> <br /> <br />
	<input type="submit" name="login_button" value="Log In">
</form>
</body>
</html>