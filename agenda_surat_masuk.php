<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        echo '
            <style type="text/css">
                .hidd {
                    display: none
                }
                @media print{
                body {
                    font-size: 12px;
                    color: #212121;
                }
                table {
                    width: 100%;
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border: table-cell;
                    border: 1px  solid #444;
                    padding: 8px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                .isi {
                    height: 200px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 80px;
                    height: 80px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
                    font-size: 20px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }
                .separator {
                    border-bottom: 2px solid #616161;
                    margin: -1rem 0 1rem;
                }
                #website {
                 text-align: center;
                    margin-top: -15px;
                    font-size: 13px;
                    margin: -.9rem 0;
                }

            }
            </style>';

        if(isset($_REQUEST['submit'])){

            $dari_tanggal = $_REQUEST['dari_tanggal'];
            $sampai_tanggal = $_REQUEST['sampai_tanggal'];

            if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
                header("Location: ./admin.php?page=asm");
                die();
            } else {

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");

                $query2 = mysqli_query($config, "SELECT nama FROM tbl_instansi");
                list($nama) = mysqli_fetch_array($query2);

                echo '
                    <!-- SHOW DAFTAR AGENDA -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
            
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                <div class="noprint">    
                    <div class="row page-titles">
                        <div class="col-md-5 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Agenda Surat Masuk</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Agenda Surat Masuk</li>
                            </ol>
                        </div>
                    </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-material m-t-10" method="post" action="">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Dari Tanggal</label>
                                    <div class="col-md-4">
                                    <input id="mdate" type="text" class="form-control form-control-line" name="dari_tanggal" required>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Sampai Tanggal</label>
                                    <div class="col-md-4">
                                        <input id="mdate2" type="text" class="form-control form-control-line" name="sampai_tanggal" required>
                                    </div>
                                </div>
                           </div>
                           <div  style="margin-left: 40px;">
                                <button type="submit" name ="submit" class="btn btn-success"> <i class="fa fa-check"></i> Tampilkan</button>
                           </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>                    
   </div>                
                <div class="row agenda">
                        <div class="col sm-10">
                            <div class="disp hidd">';
                                $query2 = mysqli_query($config, "SELECT institusi, nama, status, alamat, logo FROM tbl_instansi");
                                list($institusi, $nama, $status, $alamat, $logo) = mysqli_fetch_array($query2);
                                if(!empty($logo)){
                                    echo '<img class="logodisp" src="./upload/'.$logo.'"/>';
                                } else {
                                    echo '<img class="logodisp" src="./asset/img/logo.png"/>';
                                }
                                if(!empty($institusi)){
                                    echo '<h6 class="up">'.$institusi.'</h6>';
                                } else {
                                    echo '<h6 class="up">Yayasan Pendidikan Dan Sosial Al - Husna</h6>';
                                }
                                if(!empty($nama)){
                                    echo '<h5 class="up" id="nama">'.$nama.'</h5><br/>';
                                } else {
                                    echo '<h5 class="up" id="nama">SMK Al - Husna Loceret Nganjuk</h5><br/>';
                                }
                                if(!empty($status)){
                                    echo '<h6 class="status">'.$status.'</h6>';
                                } else {
                                    echo '<h6 class="status">Akta Notaris: SLAMET , SH, M.Hum No. 119/2013</h6>';
                                }
                                if(!empty($alamat)){
                                    echo '<span id="alamat">'.$alamat.'</span>';
                                } else {
                                    echo '<span id="alamat">Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471</span>';
                                }
                                echo '
                            </div>   
                        </div>
                    </div>
                    
                    <h5 class="hid" style="text-align:center; margin-bottom:20px;"><strong>AGENDA SURAT MASUK</strong></h5>';

                            $y = substr($dari_tanggal,0,4);
                            $m = substr($dari_tanggal,5,2);
                            $d = substr($dari_tanggal,8,2);
                            $y2 = substr($sampai_tanggal,0,4);
                            $m2 = substr($sampai_tanggal,5,2);
                            $d2 = substr($sampai_tanggal,8,2);

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

                            if($m2 == "01"){
                                $nm2 = "Januari";
                            } elseif($m2 == "02"){
                                $nm2 = "Februari";
                            } elseif($m2 == "03"){
                                $nm2 = "Maret";
                            } elseif($m2 == "04"){
                                $nm2 = "April";
                            } elseif($m2 == "05"){
                                $nm2 = "Mei";
                            } elseif($m2 == "06"){
                                $nm2 = "Juni";
                            } elseif($m2 == "07"){
                                $nm2 = "Juli";
                            } elseif($m2 == "08"){
                                $nm2 = "Agustus";
                            } elseif($m2 == "09"){
                                $nm2 = "September";
                            } elseif($m2 == "10"){
                                $nm2 = "Oktober";
                            } elseif($m2 == "11"){
                                $nm2 = "November";
                            } elseif($m2 == "12"){
                                $nm2 = "Desember";
                            }
                            echo '

                            <h4 style="margin-left: 40px; text-align:center;">Agenda Surat Masuk dari tanggal <strong>'.$d." ".$nm." ".$y.'</strong> sampai dengan tanggal <strong>'.$d2." ".$nm2." ".$y2.'</strong> <button style="margin-left: 42px;" type="submit" onClick="window.print()" class="btn btn-large btn-warning">CETAK AGENDA</button></h4>
                            
 ';
            echo'
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                   <div class="card">
                        <div class="card-body">
                             <div class="table-responsive m-t-5">
                                <table  class="table table-bordered table-striped">
                                <thead class="blue lighten-4">
                                    <tr>
                                        <th width="3%">No</th>
                                        <th width="5%">Kode</th>
                                        <th width="21%">Isi Ringkas</th>
                                        <th width="18%">Asal Surat</th>
                                        <th width="15%">Nomor Surat</th>
                                        <th width="8%">Tanggal<br/> Surat</th>
                                        <th width="10%">Pengelola</th>
                                        <th width="8%">Tanggal <br/>Paraf</th>
                                        <th width="10%">Keterangan</th>
                                    </tr>
                                </thead>

                            <tbody>
                                <tr>';

                            if(mysqli_num_rows($query) > 0){
                                $no = 0;
                                while($row = mysqli_fetch_array($query)){
                                 echo '
                                        <td>'.$row['no_agenda'].'</td>
                                        <td>'.$row['kode'].'</td>
                                        <td>'.$row['isi'].'</td>
                                        <td>'.$row['asal_surat'].'</td>
                                        <td>'.$row['no_surat'].'</td>';

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
                                        <td>'.$d." ".$nm." ".$y.'</td>
                                        <td>';

                                        $id_user = $row['id_user'];
                                        $query3 = mysqli_query($config, "SELECT nama FROM tbl_user WHERE id_user='$id_user'");
                                        list($nama) = mysqli_fetch_array($query3);{
                                            $row['id_user'] = ''.$nama.'';
                                        }

                                        echo ''.$row['id_user'].'</td>
                                        <td>'.$d." ".$nm." ".$y.'</td>
                                        <td>'.$row['keterangan'].'';
                                  echo '</td>
                                </tr>
                            </tbody>';
                                }
                            } else {
                                echo '<tr><td colspan="9"><center><p class="add">Tidak ada agenda surat</p></center></td></tr>';
                            } echo '
                        </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>';
            }
        } else {

            echo '
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-5 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Agenda Surat Masuk</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Agenda Surat Masuk</li>
                            </ol>
                        </div>
                    </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-material m-t-10" method="post" action="">
                            <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Dari Tanggal</label>
                                    <div class="col-md-4">
                                    <input id="mdate" type="text" class="form-control form-control-line" name="dari_tanggal" required>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Sampai Tanggal</label>
                                    <div class="col-md-4">
                                <input id="mdate2" type="text" class="form-control form-control-line" name="sampai_tanggal" required>
                            </div>
                      </div>
                </div>
                <div  style="margin-left: 40px;">
                <button type="submit" name ="submit" class="btn btn-success"> <i class="fa fa-check"></i> Tampilkan</button>
                </div>
            </div>
            
            </form>
        </div>
        </div>
        </div>
        </div>
                <!-- Row form END -->';
        }
    }
?>
