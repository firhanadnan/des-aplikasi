<?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
?>    

<!-- Include Head START -->
<?php include('include/head.php'); ?>
<!-- Include Head END --> 

<body class="fix-header logo-center bg">

<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
<header class="topbar">
<!-- Include Navigation START -->
<?php include('include/menu.php'); ?>

<!-- Include Navigation END -->  
</header>
<!-- ============================================================== -->
<?php include('include/menu_bawah.php'); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
       <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" >
            <?php
            if(isset($_REQUEST['page'])){
                $page = $_REQUEST['page'];
                switch ($page) {
                    case 'tsm':
                        include "transaksi_surat_masuk.php";
                        break;
                    case 'ctk':
                        include "cetak_disposisi.php";
                        break;
                    case 'tsk':
                        include "transaksi_surat_keluar.php";
                        break;
                    case 'asm':
                        include "agenda_surat_masuk.php";
                        break;
                    case 'ask':
                        include "agenda_surat_keluar.php";
                        break;
                    case 'ref':
                        include "referensi.php";
                        break;
                    case 'sett':
                        include "pengaturan.php";
                        break;
                    case 'pro':
                        include "profil.php";
                        break;
                    case 'gsm':
                        include "galeri_sm.php";
                        break;
                    case 'gsk':
                        include "galeri_sk.php";
                        break;
                    }
                } else {
            ?>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                    </div>     
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-body">
                                Welcome <?php echo $_SESSION['nama']; ?>. Anda login sebagai 
                                <?php
                                    if($_SESSION['admin'] == 1){
                                        echo "<strong>Administrator</strong>. Anda memiliki akses penuh terhadap sistem.";
                                    } elseif($_SESSION['admin'] == 2){
                                        echo "<strong>Administrator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                                    } else {
                                        echo "<strong>Operator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                 <?php
                    //menghitung jumlah surat masuk
                    $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_masuk"));

                    //menghitung jumlah surat masuk
                    $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_keluar"));

                    //menghitung jumlah surat masuk
                    $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_disposisi"));

                    //menghitung jumlah klasifikasi
                    $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_klasifikasi"));

                    //menghitung jumlah pengguna
                    $count5 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_user"));
                ?>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-info"><i class="mdi mdi-email-outline"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light"><?php echo $count1; ?></h3>
                                        <h5 class="text-muted m-b-0">Total Surat Masuk</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-email-open-outline"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $count2; ?></h3>
                                        <h5 class="text-muted m-b-0">Total Surat Keluar</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $count3; ?></h3>
                                        <h5 class="text-muted m-b-0">Total Disposisi</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-message"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light"><?php echo $count4; ?></h3>
                                        <h5 class="text-muted m-b-0">Total Klasifikasi Surat</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-account-circle"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?php echo $count5; ?></h3>
                                        <h5 class="text-muted m-b-0">Total Pengguna</h5></div>
                                </div>
                            </div>
                        </div>
                    <!-- Column -->
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
               <?php
                    }
               ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php include('include/footer.php'); ?>            

<?php
    }
?>