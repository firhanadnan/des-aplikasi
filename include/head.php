<?php
    //cek session
    if(!empty($_SESSION['admin'])){
?>
<?php require('include/config.php'); ?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Dokumentasi E-Surat </title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="horizontal/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="horizontal/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="assets/plugins/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style type="text/css">
        body {
            background: #fff;
        }
        .bg::before {
            content: '';
            background-image: url('./asset/img/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: fixed;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.10;
            filter:alpha(opacity=10);
        }
        #header-instansi {
            margin-top: 1%;
        }
        .ams {
            font-size: 1.8rem;
        }
        .grs {
            position: absolute;
            margin: 10px 0;
            background-color: #fff;
            height: 42px;
            width: 1px;
        }
        #menu {
            margin-left: 20px;
        }
        .title {
            background: #333;
            border-radius: 3px 3px 0 0;
            margin: -20px -20px 25px;
            padding: 20px;
        }
        .logo {
            border-radius: 50%;
            margin: 0 15px 15px 0;
            width: 90px;
            height: 90px;
        }
        .logoside {
            border-radius: 50%;
            margin: 0 auto;
            width: 125px;
            height: 125px;
        }
        .ins {
            font-size: 1.8rem;
        }
        .almt {
            font-size: 1.15rem;
        }
        .description {
            font-size: 1.4rem;
        }
        .jarak {
            height: 13.4rem;
        }
        .hidden {
            display: none;
        }
        .add {
            font-size: 1.45rem;
            padding: 0.1rem 0;
        }
        .jarak-card {
            margin-top: 1rem;
        }
        .jarak-filter {
            margin: -12px 0 5px;
        }
        #footer {
            background: blue darken-1;
        }
        .warna {
            color: #444;
        }
        .agenda {
            font-size: 1.39rem;
            padding-left: 8px;
        }
        .hid {
            display: none;
        }
        .galeri {
            width: 100%;
            height: 26rem;
        }
        .gbr {
            float: right;
            width: 80%;
            height: auto;
        }
        .file {
            width: 70%;
            height: auto;
        }
        .kata {
            font-size: 1.04rem;
        }
        #alert-message {
            font-size: 0.9rem;
        }
        .notif {
            margin: -1rem 0!important;
        }
        .green-text, .red-text {
            font-weight: normal!important;
        }
        .lampiran {
            color: #444!important;
            font-weight: normal!important;
        }
        .waves-green {
            margin-bottom: -20px!important;
        }
        div.callout {
            height: auto;
            width: auto;
            float: left;
        }
        div.callout {
            position: relative;
            padding: 13px;
            border-radius: 3px;
            margin: 25px;
            min-height: 46px;
            top: -25px;
        }
        .callout::before {
            content: "";
            width: 0px;
            height: 0px;
            border: 0.8em solid transparent;
            position: absolute;
        }
        .callout.bottom::before {
            left: 25px;
            top: -20px;
            border-bottom: 10px solid #ffcdd2;
        }
        .pace {
            -webkit-pointer-events: none;
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            -webkit-transform: translate3d(0, -50px, 0);
            -ms-transform: translate3d(0, -50px, 0);
            transform: translate3d(0, -50px, 0);
            -webkit-transition: -webkit-transform .5s ease-out;
            -ms-transition: -webkit-transform .5s ease-out;
            transition: transform .5s ease-out;
        }
        .pace.pace-active {
            -webkit-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
        .pace .pace-progress {
            display: block;
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 100%;
            width: 100%;
            height: 3px;
            background: #2196f3;
            pointer-events: none;
        }
        @media print{
            .side-nav,
            .secondary-nav,
            .jarak-form,
            .center,
            .hide-on-med-and-down,
            .dropdown-content,
            .button-collapse,
            .btn-large,
            .footer-copyright {
                display: none;
            }
            body {
                font-size: 12px;
                color: #212121;
            }
            .hid {
                display: block;
                font-size: 16px;
                text-transform: uppercase;
                margin-bottom: 0;
            }
            .add {
                font-size: 15px!important;
            }
            .agenda {
                font-size: 13px;
                text-align: center;
                color: #212121;
            }
            th, td{
                border: 1px solid #444 !important;
            }
            th{
                padding: 5px;
                display: table-cell;
                text-align: center;
                vertical-align: middle;
            }
            td{
                padding: 0px;
            }
            table {
              border-collapse: collapse;
              border-spacing: 0;
              font-size: 10px;
              color: #212121;
            }
            .container {
                margin-top: -20px !important;
            }
        }
        noscript{
            color: #fff;
        }
        @media only screen and (max-width: 701px) {
            #colres{
                width: 100%;
                overflow-x: scroll!important;
            }
            #tbl{
                width: 600px!important;
            }
        }
    </style>
</head>
<?php
    } else {
        header("Location: ../");
        die();
    }
?>
