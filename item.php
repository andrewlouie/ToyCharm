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
    <script type="text/javascript" src="./fancybox/lib/jquery-latest.min.js"></script>
<!--jCarousel-->
<script src="./jCarousel/jquery-migrate-1.1.0.js"></script>
<script type="text/javascript" src="./jCarousel/jquery.jcarousel.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./jCarousel/skin.css"/>
<link rel="stylesheet" type="text/css" href="./jCarousel/jquery.jcarousel.css"/>
<!--/jCarousel-->
<!--FancyBox-->  
<link rel="stylesheet" href="./fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="./fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<!--/FancyBox-->
<script type="text/javascript">
	$(document).ready(function() {
		$(".tnsmall").click(function(){
			$(".tnsmall").attr('rel','gallery');
			$(this).attr('rel','');
			$('#mainimg').attr('src', this.href);
			$('#mainlink').attr('href',this.href);
			event.stopPropagation();
			event.preventDefault();
		})
		$(".fancybox").fancybox();
  		$('.carousel').jcarousel();
		$("a[rel=gallery]").fancybox();
	});
</script>
 
	<script>
function changeSort(value) {
	var nameString = location.pathname;
	var nameArray = nameString.split('/');
	var newloc = nameArray[nameArray.length - 1] + "?sort=" + value
	window.location = newloc;
	}
	function getURLParameter(name) {
	return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
	}
function addtocart(itemno) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('itemsincart').innerHTML = xmlhttp.responseText;
			 $(document).ready(function(){
				$("html, body").animate({ scrollTop: 0 }, "fast", function() {
				$(".arrow-up").fadeIn(1500);
				$(".itemadded").fadeIn(1500, function() {
				$(".itemadded").fadeOut(1500);
				$(".arrow-up").fadeOut(1500);				
				}) 
				})
				});
		}
	}
	xmlhttp.open("GET", "additem.php?qty=" + document.getElementById("quantity").value + "&item=" + getURLParameter('id'), true);
	xmlhttp.send();
}
	</script>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php include 'headnav.php' ?>
<br>
<div class="main-container">
<div class="container container-fluid">
<?php include 'itemdesc.php' ?>

 </div></div>
<?php include 'footer.php' ?>
</body>
</html>