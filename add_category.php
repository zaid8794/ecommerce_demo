<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
if (isset($_POST['add_category'])) {
    $cat_name = mysqli_real_escape_string($con, $_POST['cat_name']);
    $is_active = mysqli_real_escape_string($con, $_POST['is_active']);

    $insert_pro_query = mysqli_query($con, "INSERT INTO tbl_category(cat_name, is_active, insert_date) VALUES ('$cat_name','$is_active',NOW())");
    if ($insert_pro_query) {
        echo "<script type='text/javascript'>alert('Category added successfully...');window.location='add_category.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container">
        <h1 class="text-center">Add Category</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Category Name : <input type="text" class="form-control shadow-none" placeholder="Enter Category Name" name="cat_name" required>
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