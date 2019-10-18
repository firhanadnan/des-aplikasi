<?php
    //session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_user.php";
                    break;
                case 'edit':
                    include "edit_tipe_user.php";
                    break;
                case 'del':
                    include "hapus_user.php";
                    break;
            }
        } else {

            //pagging
            $limit = 5;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                } 
            $query = mysqli_query($config, "SELECT * FROM tbl_user LIMIT $curr, $limit");
                ?>


        <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Manajemen User</li>
                </ol>
            </div>
        </div>
        <?php

            if(isset($_SESSION['succAdd'])){
                        $succAdd = $_SESSION['succAdd'];
                        echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>'.$succAdd.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succAdd']);
                    }
                    if(isset($_SESSION['succEdit'])){
                        $succEdit = $_SESSION['succEdit'];
                        echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>'.$succEdit.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succEdit']);
                    }
                    if(isset($_SESSION['succDel'])){
                        $succDel = $_SESSION['succDel'];
                        echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="text-danger">'.$succDel.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succDel']);
                    }
                ?>


    <div class="card">
        <div class="card-body">
            <a href="?page=sett&sub=usr&act=add" class="btn btn-block btn-danger col-md-1" style="margin-left: 15px;">Add Data</a>  
             <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th style="vertical-align: middle;" width="8%">No</th>
                                        <th style="vertical-align: middle;" width="23%">Username</th>
                                        <th width="30%">Nama<br/>NIP</th>
                                        <th style="vertical-align: middle;" width="22%">Level</th>
                                        <th style="vertical-align: middle;" width="16%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php 

                                    if(mysqli_num_rows($query) > 0){
                                        $no = 1;
                                        while($row = mysqli_fetch_array($query)){
                                        echo '<td>'.$no++.'</td>';

                                        if($row['admin'] == 1){
                                            $row['admin'] = 'Super Admin';
                                        } elseif($row['admin'] == 2){
                                            $row['admin'] = 'Administrator';
                                        } else {
                                            $row['admin'] = 'User Biasa';
                                        } echo '<td>'.$row['username'].'</td>
                                                <td>'.$row['nama'].'<br/>'.$row['nip'].'</td>
                                                <td>'.$row['admin'].'</td>
                                                <td>';

                                        if($_SESSION['username'] == $row['username']){
                                            echo '<button class="btn btn-primary">No Action</button>';
                                        } else {

                                        if($row['id_user'] == 1){
                                            echo '<button class="btn btn-primary">No Action</button>';
                                        } else {
                                          echo ' <a class="btn btn-success" href="?page=sett&sub=usr&act=edit&id_user='.$row['id_user'].'">EDIT</a>
                                                 <a class="btn btn-danger" href="?page=sett&sub=usr&act=del&id_user='.$row['id_user'].'">DELETE</a>';
                                        }
                                    } echo '</td>
                                    </tr>
                                </tbody>';
                                    }
                                } 
                      echo '</table>
                            <!-- Table END -->
            </div>
        </div>
    </div>';
                    
              
                }
            }
?>
