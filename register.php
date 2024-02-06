<?php
session_start();
include "helper/db.php";
if (isset($_SESSION['user'])) {
    header("location:index.php");
}
if ($_POST) {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $mobile = $_POST['user_mobile'];
    $gender = $_POST['user_gender'];
    $password = $_POST['user_password'];

    $filename = $_FILES['user_photo']['name'];
    $filepath = $_FILES['user_photo']['tmp_name'];

    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email = '$email'");
    if (mysqli_num_rows($select) > 0) {
        echo "<script type='text/javascript'>alert('User Already Registered...');window.location='register.php';</script>";
    } else {
        $q = mysqli_query($con, "INSERT INTO tbl_user(user_name, user_email, user_mobile, user_gender, user_password, user_photo) VALUES 
        ('$name','$email','$mobile','$gender','$password','$filename')") or die("Error is " . mysqli_error($con));

        if ($q) {
            move_uploaded_file($filepath, "uploads/users/" . $filename);
            echo "<script type='text/javascript'>alert('User Registered Successfully...');window.location='login.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container">
        <h1 class="text-center">Register</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Name : <input type="text" class="form-control shadow-none" placeholder="Enter Name " name="user_name" required>
            </div>
            <div class="mb-2">
                Email : <input type="email" class="form-control shadow-none" placeholder="Enter Email " name="user_email" required>
            </div>
            <div class="mb-2">
                Mobile : <input type="text" class="form-control shadow-none" placeholder="Enter Mobile" name="user_mobile" required>
            </div>
            <div class="mb-2">
                Gender :
                <input type="radio" class="shadow-none" name="user_gender" value="Male" required> Male
                <input type="radio" class="shadow-none" name="user_gender" value="Female" required> Female
            </div>
            <div class="mb-2">
                Password : <input type="password" class="form-control shadow-none" placeholder="Enter Password" name="user_password" required>
            </div>
            <div class="mb-2">
                Photo : <input type="file" class="form-control shadow-none" name="user_photo" required>
            </div>
            <div class="mb-2">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>