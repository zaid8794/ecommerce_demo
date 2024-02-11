<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <nav style="--bs-breadcrumb-divider: '>'; background-color: #d3d3d3;" aria-label="breadcrumb">
        <ol class="breadcrumb py-3 ps-5">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>
    <div class="container">
        <table class="table table-bordered border border-dark text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Qty</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['pro_cart']) && !empty($_SESSION['pro_cart'])) {
                    $i = 0;
                    $grandtotal = array();
                    foreach ($_SESSION['pro_cart'] as $key => $value) {
                        $pro_select = mysqli_query($con, "SELECT * FROM tbl_product WHERE pro_id = '$value'");
                        $row = mysqli_fetch_array($pro_select);
                        $qty = $_SESSION['qty_cart'][$key];
                        $subtotaltemp = $row['pro_price'] * $qty;
                        $i++;
                ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img src="uploads/products/<?= $row['pro_image'] ?>" alt="" width="30%"></td>
                            <td><?= $row['pro_name'] ?></td>
                            <td>₹<?= $row['pro_price'] ?></td>
                            <td><?= $qty ?></td>
                            <td>₹<?= $subtotaltemp ?></td>
                            <td><a href="cart_process.php?delete_pro_cart=<?= $key ?>" class="btn btn-sm btn-danger">X</a></td>
                        </tr>
                    <?php

                        $grandtotal[] = $subtotaltemp;
                    }
                    $finalsum =  array_sum($grandtotal);
                    ?>
                    <tr>
                        <td colspan="5"></td>
                        <td class="fw-bold" colspan="2">Grandtotal : ₹<?= $finalsum ?></td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td colspan="6">
                            Cart is empty
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <a href="shipping_info.php" class="btn btn-primary">Checkout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>