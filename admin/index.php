<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Toy Charm Items</title>
	<script src="ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/sample.css">
<script>
var responseArray = new Array();
var timeoutID;
var curtitle = "";
var curimage = document.getElementById("toDate").value;
var curdate = "";
var curqty = 1;
var curcat = "";
var curprice = "";
var curshortdesc = "";
var curvisible = true;
var curfeatured = false;
var newitemno = 0;
var redoitem = 0;
var redo = false;
var selectedvalue = 0;
var changing = false;
function addcat() {
var newcat = prompt("Catagory name");
if (newcat != "")
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var selectBox = document.getElementById("catid");
			selectBox.innerHTML = "";
			var opt = document.createElement('option');
			opt.text = "";
			selectBox.options.add(opt);
			opt.selected = true;
			loadcat();
		}
	}
	xmlhttp.open("GET", "addcat.php?q=" + newcat, true);
	xmlhttp.send();
}
function delcat() {
if (document.getElementById("catid").value != "")
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var selectBox = document.getElementById("catid");
			selectBox.innerHTML = "";
			var opt = document.createElement('option');
			opt.text = "";
			selectBox.options.add(opt);
			opt.selected = true;
			loadcat();
		}
	}
	xmlhttp.open("GET", "delcat.php?q=" + document.getElementById("catid").value, true);
	xmlhttp.send();
}
function adelete() {
	if (confirm("Are you sure?")) {
	CKEDITOR.instances.editor1.resetDirty()
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		loadOptions();
		changeItem(0);
		document.getElementById("message").innerHTML = "Item deleted";
}		}
	xmlhttp.open("GET", "deletebtn.php?q=" + document.getElementById("eventlist").value, true);
	xmlhttp.send();
} }
function areset() {
document.getElementById("eventlist").options[0].selected = true;
changeItem(0);
}
function loadOptions(pass) {
var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	document.getElementById("toDate").value = today;
	var selectBox = document.getElementById("eventlist");
	selectBox.innerHTML = "";
	var opt = document.createElement('option');
	opt.value = 0;
	opt.text = "<< NEW >>";
	selectBox.options.add(opt);
	opt.selected = true;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var responseArray = xmlhttp.responseText.split("||");
			var selectBox = document.getElementById("eventlist");
			for (a=0;a < responseArray.length -1; a+=2) {
				var opt = document.createElement('option');
				opt.value = responseArray[a];
				opt.text = responseArray[a+1];
				selectBox.options.add(opt);
				if (responseArray[a] == newitemno) { opt.selected = true; selectedvalue = newitemno; }
			}
			newitemno = 0;
		}
	}
	xmlhttp.open("GET", "getlist.php", true);
	xmlhttp.send();	
	if (pass == 1) loadcat();
}
function loadcat() {
	var xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
		if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
			var responseArray = xmlhttp2.responseText.split("||");
			var selectBox = document.getElementById("catid");
			for (a=0;a < responseArray.length -1; a+=2) {
				var opt = document.createElement('option');
				opt.value = responseArray[a];
				opt.text = responseArray[a+1];
				selectBox.options.add(opt);			}
		}
	}
	xmlhttp2.open("GET", "getcat.php", true);
	xmlhttp2.send();

}
function acopy() {
	document.getElementById("deletebtn").disabled = true;
	document.getElementById("copybtn").disabled = true;
	document.getElementById("eventlist").options[0].selected = true;
	selectedvalue = 0;
}
function saveevent() {
	if (document.getElementById("title").value == "") { alert("Missing title"); return; }
	if (document.getElementById("toDate").value == "") { alert("Missing/invalid date"); return; }
	if (document.getElementById("price").value == "") { alert("Missing price"); return; }
	if (document.getElementById("shortdesc").value == "") { alert("Missing short description"); return; }
	if (document.getElementById("imageURL").value == "") { document.getElementById("imageURL").value = "placeholder.jpg" }
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if (selectedvalue == 0) newitemno = Number(xmlhttp.responseText);
			else newitemno = selectedvalue;
			document.getElementById("deletebtn").disabled = false;
			document.getElementById("copybtn").disabled = false;
			loadOptions();
			document.getElementById("message").innerHTML = "Saved";
			curtitle = document.getElementById("title").value;
			curdate = document.getElementById("toDate").value;
			curimage = document.getElementById("imageURL").value;
			curqty = document.getElementById("quantity").value;
			curcat = document.getElementById("catid").value;
			curprice = document.getElementById("price").value;
			curshortdesc = document.getElementById("shortdesc").value;
			curvisible = document.getElementById("visible").checked;
			curfeatured = document.getElementById("featured").checked;
			CKEDITOR.instances.editor1.resetDirty();
			if (redo == true) changeItem(redoitem);
			if (xmlhttp.responseText.length > 5) alert("ERROR: " + xmlhttp.responseText);
		 }
	 }
	xmlhttp.open("POST", "updateevent.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var test = 0;
	if (document.getElementById("featured").checked == true) var test = 1; 
	var test2 = 0;
	if (document.getElementById("visible").checked == true) var test2 = 1; 

	xmlhttp.send("q=" + selectedvalue + "&date=" + document.getElementById("toDate").value + "&b=" + document.getElementById("title").value + "&c=" + document.getElementById("imageURL").value + "&e=" + document.getElementById("shortdesc").value + "&f=" + document.getElementById("price").value + "&g=" + test + "&h=" + document.getElementById("quantity").value + "&i=" + test2 + "&j=" + document.getElementById("catid").value + "&d=" + encodeURIComponent(CKEDITOR.instances.editor1.getData().replace()));
}
function changeItem(newitem) {
window.clearTimeout(timeoutID);
timeoutID = window.setTimeout(function(test) { changing = false; }, 1000);
redo = false;
var newdate = document.getElementById("toDate").value
if (((document.getElementById("title").value != curtitle) || (document.getElementById("title").value != curtitle) || (document.getElementById("quantity").value != curqty) || (document.getElementById("catid").value != curcat) || (document.getElementById("price").value != curprice) || (document.getElementById("shortdesc").value != curshortdesc) || (document.getElementById("visible").checked != curvisible) || (document.getElementById("featured").checked != curfeatured) || (document.getElementById("imageURL").value != curimage) || (newdate != curdate) || (CKEDITOR.instances.editor1.checkDirty())) && (changing == false)) {
	if (confirm("Save changes?")) {
		redo = true;
		redoitem = newitem;
		saveevent();
		return;
	}
}
changing = true;
selectedvalue = newitem;
newitemno = newitem;
if (newitem == 0) {
	document.getElementById("title").value = "";
var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	document.getElementById("toDate").value = today;
	document.getElementById("imageURL").value = "";
	document.getElementById("shortdesc").value = "";
	document.getElementById("price").value = "";
	document.getElementById("quantity").value = "1";
	document.getElementById("visible").checked = true;
	document.getElementById("featured").checked = false;
	document.getElementById("catid").value = "";
	CKEDITOR.instances.editor1.setData("");
	document.getElementById("deletebtn").disabled = true;
	document.getElementById("copybtn").disabled = true;
	curtitle = document.getElementById("title").value;
	curdate = document.getElementById("toDate").value;
	curimage = document.getElementById("imageURL").value;
	curqty = document.getElementById("quantity").value;
	curcat = document.getElementById("catid").value;
	curprice = document.getElementById("price").value;
	curshortdesc = document.getElementById("shortdesc").value;
	curvisible = document.getElementById("visible").checked;
	curfeatured = document.getElementById("featured").checked;
	setTimeout(function(){ CKEDITOR.instances.editor1.resetDirty() },0);
}
if (newitem != 0) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var responseArray = xmlhttp.responseText.split("||");
			document.getElementById("title").value = responseArray[0];
			document.getElementById("toDate").value = responseArray[1];
			document.getElementById("imageURL").value = responseArray[2];
			CKEDITOR.instances.editor1.setData(decodeURIComponent(responseArray[3]));
			document.getElementById("shortdesc").value = responseArray[4];
			document.getElementById("price").value = responseArray[5];
			document.getElementById("quantity").value = responseArray[8];
			if (responseArray[7] == 1) document.getElementById("visible").checked = true;
			else document.getElementById("visible").checked = false;
			if (responseArray[6] == 1) document.getElementById("featured").checked = true;
			else document.getElementById("featured").checked = false;
			document.getElementById("catid").value = parseInt(responseArray[9]);
			curtitle = document.getElementById("title").value;
			curdate = document.getElementById("toDate").value;
			curimage = document.getElementById("imageURL").value;
			curqty = document.getElementById("quantity").value;
			curcat = document.getElementById("catid").value;
			curprice = document.getElementById("price").value;
			curshortdesc = document.getElementById("shortdesc").value;
			curvisible = document.getElementById("visible").checked;
			curfeatured = document.getElementById("featured").checked;
			document.getElementById("deletebtn").disabled = false;
			document.getElementById("copybtn").disabled = false;
			setTimeout(function(){ CKEDITOR.instances.editor1.resetDirty() },0);
		}
	}
	xmlhttp.open("GET", "sqllookup.php?q=" + newitem, true);
	xmlhttp.send();
}
}
function changed() {
document.getElementById("message").innerHTML = "";
}
function selPics() {
window.open('browseep.php' + "?a=" + document.getElementById("imageURL").value,'newWin','status=yes,width=900,height=600');
}
</script>
<style>
label { font-weight: bold; display: inline-block; width: 150px; text-align: right;}
form { font-size: 14px; font-weight: bold;}
.box { width: 48%; display:block; float: left; margin-top: 10px; }
.row { clear: left; width: 98%; }
#price,#saleprice { width: 80px; }
#quantity { width: 40px; }
.right { float:right; display:inline-block; }
h1 { display: inline-block; }
</style>
</head>

<body onload="loadOptions(1)">
<form id="form1" name="form1" method="post">
<h1>Add/Update Items</h1>
<h1 class="right"><a href="../">Home</a></h1><br>

<select name="eventlist" id="eventlist" style="width:400px" onChange="javascript:changeItem(this.value)"><option value="0"><< NEW >></option></select>
<input type="button" value="Delete" id="deletebtn" onclick="javascript:adelete()" disabled> <input type="button" value="Copy" id="copybtn" onclick="javascript:acopy()" disabled> <input type="button" value="Reset" id="resetbtn" onclick="javascript:areset()"><br>
<input type="checkbox" name="featured" value="checkbox" id="featured" onchange="changed()"> Featured
<input type="checkbox" name="visible" value="checkbox" id="visible" onchange="changed()" checked> Visible
<input type="checkbox" name="bestseller" value="checkbox" id="bestseller" onchange="changed()"> Best Seller
<br>
Title: <input type="text" id="title" size="70" maxlength="100" onkeydown="changed()" onchange="changed()"><br>
<div class="box">Short Description: <br>
<textarea id="shortdesc" name="shortdesc" rows="10" cols="50"></textarea><br></div><div class="box">
<label>Date Added: </label><input name="toDate" type="date" id="toDate" onchange="changed()"><br>
<label>Price: </label><input type="text" id="price" name="price" onchange="changed()"><br>
<label>Sale Price:</label><input type="text" id="saleprice" name="saleprice" onchange="changed()">
<br>
<label>Quantity in stock: </label><input type="number" name="quantity" id="quantity" value="1" onchange="changed()"><br>
<label>Catagory: </label><select id="catid" name="catid" onchange="changed()"><option></option></select><br><label></label><input type="button" value="Add a catagory" onclick="addcat()"> <input type="button" value="Remove catagory" onclick="delcat()"><br><br>
<label>Images: </label><input name="imageURL" type="text" id="imageURL" maxlength="999" onkeydown="changed()" onchange="changepic(this.value)"> <input type="button" value="Select/Upload" onclick="selPics()">
</div><div class="row">
<label>Long Description:</label><textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"></textarea><br></div>
<input name="eventsubmit" type="button" id="eventsubmit" value="Save" onclick="javascript:saveevent()">
<span id="message" style="margin-left:25px;color:red;font-weight:bold"></span></form>


</body>
</html>
