<?php
session_start();
include "helper/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION['user'])) {
    header("location:index.php");
}
if ($_POST) {
    $email = $_POST['user_email'];

    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email = '$email'");
    if (mysqli_num_rows($select) == 1) {
        $row = mysqli_fetch_array($select);
        $msg = "Hello your password is " . $row['user_password'];
        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'zaidvora9@gmail.com';                     //SMTP username
            $mail->Password   = 'qjksktoypplgqpcy';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('zaidvora9@gmail.com', 'Login Demo');
            $mail->addAddress($email, 'Login Demo');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forgot Password';
            $mail->Body    = $msg;
            $mail->AltBody = $msg;

            $mail->send();
            echo "<script type='text/javascript'>alert('Password has been sent on your email...');window.location='login.php';</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script type='text/javascript'>alert('Email not registered...');window.location='register.php';</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Forgot Password</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container">
        <h1 class="text-center">Forgot Password</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Email : <input type="email" class="form-control shadow-none" placeholder="Enter Email " name="user_email" required>
            </div>
            <div class="mb-2">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>