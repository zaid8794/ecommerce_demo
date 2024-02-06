<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
if (isset($_POST['add_product'])) {
    $pro_name = mysqli_real_escape_string($con, $_POST['pro_name']);
    $pro_price = mysqli_real_escape_string($con, $_POST['pro_price']);
    $pro_details = mysqli_real_escape_string($con, $_POST['pro_details']);
    $filename = $_FILES['pro_image']['name'];
    $filepath = $_FILES['pro_image']['tmp_name'];
    $sub_cat_id = mysqli_real_escape_string($con, $_POST['sub_cat_id']);
    $pro_qty = mysqli_real_escape_string($con, $_POST['pro_qty']);
    $is_active = mysqli_real_escape_string($con, $_POST['is_active']);

    $insert_pro_query = mysqli_query($con, "INSERT INTO tbl_product(pro_name, pro_price, pro_details, pro_image, sub_cat_id, pro_qty, is_active, insert_date) VALUES ('$pro_name','$pro_price','$pro_details','$filename','$sub_cat_id','$pro_qty','$is_active',currenttimestamp())");
    if ($insert_pro_query) {
        move_uploaded_file($filepath, "uploads/products/" . $filename);
        echo "<script type='text/javascript'>alert('Product added successfully...');window.location='add_product.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container">
        <h1 class="text-center">Add Product</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Product Name : <input type="text" class="form-control shadow-none" placeholder="Enter Product Name" name="pro_name" required>
            </div>
            <div class="mb-2">
                Product Price : <input type="text" class="form-control shadow-none" placeholder="Enter Product Price" name="pro_price" required>
            </div>
            <div class="mb-2">
                Product Detail : <textarea class="form-control shadow-none" placeholder="Enter Product Detail" name="pro_details" required></textarea>
            </div>
            <div class="mb-2">
                Product Image : <input type="file" class="form-control shadow-none" name="pro_image" required>
            </div>
            <div class="mb-2">
                Product Sub Category :
                <select class="form-control shadow-none" name="sub_cat_id" required>
                    <option value="0" selected disabled>Select Sub Category</option>
                    <?php
                    $sub_cat_select = mysqli_query($con, "SELECT * FROM tbl_sub_category");
                    while ($row = mysqli_fetch_array($sub_cat_select)) {
                    ?>
                        <option value="<?= $row['sub_cat_id'] ?>"><?= $row['sub_cat_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2">
                Product Quantity : <input type="text" class="form-control shadow-none" placeholder="Enter Product Qty" name="pro_qty" required>
            </div>
            <div class="mb-2">
                Is Active :
                <select class="form-control shadow-none" name="is_active" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-2">
                <input type="submit" name="add_product" class="btn btn-primary" value="Add Product">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>