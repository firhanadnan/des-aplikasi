<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_klasifikasi.php";
                    break;
                case 'edit':
                    include "edit_klasifikasi.php";
                    break;
                case 'del':
                    include "hapus_klasifikasi.php";
                    break;
            }
        } else {

            $query = mysqli_query($config, "SELECT referensi FROM tbl_sett");
            list($referensi) = mysqli_fetch_array($query);

            //pagging
            $limit = $referensi;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }
                ?>
<div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Klasifikasi Surat</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Klasifikasi Surat</li>
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
            <a href="?page=ref&act=add" class="btn btn-block btn-danger col-md-1" style="margin-left: 15px;">Add Data</a>  
             <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead id="head">
                        <tr>
                            <th width="10%">Kode</th>
                            <th width="30%">Nama</th>
                            <th width="42%">Uraian</th>
                            <th width="18%">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                    //script untuk menampilkan data
                                    $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi ORDER BY id_klasifikasi DESC LIMIT $curr, $limit");
                                    if(mysqli_num_rows($query) > 0){
                                        while($row = mysqli_fetch_array($query)){
                                          echo '<td>'.$row['kode'].'</td>
                                                <td>'.$row['nama'].'</td>
                                                <td>'.$row['uraian'].'</td>
                                                <td>';

                                                if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
                                                    echo '<a class="btn small blue-grey waves-effect waves-light"><i class="material-icons">error</i> NO ACTION</a>';
                                                } else {
                                                  echo '<a class="btn btn-success" href="?page=ref&act=edit&id_klasifikasi='.$row['id_klasifikasi'].'">EDIT</a>
                                                        <a class="btn btn-danger" href="?page=ref&act=del&id_klasifikasi='.$row['id_klasifikasi'].'">DEL</a>';
                                                } echo '
                                                </td>
                                            </tr>
                                        </tbody>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="?page=ref&act=add">Tambah data baru</a></u></p></center></td></tr>';
                                    }
                                  echo '</table><br/><br/>
                            </div>
                        </div>
                    </div>    
                        <!-- Row form END -->';

                       
            
        }
    }
?>
