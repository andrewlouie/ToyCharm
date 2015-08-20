<?php
session_start();
$item = $_GET['item'] - 1;
$cart3 = $_SESSION['cart'];
$cart4 = $_SESSION['cart2'];
unset($cart3[$item]);
unset($cart4[$item]);
$_SESSION['cart'] = array_values($cart3);
$_SESSION['cart2'] = array_values($cart4);
echo count($_SESSION['cart']);
?>