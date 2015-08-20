<?php 
if (!isset($_GET['id'])) { 
echo "Error, no item selected";
		exit();
exit();
}
?>
<?php include 'dbconn.php' ?>
<?php 
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$sql="SELECT t.title,t.shortdesc,t.price,t.pics,t.longdesc,t.quantity,t.visible,t.cat_id,t.saleprice,catagory FROM toys t LEFT JOIN catagory ON t.cat_id = catagory.cat_id WHERE item = " . $_GET['id'];
	foreach($dbh->query($sql) as $row) {
		if ($row['visible'] == 0) { echo "Sorry, this item is no longer available."; exit(); }
		$pics = explode(",",$row['pics']);
		echo "<a href='index.php'>Home</a> > <a href='products.php?cat=";
		echo $row['cat_id'];
		echo "'>";
		echo $row['catagory'];
		echo "</a>";
		echo "<br><h2>";
		echo $row['title'];
		echo "</h2><div class='aahr'></div><br><div class='row'><div class='col-xs-4 imagebox'><a href='images/";
		echo $pics[0];
		echo "' class='thumbnail fancybox' id='mainlink' rel='gallery'><img src='images/";
		echo $pics[0];
		echo "' id='mainimg'/></a></div><div class='col-xs-8'>";
		echo $row['shortdesc'];
		echo "<hr><span class='price'>";
		if (!is_null($row['saleprice'])) {
		echo "<s>";
		echo "$";
		echo $row['price'];
		echo "</s> $";
		echo $row['saleprice'];
		}
		else {
		echo "$";
		echo $row['price'];	
		}
		echo "</span>";
		echo "<br><br>";

echo "<label>Quantity: </label><input type='number' name='quantity' id='quantity' value='1'><br><br>";
echo "<input type='button' value='Add to Cart' onclick='addtocart()'>";

		echo "<br><br><span class='qtyinstock'>Quantity in stock: <strong>";
		echo $row['quantity'];
		echo "</strong></span></div></div><div class='row'><ul id='first-carousel' class='carousel jcarousel-skin-tango'>";
		for ($i = 0;$i < sizeof($pics);$i++) {
			echo "<li><a href='images/";
			echo $pics[$i];
			echo "' class='tnsmall'";
			if ($i != 0) echo " rel='gallery'";
			echo "><img src='images/";
			echo $pics[$i];
			echo "'/></a></li>";
		}
		echo "</ul></div><div class='row'><div class='col-xs-6 col-sm-3' style='text-align:center;'><!--google+--><script src='https://apis.google.com/js/platform.js' async defer></script><g:plus action='share'></g:plus></div><div class='col-xs-6 col-sm-3' style='text-align:center;'><!--twitter--><a href='https://twitter.com/share' class='twitter-share-button'>Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div><div class='col-xs-6 col-sm-3' style='text-align:center;'><!--facebook--><div class='fb-like' data-layout='button_count' data-action='like' data-show-faces='true' data-share='true'></div></div><div class='col-xs-6 col-sm-3' style='text-align:center;'><!--pintrest--><a href='//www.pinterest.com/pin/create/button/' data-pin-do='buttonBookmark'  data-pin-color='red'><img src='//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png' /></a><script type='text/javascript' async defer src='//assets.pinterest.com/js/pinit.js'></script></div></div><br><div class='aahr'></div><br>";
		echo $row['longdesc'];
		echo "<br><br><br>";
		echo "<script>document.title = '" . "Toy Store - " . $row['title'] . "'</script>";
	}
	$dbh = null;
}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
}
?>
