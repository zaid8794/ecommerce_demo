<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
if ($_POST) {
    $old_password = $_POST['user_old_password'];
    $new_password = $_POST['user_new_password'];
    $conf_password = $_POST['user_conf_password'];
    $user_email = $_SESSION['user']['user_email'];

    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email = '$user_email'");
    $row = mysqli_fetch_array($select);
    if ($row['user_password'] == $old_password) {
        if ($new_password == $conf_password) {
            if ($old_password == $new_password) {
                echo "<script>alert('New password cannot be same as old password...');window.location='change_password.php';</script>";
            } else {
                $uq = mysqli_query($con, "UPDATE tbl_user SET user_password = '$new_password' WHERE user_email = '$user_email'");
                echo "<script>alert('Password Updated...');window.location='change_password.php';</script>";
            }
        } else {
            echo "<script>alert('New password and confirm password does not match...');window.location='change_password.php';</script>";
        }
    } else {
        echo "<script>alert('Old password does not match...');window.location='change_password.php';</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Old Password : <input type="password" class="form-control shadow-none" placeholder="Enter Old Password" name="user_old_password" required>
            </div>
            <div class="mb-2">
                New Password : <input type="password" class="form-control shadow-none" placeholder="Enter New Password" name="user_new_password" required>
            </div>
            <div class="mb-2">
                Confirm Password : <input type="password" class="form-control shadow-none" placeholder="Enter Confirm Password" name="user_conf_password" required>
            </div>
            <div class="mb-2">
                <input type="submit" class="btn btn-primary" value="Change Password">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>