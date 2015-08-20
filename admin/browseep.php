<!doctype html>
<html>
<head>
<title>Toy Store Pictures</title>
    <style>
.pic {
width: 150px;
height: 150px;
float: left;
position: relative;
text-align:center;
margin-bottom: 10px;
margin-left: 5px;
margin-right: 5px;
margin-top: 5px;
border: 2px transparent solid;
}
.pic img {
max-width: 100%;
max-height: 120px;
}
.pic:hover {
border: 2px red dotted;
}
.caption {
	font-size: 12px;
	text-align: center;
	position: absolute;
	bottom: 0px;
	left: 0px;
	width: 100%;
}
#close {
position: absolute;
right: 35px;
top: 35px;
font-size: 25px;
}
* {
	font-family: Constantia, "Lucida Bright", "DejaVu Serif", Georgia, serif;	
}
	</style>
	<script>
selectedfiles = String(opener.document.getElementById("imageURL").value);
function uP(file,itsme) {

	files = selectedfiles.split(",");
	if (files.indexOf(file) >= 0) {
		files.splice(files.indexOf(file),1);
		selectedfiles = String(files);
		itsme.style.border = "2px transparent solid"
	}
	else {
		if (selectedfiles == "") { selectedfiles = file; }
		else {
			files.push(file);
			selectedfiles = String(files);
		}
		itsme.style.border = "2px red solid"
	}
	opener.document.getElementById("imageURL").value = String(selectedfiles);

}

  </script>  </head>

<body>
<?php include ('upload.php'); ?>
<h1>Select Item Pictures</h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    Select image to upload:<br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<input type="button" name="close" id="close" onclick="window.close()" value="Done">
<br><br>
<?php
$selected = $_GET['a'];
// Create recursive dir iterator which skips dot folders
$dir = new RecursiveDirectoryIterator('../images/',
    FilesystemIterator::SKIP_DOTS);

// Flatten the recursive iterator, folders come before their files
$it  = new RecursiveIteratorIterator($dir,
    RecursiveIteratorIterator::SELF_FIRST);

// Maximum depth is 1 level deeper than the base folder
$it->setMaxDepth(1);

// Basic loop displaying different messages based on file or folder
foreach ($it as $fileinfo) {
     if (($fileinfo->isFile())  && ((strtolower(substr($fileinfo->getFilename(),-3)) == "gif") || (strtolower(substr($fileinfo->getFilename(),-3)) == "jpg") || (strtolower(substr($fileinfo->getFilename(),-3)) == "png") || (strtolower(substr($fileinfo->getFilename(),-4)) == "jpeg"))) {
	printf("<div class='pic' ");
	$selectedarray = explode(',',$selected);
	if (in_array($fileinfo->getFilename(),$selectedarray)) printf("style='border:2px red solid' ");
	printf("onclick='javascript:uP(" . '"' . $fileinfo->getFilename() . '"' . ",this)'>");
	printf("<img src='../images/" . $fileinfo->getFilename() . "'><span class='caption'>");
        printf($fileinfo->getFilename());
	printf("</span></div>");
    }
}


?>
</body>
</html>
