<?php
    ob_start();
    session_start();

    //cek session
    if(isset($_SESSION['admin'])){
        header("Location: ./admin.php");
        die();
    }
    require('include/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/css/util.css">
    <link rel="stylesheet" type="text/css" href="./assets/Login_v2/css/main.css">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100"  style="background-image:url('assets/images/back.jpeg');
              background-size: cover;
              background-repeat: no-repeat;
              background-position: center center;
              position: fixed;">
            <div class="wrap-login100">
                <?php
                        if(isset($_REQUEST['submit'])){

                            //validasi form kosong
                            if($_REQUEST['username'] == "" || $_REQUEST['password'] == ""){
                                echo '<div class="upss red-text"><i class="material-icons">error_outline</i> <strong>ERROR!</strong> Username dan Password wajib diisi.
                                <a class="btn-large waves-effect waves-light blue-grey col s11" href="./" style="margin: 20px 0 0 5px;"><i class="material-icons md-24">arrow_back</i> Kembali ke login form</a></div>';
                            } else {

                                $username = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['username'])));
                                $password = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['password'])));

                                $query = mysqli_query($config, "SELECT id_user, username, nama, nip, admin FROM tbl_user WHERE username=BINARY'$username' AND password=MD5('$password')");

                                if(mysqli_num_rows($query) > 0){
                                    list($id_user, $username, $nama, $nip, $admin) = mysqli_fetch_array($query);

                                    session_start();

                                    //buat session
                                    $_SESSION['id_user'] = $id_user;
                                    $_SESSION['username'] = $username;
                                    $_SESSION['nama'] = $nama;
                                    $_SESSION['nip'] = $nip;
                                    $_SESSION['admin'] = $admin;

                                    header("Location: ./admin.php");
                                    die();
                                } else {

                                    //session error
                                    $_SESSION['errLog'] = '<center>Username & Password tidak ditemukan!</center>';
                                    header("Location: ./");
                                    die();
                                }
                            }
                        } else {
                    ?>
                <form  method="POST" action="">
                    
                    <span class="login100-form-title p-b-48">
                        <img src="./assets/Login_v2/logo_1.png" alt="logo" style="width: 300px">
                    </span>
                    <?php
                                if(isset($_SESSION['errLog'])){
                                    $errLog = $_SESSION['errLog'];
                                    echo '<div id="alert-message" class="error red lighten-5"><div class="center"><i class="material-icons">error_outline</i> <strong>LOGIN GAGAL!</strong></div>
                                    '.$errLog.'</div>';
                                    unset($_SESSION['errLog']);
                                }
                                if(isset($_SESSION['err'])){
                                    $err = $_SESSION['err'];
                                    echo '<div id="alert-message" class="error red lighten-5"><div class="center"><i class="material-icons">error_outline</i> <strong>ERROR!</strong></div>
                                    '.$err.'</div>';
                                    unset($_SESSION['err']);
                                }
                            ?>
                    <div class="wrap-input100 validate-input" data-validate = "Valid username is: a@b.c">
                        <input class="input100" type="text" name="username">
                        <span class="focus-input100" data-placeholder="Username"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" name="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        
                    </div>
                </form>
                 <?php
                        }
                 ?>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="./assets/Login_v2/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="./assets/Login_v2/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="./assets/Login_v2/vendor/bootstrap/js/popper.js"></script>
    <script src="./assets/Login_v2/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="./assets/Login_v2/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="./assets/Login_v2/vendor/daterangepicker/moment.min.js"></script>
    <script src="./assets/Login_v2/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="./assets/Login_v2/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="./assets/Login_v2/js/main.js"></script>
</body>
</html>