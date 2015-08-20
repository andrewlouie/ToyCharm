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
<h2>Contact Us</h2>
<?php
if (isset($_POST['sent'])) {
foreach ($_POST as $key => $value) $message .= "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
mail('toycharm@gmail.com', 'Toy Charm Contact Form', $message);	
}
else echo "<form id='aacontact' action='contact.php' method='post'><label for='name'>Name:</label><input type='text' name='name' id='name' class='aacform'><br><label for='name'>Email:</label><input type='email' name='email' id='email' class='aacform'><br><label for='comments'>Message:</label><textarea name='comments' id='comments'></textarea><br><input type='hidden' name='sent' value='true'><label></label><input type='submit' id='sendbtn' name='sendbtn' value='Send'></form>";
?>
</div></div>
<?php include 'footer.php' ?>
</body>
</html>