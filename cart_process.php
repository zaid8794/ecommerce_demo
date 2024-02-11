<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
if (isset($_POST['addtocart'])) {
    $pro_id = mysqli_real_escape_string($con, $_POST['pro_id']);
    $pro_qty = mysqli_real_escape_string($con, $_POST['pro_qty']);

    if (isset($_SESSION['pro_cart'])) {
        $currentNo = $_SESSION['counter'] + 1;
        $_SESSION['pro_cart'][$currentNo] = $pro_id;
        $_SESSION['qty_cart'][$currentNo] = $pro_qty;
        $_SESSION['counter'] = $currentNo;
    } else {
        $pro_cart = array();
        $qty_cart = array();
        $_SESSION['pro_cart'][0] = $pro_id;
        $_SESSION['qty_cart'][0] = $pro_qty;
        $_SESSION['counter'] = 0;
    }
    header("location:cart.php");
}
if (isset($_GET['delete_pro_cart'])) {
    $id = $_GET['delete_pro_cart'];
    unset($_SESSION['pro_cart'][$id]);
    unset($_SESSION['qty_cart'][$id]);
    header("location:cart.php");
}
