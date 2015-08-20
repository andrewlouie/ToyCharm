<?php
session_start();
$item = $_GET['item'] - 1;
if ($_GET['qty'] >= 1) {
$_SESSION['cart2'][$item] = floor($_GET['qty']);
}
echo $_SESSION['cart2'][$item];
?>