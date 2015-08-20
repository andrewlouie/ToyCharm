<nav style="display:block;clear:both;">
<ul class="pagination">
<?php 
if (isset($_SESSION['totalcount'])) $limit = $_SESSION['totalcount']; else $limit = 0;
if (!isset($_GET['skip'])) $skip = 0; else $skip = $_GET['skip'];
if ($skip == 0) echo "<li class='disabled'><span aria-hidden='true'>&laquo</span></li>";
else {
echo "<li><a href='";
echo basename($_SERVER['PHP_SELF']);
echo "?skip=";
if ($skip > 100) echo $skip - 100; else echo "0";
if (isset($_GET['featured'])) echo "&featured=y";
if (isset($_GET['sort'])) echo "&sort=" . $_GET['sort'];
if (isset($_GET['cat'])) echo "&cat=" . $_GET['cat'];
if (isset($_GET['bestsellers'])) echo "&bestsellers=" . $_GET['bestsellers'];
if (isset($_GET['sale'])) echo "&sale=" . $_GET['sale'];
if (isset($_GET['searchbox'])) echo "&searchbox=" . $_GET['searchbox'];
echo "' aria-label='Previous'><span aria-hidden='true'>&laquo</span></a></li>";
}
if ($skip >= 40) $start = $skip - 40; else $start = 0;
for ($i = 0;$i<5;$i++) {
if (($start + ($i * 20)) < $limit) {
	echo "<li";
	echo "><a href='";
	echo basename($_SERVER['PHP_SELF']);
	echo "?skip=";
	echo $start + ($i * 20);
	if (isset($_GET['featured'])) echo "&featured=y";
	if (isset($_GET['sort'])) echo "&sort=" . $_GET['sort'];
	if (isset($_GET['sale'])) echo "&sale=" . $_GET['sale'];
	if (isset($_GET['bestsellers'])) echo "&bestsellers=" . $_GET['bestsellers'];	
	if (isset($_GET['cat'])) echo "&cat=" . $_GET['cat'];
	if (isset($_GET['searchbox'])) echo "&searchbox=" . $_GET['searchbox'];
	echo "'>";
	echo ($start /20) + ($i + 1);
	echo " ";
	if ((floor($skip / 100) * 100) + ($i * 20) == $skip) echo "<span class='sr-only'>(current)</span>";
	echo "</a></li>";
}
else {
	echo "<li class='disabled'><span aria-hidden='true'>";
	echo ($start /20) + ($i + 1);
	echo " ";
	if ((floor($skip / 100) * 100) + ($i * 20) == $skip) echo "<span class='sr-only'>(current)</span>";
	echo "</span></li>";
} }
if ($skip + 100 < $limit) {
echo "<li";
echo "><a href='";
echo basename($_SERVER['PHP_SELF']);
echo "?skip=";
echo $skip + 100;
if (isset($_GET['featured'])) echo "&featured=y";
if (isset($_GET['sort'])) echo "&sort=" . $_GET['sort'];
if (isset($_GET['cat'])) echo "&cat=" . $_GET['cat'];
if (isset($_GET['sale'])) echo "&sale=" . $_GET['sale'];
if (isset($_GET['bestsellers'])) echo "&bestsellers=" . $_GET['bestsellers'];
if (isset($_GET['searchbox'])) echo "&searchbox=" . $_GET['searchbox'];
echo "' aria-label='Next'><span aria-hidden='true'>&raquo</span></a></li>";
}
else {
echo "<li class='disabled'><span aria-hidden='true'>&raquo</span></a></li>";
}
?>
</ul>
</nav>