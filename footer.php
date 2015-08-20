<div class="aafooter">
<div class="row"><div class="col-sm-4"><h4>CATEGORIES</h4>
<?php 
	foreach($_SESSION['cats'] as $row) {		
	echo "<a href='products.php?cat=";
	echo $row['cat_id'];
	echo "'>";
	echo $row['catagory'];
	echo "</a><br>";
	}
?>
<br>
<a href="products.php?bestsellers=y">Best Sellers</a>
<br>
<a href="products.php?sort=4">New</a>
<br>
<a href="products.php?featured=y">Featured</a>
<br>
<a href="products.php?sale=y">Sale</a>
</div><div class="col-sm-4">

<h4>CUSTOMER SERVICE</h4>
<a href="cart.php">Shopping Cart</a>
<br>
<a href="newacct.php">Create Account</a>
<br>
<a href="login.php">Login</a>
<br>
<a href="forgot.php">Forgot Your Password</a>
<br><br>
<a href="faq.php">FAQ</a>
<br>
<a href="terms.php">Terms and Conditions</a>
<br>
<a href="shipping.php">Shipping & Delivery</a>
<br>
<a href="returns.php">Returns & Exhanges</a>
<br>
<a href="privacy.php">Privacy Policy</a>
</div>       
<div class="col-sm-4">
<h4>GET SOCIAL WITH US!</h4>
<a href="https://www.facebook.com/ToyCharms"><img src="include/facebook.png" width="102" height="35" alt=""/></a><br>
<a href="http://www.twitter.com/ToyCharms"><img src="include/twitter.png" width="102" height="35" alt=""/></a><br>
</div></div>
        <img src="include/icon_65x35_PayPal.png" width="65" height="35" alt="PayPal"/>
        <img src="include/icon_65x35_visa.png" width="65" height="35" alt="Visa"/>
        <img src="include/icon_65x35_mastercard.png" width="65" height="35" alt="MasterCard"/>
		<span class="pull-right">&copy; <script>
document.write(new Date().getFullYear());
			</script> Toy Charm. Website by Andrew Aaron
</span>
</div>