<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
if (isset($_POST['add_category'])) {
    $sub_cat_name = mysqli_real_escape_string($con, $_POST['sub_cat_name']);
    $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']);
    $is_active = mysqli_real_escape_string($con, $_POST['is_active']);

    $insert_pro_query = mysqli_query($con, "INSERT INTO tbl_sub_category(sub_cat_name, cat_id, is_active, insert_date) VALUES ('$sub_cat_name','$cat_id','$is_active',NOW())");
    if ($insert_pro_query) {
        echo "<script type='text/javascript'>alert('Sub Category added successfully...');window.location='add_sub_category.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sub Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container">
        <h1 class="text-center">Add Sub Category</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Sub Category Name : <input type="text" class="form-control shadow-none" placeholder="Enter Sub Category Name" name="sub_cat_name" required>
            </div>
            <div class="mb-2">
                Category :
                <select class="form-control shadow-none" name="cat_id" required>
                    <option value="0" selected disabled>Select Category</option>
                    <?php
                    $cat_select = mysqli_query($con, "SELECT * FROM tbl_category");
                    while ($row = mysqli_fetch_array($cat_select)) {
                    ?>
                        <option value="<?= $row['cat_id'] ?>"><?= $row['cat_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2">
                Is Active :
                <select class="form-control shadow-none" name="is_active" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-2">
                <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>