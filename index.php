<?php
session_start();
/* databsae connection start here  */
require_once 'config/dbconfig.php';
/* databsae connection end here  */

if (isset($_POST['log_in'])) {
    $email = $con->real_escape_string($_POST['email']);
    $pass = $con->real_escape_string($_POST['pass']);
    $hashkey = "manageoffice";
    $hash = hash('gost', $pass . $hashkey);

    $sql = "SELECT * FROM `login` where email = '$email' AND user_password ='$hash'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);
   
    if ($row == 1) {
        $_SESSION['id'] = $email;
        header('Location:dashboard.php');
    } else {
        echo "Log in failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form action="" method="post" class="form-signin">
                        <div class="account-logo">
                            <a href="index-2.html"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Username or Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" name="log_in" class="btn btn-primary account-btn">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>