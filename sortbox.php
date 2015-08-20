<div class="row">
<div class="pull-right"><label>Sort By:</label>
<select onchange="changeSort(value)">
<?php
if (!isset($_GET['sort'])) $sortby = 0; else $sortby = $_GET['sort'];
echo "<option";
if ($sortby == 0) echo " selected";
echo " value='0'>Featured</option>";
echo "<option";
if ($sortby == 1) echo " selected";
echo " value='1'>Price higest to lowest</option>";
echo "<option";
if ($sortby == 2) echo " selected";
echo " value='2'>Price lowest to highest</option>";
echo "<option";
if ($sortby == 3) echo " selected";
echo " value='3'>Alphabetically</option>";
echo "<option";
if ($sortby == 4) echo " selected";
echo " value='4'>Newest first</option>";
?>
</select>&nbsp;&nbsp;&nbsp;
</div></div>
