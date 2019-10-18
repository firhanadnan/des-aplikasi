<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
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
                <h3 class="text-themecolor m-b-0 m-t-0">Backup Database</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Backup</li>
                </ol>
            </div>
        </div>
        <?php
                // download file hasil backup
                if(isset($_REQUEST['nama_file'])){

                    $back_dir = "./";
                	$file = $back_dir.$_REQUEST['nama_file'];

                    $x = explode('.', $file);
                    $eks = strtolower(end($x));

                    if($eks == 'sql'){

                    	if(file_exists($file)){
                    		header('Content-Description: File Transfer');
                    		header('Content-Type: application/octet-stream');
                    		header('Content-Disposition: attachment; filename='.($file));
                    		header('Content-Transfer-Encoding: binary');
                    		header('Expires: 0');
                    		header('Cache-Control: private');
                    		header('Pragma: private');
                    		header('Content-Length: ' . filesize($file));
                    		ob_clean();
                    		flush();
                    		readfile($file);
                    		exit;
                    	} else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! File sudah tidak ada");
                                    window.location.href="./admin.php?page=sett&sub=back";
                                  </script>';
                        }
                    } else {
                        if($_SESSION['id_user'] == 1){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Format file yang boleh didownload hanya *.SQL");
                                    window.location.href="./logout.php";
                                  </script>';
                        }
                    }
                }

                // proses backup  database dilakukan oleh Fungsi
                function backup($host,$user,$pass,$name,$nama_file,$tables){

                    //untuk koneksi database
                    $return = "";
                    $link = mysqli_connect($host,$user,$pass,$name);

                    //backup semua tabel database
                    if($tables == '*'){
                        $tables = array();
                        $result = mysqli_query($link, 'SHOW TABLES');
                        while($row = mysqli_fetch_row($result)){
                            $tables[] = $row[0];
                        }
                    } else {

                        //backup tabel tertentu
                        $tables = is_array($tables) ? $tables : explode(',',$tables);
                    }

                    //looping table
                    foreach($tables as $table){
                        $result = mysqli_query($link, 'SELECT * FROM '.$table);
                        $num_fields = mysqli_num_fields($result);

                        $return.= 'DROP TABLE '.$table.';';
                        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
                        $return.= "\n\n".$row2[1].";\n\n";

                        //looping field table
                        for($i = 0; $i < $num_fields; $i++){
                            while($row = mysqli_fetch_row($result)){
                                $return.= 'INSERT INTO '.$table.' VALUES(';

                                for($j=0; $j<$num_fields; $j++){
                                    $row[$j] = addslashes($row[$j]);
                                    //$row[$j] = ereg_replace("\n","\\n",$row[$j]);

                                    if(isset($row[$j])){
                                        $return.= '"'.$row[$j].'"' ;
                                    } else {
                                        $return.= '""';
                                    }
                                    if ($j<($num_fields-1)){
                                        $return.= ',';
                                    }
                                }
                                $return.= ");\n";
                            }
                        }
                        $return.="\n\n\n";
                    }

                    //otomatis menyimpan hasil backup database dalam root folder aplikasi
                    $nama_file;
                    $handle = fopen($nama_file,'w+');
                    fwrite($handle,$return);
                    fclose($handle);
                }

                //nama database hasil backup
                $database = 'Backup';
                $file = $database.'_'.date("d_M_Y").'_'.time().'.sql';

                //backup database
                if(isset($_REQUEST['backup'])){

                    //konfigurasi database dan backup semua tabel
                    backup("localhost","root","","des_aplikasi",$file,"*");

                    //backup hanya tabel tertentu
                    //backup("localhost","user_database","pass_database","nama_database",$file,"tabel1,tabel2,tabel3");

                  echo '<!-- Row form Start -->
                                      <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-info"><b>SUKSES! Database berhasil dibackup</b></h4>
                                    <p class="kata">Silakan klik tombol <strong>"Download"</strong> dibawah ini untuk mendownload file backup database.</p>

                                </div>
                                <div class="card-action">
                                    <form method="post" enctype="multipart/form-data" >
                                        <a href="?page=sett&sub=back&nama_file='.$file.'" style="margin-left:20px; margin-bottom:20px;" class="btn btn-lg btn-warning">DOWNLOAD</a>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        ';
                } else {

                    echo '
                    <!-- Row form Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><b>Backup Database</b></h4>
                                    <p class="kata">Silakan klik tombol <strong>"Backup"</strong> untuk memulai proses backup data. Setelah proses backup selesai, silakan download file backup database tersebut dan simpan di lokasi yang aman.<span class="text-danger"><strong>*</strong></span></p>

                                </div>
                                <div class="card-action">
                                    <form method="post" enctype="multipart/form-data" >
                                        <button style="margin-left:20px; margin-bottom:20px;" type="submit" class="btn btn-lg btn-warning" name="backup">BACKUP</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
?>
