﻿<?php include 'dbconn.php' ?>
<?php
$loggedin = 0;
if (isset($_COOKIE['username']) && isset($_COOKIE['miscel'])) {
try {
	$sql = "SELECT password,user_id FROM users WHERE email = '" . $_COOKIE['username'] . "';";
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	foreach($dbh->query($sql) as $row) {
		if ($row['password'] == $_COOKIE['miscel']) {
		$q = $row['user_id'];
	    setcookie('username', $_COOKIE['username'], time()+60*60*24*30);
        setcookie('miscel', $_COOKIE['miscel'], time()+60*60*24*30);
		$cookuser = $_COOKIE['username'];
		$loggedin = 1;
	}
	 }
	$dbh = null;
	}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
} }
if ($loggedin != 1) {
		header ("Location:login.php");
		exit();
}
?>
<?php
	$zz = "";
if (isset($_POST['postedhere'])) {
	$error=0;
	if (!isset($_POST['firstname']) || $_POST['firstname'] == "") { $zz .= "First name is required<br>"; $error=1; }
	if (!isset($_POST['lastname']) || $_POST['lastname'] == "") { $zz .=  "Last name is required<br>"; $error=1; }
	if (!isset($_POST['address']) || $_POST['address'] == "") { $zz .=  "Street address is required<br>"; $error=1; }
	if (!isset($_POST['city']) || $_POST['city'] == "") { $zz .=  "City is required<br>"; $error=1; }
	if (!isset($_POST['prov']) || $_POST['prov'] == "") { $zz .=  "Province is required<br>"; $error=1; }
	if (!isset($_POST['prov']) || ($_POST['prov'] == "Other" && (!isset($_POST['other']) || $_POST['other'] == ""))) { $zz .= "Other is required if no province is selected<br>"; $error=1; }
	if (!isset($_POST['postal']) || $_POST['postal'] == "") { $zz .=  "Postal/Zip code is required<br>"; $error=1; }
	if (!isset($_POST['country']) || $_POST['country'] == "") { $zz .=  "Country is required<br>"; $error=1; }
	if (!isset($_POST['password']) || $_POST['password'] == "") { $zz .=  "Password is required<br>"; $error=1; }
	if (!isset($_POST['verifypw']) || $_POST['verifypw'] == "") { $zz .=  "Verify password is required<br>"; $error=1; }
	if (isset($_POST['password']) && isset($_POST['password']) && $_POST['password'] != "" && $_POST['verifypw'] != "" &&$_POST['password'] != $_POST['verifypw']) { $zz .=  "Password does not match<br>"; $error=1; }
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { $zz .=  "Email address is invalid"; $error=1; }
	if ($error==0) {
		try {
			$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
			$sql = "SELECT user_id FROM users WHERE email = '" . $_POST['email'] . "';";
			foreach($dbh->query($sql) as $row) {
				if ($row['user_id'] != $q) {
				$error=2;
				$zz .=  "Email is already registered<br>";
			} }
		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
if ($error==0) {
	try {
	
	$cookuser = $_POST['email'];
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$z = $dbh->quote($_POST['email']);
	$y = $dbh->quote(md5($_POST['password']));
	$x = $dbh->quote($_POST['firstname']);
	$w = $dbh->quote($_POST['lastname']);
	$v = $dbh->quote($_POST['address']);
	$u = $dbh->quote($_POST['city']);
	$t = $dbh->quote($_POST['prov']);
	$s = $dbh->quote($_POST['postal']);
	$r = $dbh->quote($_POST['country']);
	$p = $dbh->quote($_POST['other']);
    $sql = "UPDATE users SET email =  $z, password = $y, firstname = $x, lastname = $w, address = $v, city = $u, prov = $t, postal = $s, country = $r, other = $p WHERE user_id = " . $q . ";";
    $sth = $dbh->prepare($sql);	
    $sth->execute();
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
	    setcookie('username', $cookuser, time()+60*60*24*30);
        setcookie('miscel', md5($_POST['password']), time()+60*60*24*30);
} }
try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
	$sql="SELECT firstname,lastname,address,city,prov,postal,country,other FROM users WHERE email = '" . $cookuser . "';";
	foreach($dbh->query($sql) as $row) {
	$a = $row['firstname'];
	$b = $row['lastname'];
	$c = $row['address'];	
	$d = $row['city'];
	$e = $row['prov'];
	$f = $row['postal'];
	$g = $row['country'];
	$h = $row['other'];
	}
		$dbh = null;
}
catch (PDOException $e) {
	echo "Error!: " . $e->getMessage();
	die();
}
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
        <script>
	function test(country,province) {
	document.getElementById('country-selector').value = country;	
	document.getElementById('prov').value = province;
	provSel(province);	
	}
	function provSel(pro) {
		if (pro == "Other") {
			document.getElementById('other').disabled = false;
		}
		else {
			document.getElementById('other').disabled = true;
		}
	}
	function saveCart() {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		alert("Cart saved");
		} }
	xmlhttp.open("GET", "savecart.php?q=" + q, true);
	xmlhttp.send();
	}
	function loadCart() {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if (xmlhttp.responseText == 0) alert(xmlhttp.responseText);
			else { alert("Cart loaded"); document.getElementById('itemsincart').innerHTML = xmlhttp.responseText; }
		} }
	xmlhttp.open("GET", "loadcart.php?q=" + q, true);
	xmlhttp.send();
	}
	</script>
</head>

<body<?php if (isset($g)) echo ' onLoad="test(\'' . $g . '\', \'' . $e . '\')"' ?>>
<?php include 'headnav.php' ?>
<?php
echo "<script>q = '" . $q . "'; </script>";
?>
<br>
<div class="main-container">
<div class="container container-fluid">
<h2>Members Section - Update Your Information</h2>
<div class="row">
<div class="col-xs-1"></div>
<div class="col-xs-3">
<input type="button" value="Save Cart" class="aabtn" onclick="saveCart();">
</div><div class="col-xs-3"><input type="button" value="Load Cart" class="aabtn" onclick="loadCart();"></div><div class="col-xs-5"></div></div><br><br>
<?php echo $zz; ?>
     <form class="loginform" action="members.php" method="post">


<label>Email address: </label><input name="email" type="text" class="text" id="email" placeholder="Email address"<?php if (isset($cookuser)) echo " value='" . $cookuser . "'" ?>><br>
<label>Password: </label><input name="password" type="password" class="text" id="password"><br>
<label>Verify Password: </label><input name="verifypw" type="password" class="text" id="verifypw"><br>
<label>First Name: </label><input name="firstname" type="text" class="text" id="firstname"<?php if (isset($a)) echo " value='" . $a . "'" ?>><br>
<label>Last Name: </label><input name="lastname" type="text" class="text" id="lastname"<?php if (isset($b)) echo " value='" . $b . "'" ?>><br>
<label>Street Address: </label><input name="address" type="text" class="text" id="address"<?php if (isset($c)) echo " value='" . $c . "'" ?>><br>
<label>City: </label><input name="city" type="text" class="text" id="city"<?php if (isset($d)) echo " value='" . $d . "'" ?>><br>

<label>Province: </label><select name="prov" id="prov" onchange="provSel(this.value)">
<option value="Other">Other</option>
<option value="Alberta">Alberta</option>
<option value="British Columbia">British Columbia</option>
<option value="Manitoba">Manitoba</option>
<option value="New Brunswick">New Brunswick</option>
<option value="Newfoundland">Newfoundland</option>
<option value="Northwest Territories">Northwest Territories</option>
<option value="Nova Scotia">Nova Scotia</option>
<option value="Nunavut">Nunavut</option>
<option value="Ontario">Ontario</option>
<option value="PEI">PEI</option>
<option value="Quebec">Quebec</option>
<option value="Saskatchewan">Saskatchewan</option>
<option value="Yukon">Yukon</option></select>
<br>
<label>Other: </label><input name="other" type="text" class="text" id="other"<?php if (isset($h)) echo " value='" . $h . "'" ?>><br>

    <label>Postal/Zip Code: </label><input name="postal" type="text" class="text" id="postal"<?php if (isset($f)) echo " value='" . $f . "'" ?>><br>
    <label>Country: </label>
  <select name="country" id="country-selector">
      <option value="" selected="selected">Select Country</option>
      <option value="Afghanistan" data-alternative-spellings="AF افغانستان">Afghanistan</option>
      <option value="Åland Islands" data-alternative-spellings="AX Aaland Aland" data-relevancy-booster="0.5">Åland Islands</option>
      <option value="Albania" data-alternative-spellings="AL">Albania</option>
      <option value="Algeria" data-alternative-spellings="DZ الجزائر">Algeria</option>
      <option value="American Samoa" data-alternative-spellings="AS" data-relevancy-booster="0.5">American Samoa</option>
      <option value="Andorra" data-alternative-spellings="AD" data-relevancy-booster="0.5">Andorra</option>
      <option value="Angola" data-alternative-spellings="AO">Angola</option>
      <option value="Anguilla" data-alternative-spellings="AI" data-relevancy-booster="0.5">Anguilla</option>
      <option value="Antarctica" data-alternative-spellings="AQ" data-relevancy-booster="0.5">Antarctica</option>
      <option value="Antigua And Barbuda" data-alternative-spellings="AG" data-relevancy-booster="0.5">Antigua And Barbuda</option>
      <option value="Argentina" data-alternative-spellings="AR">Argentina</option>
      <option value="Armenia" data-alternative-spellings="AM Հայաստան">Armenia</option>
      <option value="Aruba" data-alternative-spellings="AW" data-relevancy-booster="0.5">Aruba</option>
      <option value="Australia" data-alternative-spellings="AU" data-relevancy-booster="1.5">Australia</option>
      <option value="Austria" data-alternative-spellings="AT Österreich Osterreich Oesterreich ">Austria</option>
      <option value="Azerbaijan" data-alternative-spellings="AZ">Azerbaijan</option>
      <option value="Bahamas" data-alternative-spellings="BS">Bahamas</option>
      <option value="Bahrain" data-alternative-spellings="BH البحرين">Bahrain</option>
      <option value="Bangladesh" data-alternative-spellings="BD বাংলাদেশ" data-relevancy-booster="2">Bangladesh</option>
      <option value="Barbados" data-alternative-spellings="BB">Barbados</option>
      <option value="Belarus" data-alternative-spellings="BY Беларусь">Belarus</option>
      <option value="Belgium" data-alternative-spellings="BE België Belgie Belgien Belgique" data-relevancy-booster="1.5">Belgium</option>
      <option value="Belize" data-alternative-spellings="BZ">Belize</option>
      <option value="Benin" data-alternative-spellings="BJ">Benin</option>
      <option value="Bermuda" data-alternative-spellings="BM" data-relevancy-booster="0.5">Bermuda</option>
      <option value="Bhutan" data-alternative-spellings="BT भूटान">Bhutan</option>
      <option value="Bolivia" data-alternative-spellings="BO">Bolivia</option>
      <option value="Bonaire, Sint Eustatius and Saba" data-alternative-spellings="BQ">Bonaire, Sint Eustatius and Saba</option>
      <option value="Bosnia and Herzegovina" data-alternative-spellings="BA BiH Bosna i Hercegovina Босна и Херцеговина">Bosnia and Herzegovina</option>
      <option value="Botswana" data-alternative-spellings="BW">Botswana</option>
      <option value="Bouvet Island" data-alternative-spellings="BV">Bouvet Island</option>
      <option value="Brazil" data-alternative-spellings="BR Brasil" data-relevancy-booster="2">Brazil</option>
      <option value="British Indian Ocean Territory" data-alternative-spellings="IO">British Indian Ocean Territory</option>
      <option value="Brunei Darussalam" data-alternative-spellings="BN">Brunei Darussalam</option>
      <option value="Bulgaria" data-alternative-spellings="BG България">Bulgaria</option>
      <option value="Burkina Faso" data-alternative-spellings="BF">Burkina Faso</option>
      <option value="Burundi" data-alternative-spellings="BI">Burundi</option>
      <option value="Cambodia" data-alternative-spellings="KH កម្ពុជា">Cambodia</option>
      <option value="Cameroon" data-alternative-spellings="CM">Cameroon</option>
      <option value="Canada" data-alternative-spellings="CA" data-relevancy-booster="2">Canada</option>
      <option value="Cape Verde" data-alternative-spellings="CV Cabo">Cape Verde</option>
      <option value="Cayman Islands" data-alternative-spellings="KY" data-relevancy-booster="0.5">Cayman Islands</option>
      <option value="Central African Republic" data-alternative-spellings="CF">Central African Republic</option>
      <option value="Chad" data-alternative-spellings="TD تشاد‎ Tchad">Chad</option>
      <option value="Chile" data-alternative-spellings="CL">Chile</option>
      <option value="China" data-relevancy-booster="3.5" data-alternative-spellings="CN Zhongguo Zhonghua Peoples Republic 中国/中华">China</option>
      <option value="Christmas Island" data-alternative-spellings="CX" data-relevancy-booster="0.5">Christmas Island</option>
      <option value="Cocos (Keeling) Islands" data-alternative-spellings="CC" data-relevancy-booster="0.5">Cocos (Keeling) Islands</option>
      <option value="Colombia" data-alternative-spellings="CO">Colombia</option>
      <option value="Comoros" data-alternative-spellings="KM جزر القمر">Comoros</option>
      <option value="Congo" data-alternative-spellings="CG">Congo</option>
      <option value="Congo, the Democratic Republic of the" data-alternative-spellings="CD Congo-Brazzaville Repubilika ya Kongo">Congo, the Democratic Republic of the</option>
      <option value="Cook Islands" data-alternative-spellings="CK" data-relevancy-booster="0.5">Cook Islands</option>
      <option value="Costa Rica" data-alternative-spellings="CR">Costa Rica</option>
      <option value="Côte d'Ivoire" data-alternative-spellings="CI Cote dIvoire">Côte d'Ivoire</option>
      <option value="Croatia" data-alternative-spellings="HR Hrvatska">Croatia</option>
      <option value="Cuba" data-alternative-spellings="CU">Cuba</option>
      <option value="Curaçao" data-alternative-spellings="CW Curacao">Curaçao</option>
      <option value="Cyprus" data-alternative-spellings="CY Κύπρος Kýpros Kıbrıs">Cyprus</option>
      <option value="Czech Republic" data-alternative-spellings="CZ Česká Ceska">Czech Republic</option>
      <option value="Denmark" data-alternative-spellings="DK Danmark" data-relevancy-booster="1.5">Denmark</option>
      <option value="Djibouti" data-alternative-spellings="DJ جيبوتي‎ Jabuuti Gabuuti">Djibouti</option>
      <option value="Dominica" data-alternative-spellings="DM Dominique" data-relevancy-booster="0.5">Dominica</option>
      <option value="Dominican Republic" data-alternative-spellings="DO">Dominican Republic</option>
      <option value="Ecuador" data-alternative-spellings="EC">Ecuador</option>
      <option value="Egypt" data-alternative-spellings="EG" data-relevancy-booster="1.5">Egypt</option>
      <option value="El Salvador" data-alternative-spellings="SV">El Salvador</option>
      <option value="Equatorial Guinea" data-alternative-spellings="GQ">Equatorial Guinea</option>
      <option value="Eritrea" data-alternative-spellings="ER إرتريا ኤርትራ">Eritrea</option>
      <option value="Estonia" data-alternative-spellings="EE Eesti">Estonia</option>
      <option value="Ethiopia" data-alternative-spellings="ET ኢትዮጵያ">Ethiopia</option>
      <option value="Falkland Islands (Malvinas)" data-alternative-spellings="FK" data-relevancy-booster="0.5">Falkland Islands (Malvinas)</option>
      <option value="Faroe Islands" data-alternative-spellings="FO Føroyar Færøerne" data-relevancy-booster="0.5">Faroe Islands</option>
      <option value="Fiji" data-alternative-spellings="FJ Viti फ़िजी">Fiji</option>
      <option value="Finland" data-alternative-spellings="FI Suomi">Finland</option>
      <option value="France" data-alternative-spellings="FR République française" data-relevancy-booster="2.5">France</option>
      <option value="French Guiana" data-alternative-spellings="GF">French Guiana</option>
      <option value="French Polynesia" data-alternative-spellings="PF Polynésie française">French Polynesia</option>
      <option value="French Southern Territories" data-alternative-spellings="TF">French Southern Territories</option>
      <option value="Gabon" data-alternative-spellings="GA République Gabonaise">Gabon</option>
      <option value="Gambia" data-alternative-spellings="GM">Gambia</option>
      <option value="Georgia" data-alternative-spellings="GE საქართველო">Georgia</option>
      <option value="Germany" data-alternative-spellings="DE Bundesrepublik Deutschland" data-relevancy-booster="3">Germany</option>
      <option value="Ghana" data-alternative-spellings="GH">Ghana</option>
      <option value="Gibraltar" data-alternative-spellings="GI" data-relevancy-booster="0.5">Gibraltar</option>
      <option value="Greece" data-alternative-spellings="GR Ελλάδα" data-relevancy-booster="1.5">Greece</option>
      <option value="Greenland" data-alternative-spellings="GL grønland" data-relevancy-booster="0.5">Greenland</option>
      <option value="Grenada" data-alternative-spellings="GD">Grenada</option>
      <option value="Guadeloupe" data-alternative-spellings="GP">Guadeloupe</option>
      <option value="Guam" data-alternative-spellings="GU">Guam</option>
      <option value="Guatemala" data-alternative-spellings="GT">Guatemala</option>
      <option value="Guernsey" data-alternative-spellings="GG" data-relevancy-booster="0.5">Guernsey</option>
      <option value="Guinea" data-alternative-spellings="GN">Guinea</option>
      <option value="Guinea-Bissau" data-alternative-spellings="GW">Guinea-Bissau</option>
      <option value="Guyana" data-alternative-spellings="GY">Guyana</option>
      <option value="Haiti" data-alternative-spellings="HT">Haiti</option>
      <option value="Heard Island and McDonald Islands" data-alternative-spellings="HM">Heard Island and McDonald Islands</option>
      <option value="Holy See (Vatican City State)" data-alternative-spellings="VA" data-relevancy-booster="0.5">Holy See (Vatican City State)</option>
      <option value="Honduras" data-alternative-spellings="HN">Honduras</option>
      <option value="Hong Kong" data-alternative-spellings="HK 香港">Hong Kong</option>
      <option value="Hungary" data-alternative-spellings="HU Magyarország">Hungary</option>
      <option value="Iceland" data-alternative-spellings="IS Island">Iceland</option>
      <option value="India" data-alternative-spellings="IN भारत गणराज्य Hindustan" data-relevancy-booster="3">India</option>
      <option value="Indonesia" data-alternative-spellings="ID" data-relevancy-booster="2">Indonesia</option>
      <option value="Iran, Islamic Republic of" data-alternative-spellings="IR ایران">Iran, Islamic Republic of</option>
      <option value="Iraq" data-alternative-spellings="IQ العراق‎">Iraq</option>
      <option value="Ireland" data-alternative-spellings="IE Éire" data-relevancy-booster="1.2">Ireland</option>
      <option value="Isle of Man" data-alternative-spellings="IM" data-relevancy-booster="0.5">Isle of Man</option>
      <option value="Israel" data-alternative-spellings="IL إسرائيل ישראל">Israel</option>
      <option value="Italy" data-alternative-spellings="IT Italia" data-relevancy-booster="2">Italy</option>
      <option value="Jamaica" data-alternative-spellings="JM">Jamaica</option>
      <option value="Japan" data-alternative-spellings="JP Nippon Nihon 日本" data-relevancy-booster="2.5">Japan</option>
      <option value="Jersey" data-alternative-spellings="JE" data-relevancy-booster="0.5">Jersey</option>
      <option value="Jordan" data-alternative-spellings="JO الأردن">Jordan</option>
      <option value="Kazakhstan" data-alternative-spellings="KZ Қазақстан Казахстан">Kazakhstan</option>
      <option value="Kenya" data-alternative-spellings="KE">Kenya</option>
      <option value="Kiribati" data-alternative-spellings="KI">Kiribati</option>
      <option value="Korea, Democratic People's Republic of" data-alternative-spellings="KP North Korea">Korea, Democratic People's Republic of</option>
      <option value="Korea, Republic of" data-alternative-spellings="KR South Korea" data-relevancy-booster="1.5">Korea, Republic of</option>
      <option value="Kuwait" data-alternative-spellings="KW الكويت">Kuwait</option>
      <option value="Kyrgyzstan" data-alternative-spellings="KG Кыргызстан">Kyrgyzstan</option>
      <option value="Lao People's Democratic Republic" data-alternative-spellings="LA">Lao People's Democratic Republic</option>
      <option value="Latvia" data-alternative-spellings="LV Latvija">Latvia</option>
      <option value="Lebanon" data-alternative-spellings="LB لبنان">Lebanon</option>
      <option value="Lesotho" data-alternative-spellings="LS">Lesotho</option>
      <option value="Liberia" data-alternative-spellings="LR">Liberia</option>
      <option value="Libyan Arab Jamahiriya" data-alternative-spellings="LY ليبيا">Libyan Arab Jamahiriya</option>
      <option value="Liechtenstein" data-alternative-spellings="LI">Liechtenstein</option>
      <option value="Lithuania" data-alternative-spellings="LT Lietuva">Lithuania</option>
      <option value="Luxembourg" data-alternative-spellings="LU">Luxembourg</option>
      <option value="Macao" data-alternative-spellings="MO">Macao</option>
      <option value="Macedonia, The Former Yugoslav Republic Of" data-alternative-spellings="MK Македонија">Macedonia, The Former Yugoslav Republic Of</option>
      <option value="Madagascar" data-alternative-spellings="MG Madagasikara">Madagascar</option>
      <option value="Malawi" data-alternative-spellings="MW">Malawi</option>
      <option value="Malaysia" data-alternative-spellings="MY">Malaysia</option>
      <option value="Maldives" data-alternative-spellings="MV">Maldives</option>
      <option value="Mali" data-alternative-spellings="ML">Mali</option>
      <option value="Malta" data-alternative-spellings="MT">Malta</option>
      <option value="Marshall Islands" data-alternative-spellings="MH" data-relevancy-booster="0.5">Marshall Islands</option>
      <option value="Martinique" data-alternative-spellings="MQ">Martinique</option>
      <option value="Mauritania" data-alternative-spellings="MR الموريتانية">Mauritania</option>
      <option value="Mauritius" data-alternative-spellings="MU">Mauritius</option>
      <option value="Mayotte" data-alternative-spellings="YT">Mayotte</option>
      <option value="Mexico" data-alternative-spellings="MX Mexicanos" data-relevancy-booster="1.5">Mexico</option>
      <option value="Micronesia, Federated States of" data-alternative-spellings="FM">Micronesia, Federated States of</option>
      <option value="Moldova, Republic of" data-alternative-spellings="MD">Moldova, Republic of</option>
      <option value="Monaco" data-alternative-spellings="MC">Monaco</option>
      <option value="Mongolia" data-alternative-spellings="MN Mongγol ulus Монгол улс">Mongolia</option>
      <option value="Montenegro" data-alternative-spellings="ME">Montenegro</option>
      <option value="Montserrat" data-alternative-spellings="MS" data-relevancy-booster="0.5">Montserrat</option>
      <option value="Morocco" data-alternative-spellings="MA المغرب">Morocco</option>
      <option value="Mozambique" data-alternative-spellings="MZ Moçambique">Mozambique</option>
      <option value="Myanmar" data-alternative-spellings="MM">Myanmar</option>
      <option value="Namibia" data-alternative-spellings="NA Namibië">Namibia</option>
      <option value="Nauru" data-alternative-spellings="NR Naoero" data-relevancy-booster="0.5">Nauru</option>
      <option value="Nepal" data-alternative-spellings="NP नेपाल">Nepal</option>
      <option value="Netherlands" data-alternative-spellings="NL Holland Nederland" data-relevancy-booster="1.5">Netherlands</option>
      <option value="New Caledonia" data-alternative-spellings="NC" data-relevancy-booster="0.5">New Caledonia</option>
      <option value="New Zealand" data-alternative-spellings="NZ Aotearoa">New Zealand</option>
      <option value="Nicaragua" data-alternative-spellings="NI">Nicaragua</option>
      <option value="Niger" data-alternative-spellings="NE Nijar">Niger</option>
      <option value="Nigeria" data-alternative-spellings="NG Nijeriya Naíjíríà" data-relevancy-booster="1.5">Nigeria</option>
      <option value="Niue" data-alternative-spellings="NU" data-relevancy-booster="0.5">Niue</option>
      <option value="Norfolk Island" data-alternative-spellings="NF" data-relevancy-booster="0.5">Norfolk Island</option>
      <option value="Northern Mariana Islands" data-alternative-spellings="MP" data-relevancy-booster="0.5">Northern Mariana Islands</option>
      <option value="Norway" data-alternative-spellings="NO Norge Noreg" data-relevancy-booster="1.5">Norway</option>
      <option value="Oman" data-alternative-spellings="OM عمان">Oman</option>
      <option value="Pakistan" data-alternative-spellings="PK پاکستان" data-relevancy-booster="2">Pakistan</option>
      <option value="Palau" data-alternative-spellings="PW" data-relevancy-booster="0.5">Palau</option>
      <option value="Palestinian Territory, Occupied" data-alternative-spellings="PS فلسطين">Palestinian Territory, Occupied</option>
      <option value="Panama" data-alternative-spellings="PA">Panama</option>
      <option value="Papua New Guinea" data-alternative-spellings="PG">Papua New Guinea</option>
      <option value="Paraguay" data-alternative-spellings="PY">Paraguay</option>
      <option value="Peru" data-alternative-spellings="PE">Peru</option>
      <option value="Philippines" data-alternative-spellings="PH Pilipinas" data-relevancy-booster="1.5">Philippines</option>
      <option value="Pitcairn" data-alternative-spellings="PN" data-relevancy-booster="0.5">Pitcairn</option>
      <option value="Poland" data-alternative-spellings="PL Polska" data-relevancy-booster="1.25">Poland</option>
      <option value="Portugal" data-alternative-spellings="PT Portuguesa" data-relevancy-booster="1.5">Portugal</option>
      <option value="Puerto Rico" data-alternative-spellings="PR">Puerto Rico</option>
      <option value="Qatar" data-alternative-spellings="QA قطر">Qatar</option>
      <option value="Réunion" data-alternative-spellings="RE Reunion">Réunion</option>
      <option value="Romania" data-alternative-spellings="RO Rumania Roumania România">Romania</option>
      <option value="Russian Federation" data-alternative-spellings="RU Rossiya Российская Россия" data-relevancy-booster="2.5">Russian Federation</option>
      <option value="Rwanda" data-alternative-spellings="RW">Rwanda</option>
      <option value="Saint Barthélemy" data-alternative-spellings="BL St. Barthelemy">Saint Barthélemy</option>
      <option value="Saint Helena" data-alternative-spellings="SH St.">Saint Helena</option>
      <option value="Saint Kitts and Nevis" data-alternative-spellings="KN St.">Saint Kitts and Nevis</option>
      <option value="Saint Lucia" data-alternative-spellings="LC St.">Saint Lucia</option>
      <option value="Saint Martin (French Part)" data-alternative-spellings="MF St.">Saint Martin (French Part)</option>
      <option value="Saint Pierre and Miquelon" data-alternative-spellings="PM St.">Saint Pierre and Miquelon</option>
      <option value="Saint Vincent and the Grenadines" data-alternative-spellings="VC St.">Saint Vincent and the Grenadines</option>
      <option value="Samoa" data-alternative-spellings="WS">Samoa</option>
      <option value="San Marino" data-alternative-spellings="SM RSM Repubblica">San Marino</option>
      <option value="Sao Tome and Principe" data-alternative-spellings="ST">Sao Tome and Principe</option>
      <option value="Saudi Arabia" data-alternative-spellings="SA السعودية">Saudi Arabia</option>
      <option value="Senegal" data-alternative-spellings="SN Sénégal">Senegal</option>
      <option value="Serbia" data-alternative-spellings="RS Србија Srbija">Serbia</option>
      <option value="Seychelles" data-alternative-spellings="SC" data-relevancy-booster="0.5">Seychelles</option>
      <option value="Sierra Leone" data-alternative-spellings="SL">Sierra Leone</option>
      <option value="Singapore" data-alternative-spellings="SG Singapura  சிங்கப்பூர் குடியரசு 新加坡共和国">Singapore</option>
      <option value="Sint Maarten (Dutch Part)" data-alternative-spellings="SX">Sint Maarten (Dutch Part)</option>
      <option value="Slovakia" data-alternative-spellings="SK Slovenská Slovensko">Slovakia</option>
      <option value="Slovenia" data-alternative-spellings="SI Slovenija">Slovenia</option>
      <option value="Solomon Islands" data-alternative-spellings="SB">Solomon Islands</option>
      <option value="Somalia" data-alternative-spellings="SO الصومال">Somalia</option>
      <option value="South Africa" data-alternative-spellings="ZA RSA Suid-Afrika">South Africa</option>
      <option value="South Georgia and the South Sandwich Islands" data-alternative-spellings="GS">South Georgia and the South Sandwich Islands</option>
      <option value="South Sudan" data-alternative-spellings="SS">South Sudan</option>
      <option value="Spain" data-alternative-spellings="ES España" data-relevancy-booster="2">Spain</option>
      <option value="Sri Lanka" data-alternative-spellings="LK ශ්‍රී ලංකා இலங்கை Ceylon">Sri Lanka</option>
      <option value="Sudan" data-alternative-spellings="SD السودان">Sudan</option>
      <option value="Suriname" data-alternative-spellings="SR शर्नम् Sarnam Sranangron">Suriname</option>
      <option value="Svalbard and Jan Mayen" data-alternative-spellings="SJ" data-relevancy-booster="0.5">Svalbard and Jan Mayen</option>
      <option value="Swaziland" data-alternative-spellings="SZ weSwatini Swatini Ngwane">Swaziland</option>
      <option value="Sweden" data-alternative-spellings="SE Sverige" data-relevancy-booster="1.5">Sweden</option>
      <option value="Switzerland" data-alternative-spellings="CH Swiss Confederation Schweiz Suisse Svizzera Svizra" data-relevancy-booster="1.5">Switzerland</option>
      <option value="Syrian Arab Republic" data-alternative-spellings="SY Syria سورية">Syrian Arab Republic</option>
      <option value="Taiwan, Province of China" data-alternative-spellings="TW 台灣 臺灣">Taiwan, Province of China</option>
      <option value="Tajikistan" data-alternative-spellings="TJ Тоҷикистон Toçikiston">Tajikistan</option>
      <option value="Tanzania, United Republic of" data-alternative-spellings="TZ">Tanzania, United Republic of</option>
      <option value="Thailand" data-alternative-spellings="TH ประเทศไทย Prathet Thai">Thailand</option>
      <option value="Timor-Leste" data-alternative-spellings="TL">Timor-Leste</option>
      <option value="Togo" data-alternative-spellings="TG Togolese">Togo</option>
      <option value="Tokelau" data-alternative-spellings="TK" data-relevancy-booster="0.5">Tokelau</option>
      <option value="Tonga" data-alternative-spellings="TO">Tonga</option>
      <option value="Trinidad and Tobago" data-alternative-spellings="TT">Trinidad and Tobago</option>
      <option value="Tunisia" data-alternative-spellings="TN تونس">Tunisia</option>
      <option value="Turkey" data-alternative-spellings="TR Türkiye Turkiye">Turkey</option>
      <option value="Turkmenistan" data-alternative-spellings="TM Türkmenistan">Turkmenistan</option>
      <option value="Turks and Caicos Islands" data-alternative-spellings="TC" data-relevancy-booster="0.5">Turks and Caicos Islands</option>
      <option value="Tuvalu" data-alternative-spellings="TV" data-relevancy-booster="0.5">Tuvalu</option>
      <option value="Uganda" data-alternative-spellings="UG">Uganda</option>
      <option value="Ukraine" data-alternative-spellings="UA Ukrayina Україна">Ukraine</option>
      <option value="United Arab Emirates" data-alternative-spellings="AE UAE الإمارات">United Arab Emirates</option>
      <option value="United Kingdom" data-alternative-spellings="GB Great Britain England UK Wales Scotland Northern Ireland" data-relevancy-booster="2.5">United Kingdom</option>
      <option value="United States" data-relevancy-booster="3.5" data-alternative-spellings="US USA United States of America">United States</option>
      <option value="United States Minor Outlying Islands" data-alternative-spellings="UM">United States Minor Outlying Islands</option>
      <option value="Uruguay" data-alternative-spellings="UY">Uruguay</option>
      <option value="Uzbekistan" data-alternative-spellings="UZ Ўзбекистон O'zbekstan O‘zbekiston">Uzbekistan</option>
      <option value="Vanuatu" data-alternative-spellings="VU">Vanuatu</option>
      <option value="Venezuela" data-alternative-spellings="VE">Venezuela</option>
      <option value="Vietnam" data-alternative-spellings="VN Việt Nam" data-relevancy-booster="1.5">Vietnam</option>
      <option value="Virgin Islands, British" data-alternative-spellings="VG" data-relevancy-booster="0.5">Virgin Islands, British</option>
      <option value="Virgin Islands, U.S." data-alternative-spellings="VI" data-relevancy-booster="0.5">Virgin Islands, U.S.</option>
      <option value="Wallis and Futuna" data-alternative-spellings="WF" data-relevancy-booster="0.5">Wallis and Futuna</option>
      <option value="Western Sahara" data-alternative-spellings="EH لصحراء الغربية">Western Sahara</option>
      <option value="Yemen" data-alternative-spellings="YE اليمن">Yemen</option>
      <option value="Zambia" data-alternative-spellings="ZM">Zambia</option>
      <option value="Zimbabwe" data-alternative-spellings="ZW">Zimbabwe</option>
    </select>
<br><br>
<label></label><input type="hidden" name="postedhere" value="yes"><input type="submit" class="aabtn" value="Update">
</form>

</div></div>
<?php include 'footer.php' ?>
</body>
</html>