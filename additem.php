<?php
session_start();
array_push($_SESSION['cart'],$_GET['item']);
array_push($_SESSION['cart2'],$_GET['qty']);
echo count($_SESSION['cart']);
?>