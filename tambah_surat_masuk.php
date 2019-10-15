
<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['asal_surat'] == "" || $_REQUEST['isi'] == ""
                || $_REQUEST['kode'] == "" || $_REQUEST['indeks'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $asal_surat = $_REQUEST['asal_surat'];
                $isi = $_REQUEST['isi'];
                $kode = substr($_REQUEST['kode'],0,30);
                $nkode = trim($kode);
                $indeks = $_REQUEST['indeks'];
                $tgl_surat = $_REQUEST['tgl_surat'];
                $keterangan = $_REQUEST['keterangan'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[0-9]*$/", $no_agenda)){
                    $_SESSION['no_agenda'] = 'Form Nomor Agenda harus diisi angka!';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                        $_SESSION['no_surat'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $asal_surat)){
                            $_SESSION['asal_surat'] = 'Form Asal Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)){
                                $_SESSION['isi'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nkode)){
                                    $_SESSION['kode'] = 'Form Kode Klasifikasi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(!preg_match("/^[a-zA-Z0-9., -]*$/", $indeks)){
                                        $_SESSION['indeks'] = 'Form Indeks hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,) dan minus (-)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                            $_SESSION['tgl_surat'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                                $_SESSION['keterangan'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            } else {

                                                $cek = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE no_surat='$no_surat'");
                                                $result = mysqli_num_rows($cek);

                                                if($result > 0){
                                                    $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                } else {

                                                    $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                                    $file = $_FILES['file']['name'];
                                                    $x = explode('.', $file);
                                                    $eks = strtolower(end($x));
                                                    $ukuran = $_FILES['file']['size'];
                                                    $target_dir = "upload/surat_masuk/";

                                                    //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                                    if($file != ""){

                                                        $rand = rand(1,10000);
                                                        $nfile = $rand."-".$file;

                                                        //validasi file
                                                        if(in_array($eks, $ekstensi) == true){
                                                            if($ukuran < 2500000){

                                                                move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                                $query = mysqli_query($config, "INSERT INTO tbl_surat_masuk(no_agenda,no_surat,asal_surat,isi,kode,indeks,tgl_surat,
                                                                    tgl_diterima,file,keterangan,id_user)
                                                                        VALUES('$no_agenda','$no_surat','$asal_surat','$isi','$nkode','$indeks','$tgl_surat',NOW(),'$nfile','$keterangan','$id_user')");

                                                                if($query == true){
                                                                    $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                                    header("Location: ./admin.php?page=tsm");
                                                                    die();
                                                                } else {
                                                                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                    echo '<script language="javascript">window.history.back();</script>';
                                                                }
                                                            } else {
                                                                $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {
                                                            $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    } else {

                                                        //jika form file kosong akan mengeksekusi script dibawah ini
                                                        $query = mysqli_query($config, "INSERT INTO tbl_surat_masuk(no_agenda,no_surat,asal_surat,isi,kode,indeks,tgl_surat, tgl_diterima,keterangan,id_user)
                                                            VALUES('$no_agenda','$no_surat','$asal_surat','$isi','$nkode','$indeks','$tgl_surat',NOW(),'$keterangan','$id_user')");

                                                        if($query == true){
                                                            $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                            header("Location: ./admin.php?page=tsm");
                                                            die();
                                                        } else {
                                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {?>

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
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errQ']);
                }
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errEmpty']);
                }
            ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Input Surat Masuk</h4>
                <form class="form-material m-t-10" method="POST" action="?page=tsm&act=add" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">No Agenda</label>
                                <div class="col-md-9">
                                    <input id="no_agenda" type="number" name="no_agenda" class="form-control form-control-line" placeholder="Masukan No Agenda">
                                    <?php
                                    if(isset($_SESSION['no_agenda'])){
                                        $no_agenda = $_SESSION['no_agenda'];
                                        echo '<small id="alert-message" class="form-control-feedback has-danger">'.$no_agenda.'</small>';
                                        unset($_SESSION['no_agenda']);
                                        }
                                    ?> 
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Kode klasifikasi</label>
                                <div class="col-md-9">
                                    <select id="kode" type="text" name="kode" class="form-control form-control-line" placeholder="Masukan Kode Klasifikasi">
                                        <option value="0"> Pilih Kode Klasifikasi</option>
                                        <?php
                                            $query = "select kode, nama from tbl_klasifikasi";
                                            $hasil = mysqli_query($config,$query);
                                            while($data=mysqli_fetch_array($hasil)){
                                                echo "<option value=$data[kode]>"."$data[kode]"." $data[nama]</option>";
                                            }
                                        ?>    
                                    </select>            
                                </div>
                            </div>
                        <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Asal Surat</label>
                                <div class="col-md-9">
                                    <input id="asal_surat" type="text" name="asal_surat" class="form-control form-control-line" placeholder="Masukan Asal Surat">
                                    <?php
                                    if(isset($_SESSION['asal_surat'])){
                                        $asal_surat = $_SESSION['asal_surat'];
                                        echo '<small id="alert-message" class="form-control-feedback has-danger">'.$asal_surat.'</small>';
                                        unset($_SESSION['asal_surat']);
                                        }
                                    ?> 
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Indeks</label>
                                <div class="col-md-9">
                                    <input id="indeks" type="text" name="indeks" class="form-control form-control-line" placeholder="Masukan Indeks Surat">
                                    <?php
                                    if(isset($_SESSION['indeks'])){
                                        $indeks = $_SESSION['indeks'];
                                        echo '<small id="alert-message" class="form-control-feedback has-danger">'.$indeks.'</small>';
                                        unset($_SESSION['indeks']);
                                        }
                                    ?>            
                                </div>
                            </div>
                        <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nomor Surat</label>
                                <div class="col-md-9">
                                    <input id="no_surat" type="text" name="no_surat" class="form-control form-control-line" placeholder="Masukan No Surat">
                                    <?php
                                    if(isset($_SESSION['no_surat'])){
                                        $no_surat = $_SESSION['no_surat'];
                                        echo '<small id="alert-message" class="form-control-feedback has-danger">'.$no_surat.'</small>';
                                        unset($_SESSION['no_surat']);
                                        }
                                    ?> 
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Tanggal Surat</label>
                                <div class="col-md-9">
                                     <input type="text" class="form-control" placeholder="Pilih Tanggal" id="mdate">
                                    <?php
                                    if(isset($_SESSION['tgl_surat'])){
                                        $tgl_surat = $_SESSION['tgl_surat'];
                                        echo '<small id="alert-message" class="form-control-feedback has-danger">'.$tgl_surat.'</small>';
                                        unset($_SESSION['tgl_surat']);
                                        }
                                    ?>            
                                </div>
                            </div>
                        <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Isi Ringkas</label>
                                <div class="col-md-9">
                                    <textarea id="isi" rows="3" type="text" name="isi" class="form-control form-control-line"> </textarea>
                                    <?php
                                    if(isset($_SESSION['isi'])){
                                        $isi = $_SESSION['isi'];
                                        echo '<small id="alert-message" class="form-control-feedback has-danger">'.$isi.'</small>';
                                        unset($_SESSION['isi']);
                                        }
                                    ?> 
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Keterangan</label>
                                <div class="col-md-9">
                                    <input id="keterangan" type="text" name="keterangan" class="form-control form-control-line" placeholder="Masukan keterangan Surat">
                                    <?php
                                    if(isset($_SESSION['keterangan'])){
                                        $keterangan = $_SESSION['keterangan'];
                                        echo '<small id="alert-message" class="form-control-feedback has-danger">'.$keterangan.'</small>';
                                        unset($_SESSION['keterangan']);
                                        }
                                    ?>            
                                </div>
                            </div>
                        <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="row">
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">File Upload</label>
                                <div class="col-md-9">
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="hidden">
                                            <input type="file" name="file" id="file"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                   <?php
                                            if(isset($_SESSION['errSize'])){
                                                $errSize = $_SESSION['errSize'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errSize.'</div>';
                                                unset($_SESSION['errSize']);
                                            }
                                            if(isset($_SESSION['errFormat'])){
                                                $errFormat = $_SESSION['errFormat'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errFormat.'</div>';
                                                unset($_SESSION['errFormat']);
                                            }
                                        ?>
                                    <small class="text-danger">*Format file yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF dan ukuran maksimal file 2 MB!</small>      
                                </div>
                            </div>
                        <!--/span-->
                        </div>
                        <!--/row-->
                    </div> 
                    <div class="form-actions" style="margin-left: 40px;">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <a href="?page=tsm" class="btn btn-inverse">Cancel</a>
                    </div>                                       
                </form>
                <!-- Form END -->
            </div>
        </div>
    </div>
</div>
            <!-- Row form END --> 

<?php
        }
    }
?>
