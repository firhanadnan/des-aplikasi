<?php

    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_REQUEST['id_user'] == 1){
            echo '<script language="javascript">
                    window.alert("ERROR! Super Admin tidak boleh diedit");
                    window.location.href="./admin.php?page=sett&sub=usr";
                  </script>';
        } else {

            if($_REQUEST['id_user'] == $_SESSION['id_user']){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak diperbolehkan mengedit tipe akun Anda sendiri. Hubungi super admin untuk mengeditnya");
                        window.location.href="./admin.php?page=sett&sub=usr";
                      </script>';
            } else {

                if(isset($_REQUEST['submit'])){

                    $id_user = $_REQUEST['id_user'];
                    $admin = $_REQUEST['admin'];

                    if($id_user == $_SESSION['id_user']){
                        echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak boleh mengedit akun Anda sendiri. Hubungi super admin untuk mengeditnya");
                                window.location.href="./admin.php?page=sett&sub=usr";
                              </script>';
                    } else {

                        if(!preg_match("/^[2-3]*$/", $admin)){
                            $_SESSION['tipeuser'] = 'Form Tipe User hanya boleh mengandung karakter angka 2 atau 3';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            $query = mysqli_query($config, "UPDATE tbl_user SET admin='$admin' WHERE id_user='$id_user'");

                            if($query == true){
                                $_SESSION['succEdit'] = 'SUKSES! Tipe user berhasil diupdate';
                                header("Location: ./admin.php?page=sett&sub=usr");
                                die();
                            } else {
                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                echo '<script language="javascript">
                                        window.location.href="./admin.php?page=sett&sub=usr&act=edit&id_user='.$id_user.'";
                                      </script>';
                            }
                        }
                    }
                } else {

                    $id_user = mysqli_real_escape_string($config, $_REQUEST['id_user']);
                    $query = mysqli_query($config, "SELECT * FROM tbl_user WHERE id_user='$id_user'");
                    if(mysqli_num_rows($query) > 0){
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){?>

                        <!-- Row Start -->
  
                        <div class="container-fluid">
                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <div class="row page-titles">
                            <div class="col-md-5 col-8 align-self-center">
                                <h3 class="text-themecolor m-b-0 m-t-0">Edit Tipe User</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">Edit Tipe User</li>
                                </ol>
                            </div>
                        </div>

                        <?php
                            if(isset($_SESSION['errQ'])){
                                $errQ = $_SESSION['errQ'];
                                echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="text-danger">'.$errQ.'</p>
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
                <h4 class="card-title">Edit Tipe User</h4>
                    <form class="form-material m-t-10" method="POST" action="?page=tsm&act=add" enctype="multipart/form-data">
                    <!-- Row in form START -->
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Username</label>
                            <div class="col-md-9">
                                        <input type="hidden" value="<?php echo $row['id_user'] ;?>" name="id_user">
                                        <input id="username" type="text" value="<?php echo $row['username'] ;?>" readonly class="form-control form-control-line">
                            </div>
                        </div>
                    </div>       
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Nama</label>
                            <div class="col-md-9">
                                        <input id="username" type="text" value="<?php echo $row['nama'] ;?>" readonly class="form-control form-control-line">
                            </div>
                        </div>
                    </div>
                    </div>    
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Tipe User</label>
                            <div class="col-md-9">
                                <select class="form-control form-control-line" name="admin" id="admin" required>
                                    <option value="<?php echo $row['admin']; ?>">
                                        <?php
                                            if($row['admin'] == 2){
                                                echo 'Administrator';
                                            } else {
                                                echo 'User Biasa';
                                            }
                                        ?>
                                    </option>
                                    <option value="3">User Biasa</option>
                                    <option value="2">Administrator</option>
                                </select>
                                <?php
                                    if(isset($_SESSION['tipeuser'])){
                                        $tipeuser = $_SESSION['tipeuser'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tipeuser.'</div>';
                                        unset($_SESSION['tipeuser']);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    </div>
                                            
                    <div  style="margin-left: 40px;">
                        <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <a href="?page=sett&sub=usr" class="btn btn-inverse">Cancel</a>
                    </div>

                            </form>
                            <!-- Form END -->

                        </div>
                        <!-- Row form END -->
                    </div>
                </div>
            </div>


<?php
                        }
                    }
                }
            }
        }
    }
?>
