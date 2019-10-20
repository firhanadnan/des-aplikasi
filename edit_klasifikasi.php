<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

                $id_klasifikasi = $_REQUEST['id_klasifikasi'];
                $kode = $_REQUEST['kode'];
                $nama = $_REQUEST['nama'];
                $uraian = $_REQUEST['uraian'];
                $id_user = $_SESSION['admin'];

                //validasi form kosong
                if($_REQUEST['kode'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['uraian'] == ""){
                    $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                    echo '<script language="javascript">
                            window.location.href="./admin.php?page=ref&act=edit&id_klasifikasi='.$id_klasifikasi.'";
                          </script>';
                } else {

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9. ]*$/", $kode)){
                    $_SESSION['kode'] = 'Form Kode hanya boleh mengandung karakter huruf, angka, spasi dan titik(.)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,\/ -]*$/", $nama)){
                        $_SESSION['namaref'] = 'Form Nama hanya boleh mengandung karakter huruf, spasi, titik(.), koma(,) dan minus(-)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,()\/\r\n -]*$/", $uraian)){
                            $_SESSION['uraian'] = 'Form Uraian hanya boleh mengandung  huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            $query = mysqli_query($config, "UPDATE tbl_klasifikasi SET kode='$kode', nama='$nama', uraian='$uraian', id_user='$id_user' WHERE id_klasifikasi='$id_klasifikasi'");

                            if($query != false){
                                $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                header("Location: ./admin.php?page=ref");
                                die();
                            } else {
                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                echo '<script language="javascript">window.history.back();</script>';
                            }
                        }
                    }
                }
            }
        } else {

            $id_klasifikasi = mysqli_real_escape_string($config, $_REQUEST['id_klasifikasi']);
            $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query))
                if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
                    echo '<script language="javascript">
                            window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                            window.location.href="./admin.php?page=ref";
                          </script>';
                } else {?>

               <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-5 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Klasifikasi Surat</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Edit Klasifikasi Surat</li>
                            </ol>
                        </div>
                    </div> 

                    <?php
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
                    ?>

  
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Klasifikasi Surat</h4>
                        <!-- Form START -->
                        <form class="form-material m-t-10" method="post" action="?page=ref&act=edit">

                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Kode</label>
                            <div class="col-md-9">
                                    <input type="hidden" value="<?php echo $row['id_klasifikasi']; ?>" name="id_klasifikasi">
                                    <input id="kd" type="text" class="form-control form-control-line" name="kode" maxlength="30" value="<?php echo $row['kode']; ?>" required>
                                        <?php
                                            if(isset($_SESSION['kode'])){
                                                $kode = $_SESSION['kode'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kode.'</div>';
                                                unset($_SESSION['kode']);
                                            }
                                        ?>
                             </div>
                        </div>       
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" class="form-control form-control-line" name="nama" value="<?php echo $row['nama']; ?>" required>
                                        <?php
                                            if(isset($_SESSION['namaref'])){
                                                $namaref = $_SESSION['namaref'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$namaref.'</div>';
                                                unset($_SESSION['namaref']);
                                            }
                                        ?>
                                </div>
                            </div>
                        </div>       
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Uraian</label>
                            <div class="col-md-9">
                                    <textarea id="uraian" class="form-control form-control-line"  name="uraian" required><?php echo $row['uraian']; ?></textarea>
                                        <?php
                                            if(isset($_SESSION['uraian'])){
                                                $uraian = $_SESSION['uraian'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$uraian.'</div>';
                                                unset($_SESSION['uraian']);
                                            }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div  style="margin-left: 40px;">
                        <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <a href="?page=ref" class="btn btn-inverse">Cancel</a>
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
        }
    }
?>
