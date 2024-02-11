<?php
session_start();
include "helper/db.php";

if (isset($_GET['sub_cat_id'])) {
    $sub_cat_id = $_GET['sub_cat_id'];
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product WHERE sub_cat_id = '$sub_cat_id'");
} else if (isset($_GET['pro_search'])) {
    $search_keyword = $_GET['pro_search'];
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product WHERE pro_name LIKE '%$search_keyword%'");
} else {
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product");
}
$sub_cat_select = mysqli_query($con, "SELECT * FROM tbl_sub_category");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <nav style="--bs-breadcrumb-divider: '>'; background-color: #d3d3d3;" aria-label="breadcrumb">
        <ol class="breadcrumb py-3 ps-5">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
    </nav>
    <div class="container">
        <div class="text-center" style="font-size: large;">
            <a href="shop.php" class="" style="text-decoration: none;">All<span class="text-black">&nbsp;&nbsp;|&nbsp;</span></a>
            <?php
            while ($row = mysqli_fetch_array($sub_cat_select)) {
            ?>
                <a href="shop.php?sub_cat_id=<?= $row['sub_cat_id'] ?>" class="" style="text-decoration: none;"><?= $row['sub_cat_name'] ?><span class="text-black">&nbsp;&nbsp;|&nbsp;</span></a>
            <?php
            }
            ?>
        </div>
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-6">
                <form id="search_form">
                    <input type="search" name="pro_search" placeholder="Enter Search Keyword" id="search" class="form-control shadow-none mt-1" required>
                    <button type="submit" style="display: none;" id="search" class="btn btn-success">Search</button>
                </form>
            </div>
        </div>
        <h4 class="mt-4 text-center"><?= mysqli_num_rows($pro_select) . " Records Found" ?></h4>
        <div class="row row-cols-1 row-cols-md-3 g-4 pt-4 pb-5">
            <?php
            while ($row = mysqli_fetch_array($pro_select)) {
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="uploads/products/<?= $row['pro_image'] ?>" class="card-img-top mx-auto pt-2" alt="<?= $row['pro_name'] ?>" style="max-width: 100%; width:50%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="product_detail.php?pro_id=<?= $row['pro_id'] ?>" class="text-black"><?= $row['pro_name'] ?></a></h5>
                            <p class="card-text">₹<?= $row['pro_price'] ?></p>
                            <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;"><?= $row['pro_details'] ?></p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>