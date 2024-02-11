<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
if ($_POST) {
    $shipping_name = $_POST['shipping_name'];
    $shipping_mobile = $_POST['shipping_mobile'];
    $shipping_address = $_POST['shipping_address'];
    $ordermasterq = mysqli_query($con, "INSERT INTO tbl_order_master(order_date, user_id, order_status, shipping_name, shipping_mobile, shipping_address) VALUES (CURRENT_TIMESTAMP(),'" . $_SESSION['user']['user_id'] . "','Pending','$shipping_name','$shipping_mobile','$shipping_address')");
    $order_id = mysqli_insert_id($con);
    foreach ($_SESSION['pro_cart'] as $key => $value) {
        $productq = mysqli_query($con, "SELECT * FROM tbl_product WHERE pro_id = '$value'");
        $productrow = mysqli_fetch_array($productq);
        if ($ordermasterq) {
            $order_insertq = mysqli_query($con, "INSERT INTO tbl_order_detail(order_id, product_id, product_qty, product_price) VALUES ('$order_id','$value','" . $_SESSION['qty_cart'][$key] . "','" . $productrow['pro_price'] . "')");
        }
    }
    if ($order_insertq) {
        unset($_SESSION['pro_cart']);
        unset($_SESSION['qty_cart']);
        unset($_SESSION['counter']);

        echo "<script>alert('Your order has been placed...');window.location='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <nav style="--bs-breadcrumb-divider: '>'; background-color: #d3d3d3;" aria-label="breadcrumb">
        <ol class="breadcrumb py-3 ps-5">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>
    <div class="container">
        <h1 class="text-center">Shipping Address</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Name : <input type="text" class="form-control shadow-none" placeholder="Enter Name " name="shipping_name" required>
            </div>
            <div class="mb-2">
                Mobile : <input type="text" class="form-control shadow-none" placeholder="Enter Mobile" name="shipping_mobile" required>
            </div>
            <div class="mb-2">
                Address : <textarea class="form-control shadow-none" placeholder="Enter Address" name="shipping_address" required></textarea>
            </div>
            <div class="mb-2 d-flex justify-content-end">
                <input type="submit" class="btn btn-primary" value="Place Order">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>