<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div class="row">
                        <div class="col-9">
                            <div class="card">
                                <div class="card-body">
                                    <p>'.$errQ.'</p>
                                </div>
                            </div>
                        </div>
                    </div>';
            unset($_SESSION['errQ']);
        }

    	$id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
    	$query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./admin.php?page=tsk";
                      </script>';
            } else {

    		  echo '<!-- Row form Start -->
				<div class="container-fluid">
                <div class="card m-t-20">
                    <div class="card-body">  
                         <div class="table-responsive m-t-5">
                            <table  class="table table-hover">
                                <thead id="head">
                                    <p class="text-danger"> Apakah Anda yakin akan menghapus data ini ?</p>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="13%">No. Agenda</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['no_agenda'].'</td>
                                </tr>
                                <tr>
                                    <td width="13%">Kode Klasifikasi</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['kode'].'</td>
                                </tr>
                                <tr>
                                <td width="13%">Isi Ringkas</td>
                                <td width="1%">:</td>
                                <td width="86%">'.$row['isi'].'</td>
                                </tr>
                                <tr>
                                    <td width="13%">File</td>
                                    <td width="1%">:</td>
                                    <td width="86%">';
                                    if(!empty($row['file'])){
                                        echo ' <a class="blue-text" href="?page=gsm&act=fsk&id_surat='.$row['id_surat'].'">'.$row['file'].'</a>';
                                    } else {
                                        echo ' Tidak ada file yang diupload';
                                    } echo '</td>
                                </tr>
                                <tr>
                                    <td width="13%">Tujuan</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['tujuan'].'</td>
                                </tr>
                                <tr>
                                    <td width="13%">No. Surat</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['no_surat'].'</td>
                                </tr>
                                <tr>
                                    <td width="13%">Tanggal Surat</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$tgl = date('d M Y ', strtotime($row['tgl_surat'])).'</td>
                                </tr>
                                <tr>
                                    <td width="13%">Keterangan</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['keterangan'].'</td>
                                </tr>
                                <tr>
                                    <td width="13%"></td>
                                    <td width="1%"></td>
                                    <td width="86%">
                                        <a href="?page=tsk&act=del&submit=yes&id_surat='.$row['id_surat'].'" class="btn btn-danger">HAPUS</a>
                                        <a href="?page=tsk" class="btn btn-primary">BATAL</a>
                                    </td>
                                </tr>
                            </tbody>   
                           </table>
                         </div>
                      </div>          
                </div>
                <!-- Row form END -->';

            	if(isset($_REQUEST['submit'])){
            		$id_surat = $_REQUEST['id_surat'];

                    //jika ada file akan mengekseskusi script dibawah ini
                    if(!empty($row['file'])){

                        unlink("upload/surat_keluar/".$row['file']);
                        $query = mysqli_query($config, "DELETE FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

                		if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=tsk");
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tsk&act=del&id_surat='.$id_surat.'";
                                  </script>';
                		}
                	} else {

                        //jika tidak ada file akan mengekseskusi script dibawah ini
                        $query = mysqli_query($config, "DELETE FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

                        if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=tsk");
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tsk&act=del&id_surat='.$id_surat.'";
                                  </script>';
                        }
                    }
                }
		    }
	    }
    }
}
?>
