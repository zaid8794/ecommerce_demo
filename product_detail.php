<?php
session_start();
include "helper/db.php";

if (isset($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product WHERE pro_id = '$pro_id'");
    $row = mysqli_fetch_array($pro_select);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['pro_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <nav style="--bs-breadcrumb-divider: '>'; background-color: #d3d3d3;" aria-label="breadcrumb">
        <ol class="breadcrumb py-3 ps-5">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $row['pro_name'] ?></li>
        </ol>
    </nav>
    <div class="container">
        <div class="row p-5">
            <div class="col-6">
                <div class="text-center">
                    <img src="uploads/products/<?= $row['pro_image'] ?>" alt="" class="">
                </div>
            </div>
            <div class="col-6">
                <div>
                    <h4><?= strtoupper($row['pro_name']) ?></h4>
                    <h5 class="text-primary mt-3">₹<?= $row['pro_price'] ?>&nbsp;&nbsp;<del class="text-danger">₹<?= round(($row['pro_price'] * 5 / 100) + $row['pro_price']) ?></del></h5>
                    <form action="cart_process.php" method="post">
                        <input type="hidden" name="pro_id" value="<?= $row['pro_id'] ?>">
                        <label for="">Qty :</label>
                        <select name="pro_qty" class="form-control shadow-none w-50">
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" name="addtocart" class="btn btn-success shadow-none mt-3">Add to Cart</button>
                    </form>
                    <p class="mt-4"><?= $row['pro_details'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>