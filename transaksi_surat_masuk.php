<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 3){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
        } else {

            if(isset($_REQUEST['act'])){
                $act = $_REQUEST['act'];
                switch ($act) {
                    case 'add':
                        include "tambah_surat_masuk.php";
                        break;
                    case 'edit':
                        include "edit_surat_masuk.php";
                        break;
                    case 'disp':
                        include "disposisi.php";
                        break;
                    case 'print':
                        include "cetak_disposisi.php";
                        break;
                    case 'del':
                        include "hapus_surat_masuk.php";
                        break;
                }
            } else{ 
            $query = mysqli_query($config, "SELECT surat_masuk FROM tbl_sett");
                list($surat_masuk) = mysqli_fetch_array($query);

                //pagging
                $limit = $surat_masuk;
                $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }?> 
                <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Surat Masuk</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">surat Masuk</li>
                </ol>
            </div>
        </div>
<?php
                    if(isset($_SESSION['succAdd'])){
                        $succAdd = $_SESSION['succAdd'];
                        echo '<div class="row">
                                <div class="col-9">
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
                                <div class="col-9">
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
                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>'.$succDel.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succDel']);
                    }
                ?>

    <div class="card">
        <div class="card-body">
            <a href="?page=tsm&act=add" class="btn btn-block btn-danger col-md-1" style="margin-left: 15px;">Add Data</a>  
             <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead id="head">
                        <tr>
                            <th width="10%">No. Agenda<br/>Kode</th>
                            <th width="30%">Isi Ringkas<br/> File</th>
                            <th width="24%" style="vertical-align: middle;">Asal Surat</th>
                            <th width="18%">No. Surat<br/>Tgl Surat</th>
                            <th width="18%" style="vertical-align: middle;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                               <?php 
                               //script untuk menampilkan data
                               $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk ORDER by id_surat DESC ");
                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){
                                      echo '
                                        <td>'.$row['no_agenda'].'<br/><hr/>'.$row['kode'].'</td>
                                        <td>'.substr($row['isi'],0,200).'<br/><br/><strong>File :</strong>';

                                        if(!empty($row['file'])){
                                            echo ' <strong><a href="?page=gsm&act=fsm&id_surat='.$row['id_surat'].'">'.$row['file'].'</a></strong>';
                                        } else {
                                          echo '<em>Tidak ada file yang di upload</em>';
                                        } echo '</td>
                                        <td style="vertical-align: middle;">'.$row['asal_surat'].'</td>';

                                        $y = substr($row['tgl_surat'],0,4);
                                        $m = substr($row['tgl_surat'],5,2);
                                        $d = substr($row['tgl_surat'],8,2);

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

                                        <td>'.$row['no_surat'].'<br/><hr/>'.$d." ".$nm." ".$y.'</td>
                                        <td>';

                                        if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                                            echo '<a class="btn btn-waring" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                                                PRINT</a>';
                                        } else {
                                          echo '<a style="margin-top: 20px;" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="Edit Surat" href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'"><i class="fa fa-link"></i></a>
                                                <a style="margin-top: 20px;" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="top" title="Disposisi Surat" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'"><i class="fa fa-list"></i></a>
                                                <a style="margin-top: 20px;" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Print Surat" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank"><i class="fa fa-check"></i></a>
                                                <a style="margin-top: 20px;" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="top" title="Delete Surat" href="?page=tsm&act=del&id_surat='.$row['id_surat'].'"><i class="fa fa-times"></i></a>';
                                        
                                        } echo '
                                        </td>
                                    </tr>
                                </tbody>';
                                }
                            } echo '</table>
            </div>
        </div>
    </div>';
            }
        }
    }
 ?>    

                