<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['sub'])){
            $sub = $_REQUEST['sub'];
            switch ($sub) {
                case 'add':
                    include "tambah_disposisi.php";
                    break;
                case 'edit':
                    include "edit_disposisi.php";
                    break;
                case 'del':
                    include "hapus_disposisi.php";
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
                } ?>

        <?php        

                $id_surat = $_REQUEST['id_surat'];

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){

                    if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                        echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak memiliki hak akses untuk melihat data ini");
                                window.location.href="./admin.php?page=tsm";
                              </script>';
                    } else {

                      echo '    
                      <!-- ============================================================== -->
                        <div class="container-fluid">
                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <div class="row page-titles">
                            <div class="col-md-5 col-8 align-self-center">
                                <h3 class="text-themecolor m-b-0 m-t-0">Disposisi Surat</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">Disposisi Surat</li>
                                </ol>
                            </div>
                        </div>';
                        
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
                         echo'   
                        <!-- Row Start -->
                        <div class="card">
                            <div class="card-body">
                            <div  style="margin-left: 20px;">
                                <a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=add" class="btn btn-success">Add Disposisi</button>
                                <a href="?page=tsm" class="btn btn-inverse" style="margin-left:10px;">Cancel</a>
                            </div>
                            <h3 style="margin-left: 20px; margin-top:20px;"> Perihal Surat:<br><h4 style="margin-left: 20px;">'.$row['isi'].'</h4></h3>
                                <div class="table-responsive m-t-5">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead >
                                            <tr>
                                                <th style="vertical-align:middle;" width="6%">No</th>
                                                <th style="vertical-align:middle;" width="22%">Tujuan Disposisi</th>
                                                <th style="vertical-align:middle;" width="32%">Isi Disposisi</th>
                                                <th width="24%">Sifat<br/>Batas Waktu</th>
                                                <th style="vertical-align:middle;" width="16%">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>';

                                        $query2 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                                        if(mysqli_num_rows($query2) > 0){
                                            $no = 0;
                                            while($row = mysqli_fetch_array($query2)){
                                            $no++;
                                             echo ' <td>'.$no.'</td>
                                                    <td>'.$row['tujuan'].'</td>
                                                    <td>'.$row['isi_disposisi'].'</td>';

                                                    $y = substr($row['batas_waktu'],0,4);
                                                    $m = substr($row['batas_waktu'],5,2);
                                                    $d = substr($row['batas_waktu'],8,2);

                                                    if($m == "01"){
                                                        $nm = "Januari";
                                                    } elseif($m == "02"){
                                                        $nm = "Februari";
                                                    } elseif($m == "03"){
                                                        $nm = "Maret";
                                                    } elseif($m == "04"){
                                                        $nm = "April";
                                                    } elseif($m == "05"){
                                                        $nm = "Mei";
                                                    } elseif($m == "06"){
                                                        $nm = "Juni";
                                                    } elseif($m == "07"){
                                                        $nm = "Juli";
                                                    } elseif($m == "08"){
                                                        $nm = "Agustus";
                                                    } elseif($m == "09"){
                                                        $nm = "September";
                                                    } elseif($m == "10"){
                                                        $nm = "Oktober";
                                                    } elseif($m == "11"){
                                                        $nm = "November";
                                                    } elseif($m == "12"){
                                                        $nm = "Desember";
                                                    }
                                                    echo '

                                                    <td>'.$row['sifat'].'<br/>'.$d." ".$nm." ".$y.'</td>
                                                    <td>
                                                        <a class="btn btn-success"  href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$row['id_disposisi'].'">
                                                            EDIT</a>
                                                        <a class="btn btn-danger" href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=del&id_disposisi='.$row['id_disposisi'].'">DELETE</a>
                                                    </td>
                                            </tr>
                                        </tbody>';
                                           }
                                        }
                                echo' </table>
                                </div>
                                </div>

                            

     
                            <!-- Row form END -->';
                    } 

                }
            
         
    }
    }
    }    
?>
