<?php
session_start();
include "helper/db.php";
if (isset($_SESSION['user'])) {
    header("location:index.php");
}
if ($_POST) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email = '$email' AND user_password = '$password'");
    $row = mysqli_fetch_array($select);
    if (mysqli_num_rows($select) == 1) {
        unset($row['user_password']);
        unset($row[5]);
        $_SESSION['user'] = $row;
        header("location:index.php");
    } else {
        echo "<script type='text/javascript'>alert('User not registered...');window.location='register.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container">
        <h1 class="text-center" >Login</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Email : <input type="email" class="form-control shadow-none" placeholder="Enter Email " name="user_email" required>
            </div>
            <div class="mb-2">
                Password : <input type="password" class="form-control shadow-none" placeholder="Enter Password" name="user_password" required>
            </div>
            <div class="mb-2">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <div>
                <a href="forgot_password.php">Forgot Password</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>