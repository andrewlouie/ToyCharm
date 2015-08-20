<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<title>Toy Charm</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/stylesheet2.css" rel="stylesheet" type="text/css">
	<link href="jCarousel/ma.onsaleslider.css" rel="stylesheet" type="text/css">    

	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link href="favicon.ico" rel="icon" type="image/x-icon">
	<script src="js/jquery-1.11.2.min.js"></script> <script src="js/bootstrap.js"></script>    
	<script>
function changeSort(value) {
var nameString = location.pathname;
var nameArray = nameString.split('/');
var string = "";
if (getURLParameter('cat') != null) string = string + "&cat=" + getURLParameter('cat');
if (getURLParameter('featured') != null) string = string + "&featured=" + getURLParameter('featured');
if (getURLParameter('searchbox') != null) string = string + "&searchbox=" + getURLParameter('searchbox');
if (getURLParameter('searchbox') != null) string = string + "&bestsellers=" + getURLParameter('bestsellers');
if (getURLParameter('searchbox') != null) string = string + "&sale=" + getURLParameter('sale');
var newloc = nameArray[nameArray.length - 1] + "?sort=" + value + string;
window.location = newloc;
}
function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}
	</script>
</head>

<body>
<?php include 'headnav.php' ?>
<br>
<div class="main-container">
<div class="container container-fluid">
<?php 
if (isset($_GET['featured'])) echo "<h2>Featured</h2>";
else if (isset($_GET['searchbox'])) echo "<h2>Search Results</h2>";
else if (isset($_GET['bestsellers'])) echo "<h2>Best Sellers</h2>";
else if (isset($_GET['sale'])) echo "<h2>On Sale</h2>";
else if (isset($_GET['cat'])) echo "<h2><a href='index.php'>Home</a> > " . $_SESSION['cats'][$_GET['cat'] -1][1] . "</h2>";
else echo "<h2>All Products</h2>";
?>

<?php include 'sortbox.php' ?>
<div class="row">

<?php include 'inditems.php' ?>

</div>
<?php include 'pageturn.php' ?>
 </div></div>
<?php include 'footer.php' ?>
</body>
</html>