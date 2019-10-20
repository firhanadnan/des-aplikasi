<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
        } else { ?>

    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Restore Database</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Restore</li>
                </ol>
            </div>
        </div>
<?php
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>'.$errEmpty.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    unset($_SESSION['errEmpty']);
                }
                if(isset($_SESSION['errFormat'])){
                    $errFormat = $_SESSION['errFormat'];
                    echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>'.$errFormat.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    unset($_SESSION['errFormat']);
                }
                if(isset($_SESSION['errUpload'])){
                    $errUpload = $_SESSION['errUpload'];
                    echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>'.$errUpload.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    unset($_SESSION['errUpload']);
                }
                if(isset($_SESSION['succRestore'])){
                    $succRestore = $_SESSION['succRestore'];
                    echo '<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>'.$succRestore.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    unset($_SESSION['succRestore']);
                }

                // proses restore database dilakukan oleh fungsi
                function restore($file){
                	global $rest_dir;

                    //konfigurasi database
                	$koneksi=mysqli_connect("localhost","root","","des_aplikasi");

                	$nama_file	= $file['name'];
                	$ukrn_file	= $file['size'];
                	$tmp_file	= $file['tmp_name'];

                	if($nama_file == "" || $_REQUEST['password'] == ""){
                        $_SESSION['errEmpty'] = 'ERROR! Semua Form wajib diisi';
                        header("Location: ./admin.php?page=sett&sub=rest");
                        die();
                    } else {

                        $password = $_REQUEST['password'];
                        $id_user = $_SESSION['id_user'];

                        $query = mysqli_query($koneksi, "SELECT password FROM tbl_user WHERE id_user='$id_user' AND password=MD5('$password')");
                        if(mysqli_num_rows($query) > 0){

                    		$alamatfile	= $rest_dir.$nama_file;
                    		$templine	= array();

                            $ekstensi = array('sql');
                            $nama_file	= $file['name'];
                            $x = explode('.', $nama_file);
                            $eks = strtolower(end($x));

                            //validasi tipe file
                            if(in_array($eks, $ekstensi) == true){

                        		if(move_uploaded_file($tmp_file , $alamatfile)){

                        			$templine	= '';
                        			$lines		= file($alamatfile);

                        			foreach ($lines as $line){
                        				if(substr($line, 0, 2) == '--' || $line == '')
                        					continue;

                        				$templine .= $line;

                        				if(substr(trim($line), -1, 1) == ';'){
                        					mysqli_query($koneksi, $templine);
                        					$templine = '';
                        				}
                        			}
                                    $_SESSION['succRestore'] = 'SUKSES! Database berhasil direstore';
                                    header("Location: ./admin.php?page=sett&sub=rest");
                                    die();
                        		} else {
                                    $_SESSION['errUpload'] = 'ERROR! Proses upload database gagal';
                                    header("Location: ./admin.php?page=ref&act=imp");
                                    die();
                    		    }
                            } else {
                                $_SESSION['errFormat'] = 'ERROR! Format file yang diperbolehkan hanya *.SQL';
                                header("Location: ./admin.php?page=sett&sub=rest");
                                die();
                            }
                        } else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! Password salah. Anda mungkin tidak memiliki akses ke halaman ini");
                                    window.location.href="./logout.php";
                                  </script>';
                        }
                	}
                }

                //restore database
                if(isset($_POST['restore'])){

                    restore($_FILES['file']);

                } else {
                    echo '
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-info">Restore Database</b></h4>
                                    <p class="kata">Silakan pilih file database dan masukan password saat login lalu klik tombol <strong>"Restore"</strong> untuk melakukan restore database dari hasil backup yang telah dibuat sebelumnya. Jika belum ada file database hasil backup, silakan lakukan backup terlebih dahulu melalui menu <strong><a class="blue-text" style="text-transform: capitalize;margin-right: 0;" href="?page=sett&sub=back">"Backup Database"</a>.</strong></p><br/>
                                </div>

                                <form class="form-material m-t-10" method="POST"  enctype="multipart/form-data">
                                <!-- Row in form START -->
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Input DB</label>
                                        <div class="col-md-9">
                                        <input type="file" name="file" accept=".sql" required class="form-control form-control-line" >     
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Password Account</label>
                                    <div class="col-md-8">
                                        <input id="password_lama" type="password" name="password" class="form-control form-control-line"  required> 
                                        </div>
                                    </div>
                               </div>
                            </div>
                                
                            <button style="margin-left:60px; margin-bottom:20px;" type="submit" class="btn btn-warning" name="restore">RESTORE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
?>
