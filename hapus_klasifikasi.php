<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        $id_klasifikasi = mysqli_real_escape_string($config, $_REQUEST['id_klasifikasi']);
        $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./admin.php?page=ref";
                      </script>';
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

    	  echo '
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
        			                    <td width="13%">Kode</td>
        			                    <td width="1%">:</td>
        			                    <td width="86%">'.$row['kode'].'</td>
        			                </tr>
        			                <tr>
        			                    <td width="13%">Nama</td>
        			                    <td width="1%">:</td>
        			                    <td width="86%">'.$row['nama'].'</td>
        			                </tr>
        			                <tr>
        			                    <td width="13%">Uraian</td>
        			                    <td width="1%">:</td>
        			                    <td width="86%">'.$row['uraian'].'</td>
        			                </tr>
                                    <tr>
                                    <td width="13%"></td>
                                    <td width="1%"></td>
                                    <td width="86%">
                                        <a href="?page=ref&act=del&submit=yes&id_klasifikasi='.$row['id_klasifikasi'].'" class="btn btn-danger">HAPUS</a>
                                        <a href="?page=ref" class="btn btn-primary">BATAL</a>
                                    </td>
                                </tr>
        			            </tbody>
        			   		</table>
                            </div>
                        </div>   
    			        </div>
                        
            <!-- Row form END -->';

        	if(isset($_REQUEST['submit'])){
        		$id_klasifikasi = $_REQUEST['id_klasifikasi'];

                $query = mysqli_query($config, "DELETE FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");

            	if($query == true){
                    $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                    header("Location: ./admin.php?page=ref");
                    die();
            	} else {
                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                    echo '<script language="javascript">
                            window.location.href="./admin.php?page=ref&act=del&id_klasifikasi='.$id_klasifikasi.'";
                          </script>';
            	}
            }
	    }
    }
}
}
?>
