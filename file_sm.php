<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
        $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_array($query)){
                echo '
            <div class="container-fluid">  
                    <div class="row page-titles">
                        <div class="col-md-5 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Detail Surat Masuk</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Detail Surat Masuk</li>
                            </ol>
                        </div>
                    </div>
                <div class="card m-t-5">
                    <div class="card-body">  
                         <div class="table-responsive m-t-3">
                                            <table>
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
                                                    <td width="13%">Indeks Berkas</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%">'.$row['indeks'].'</td>
                                                    </tr>
                                                    <tr>
                                                    <td width="13%">Isi Ringkas</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%">'.$row['isi'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Asal Surat</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['asal_surat'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">No. Surat</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['no_surat'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Tanggal Surat</td>
                                                        <td width="1%">:</td>';
                                                        
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

                                                        <td width="86%">'.$d." ".$nm." ".$y.'</td>                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Keterangan</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['keterangan'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Detail File</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%"><a class="blue-text" href="./upload/surat_masuk/'.$row['file'].'" target="_blank">'.$row['file'].'</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <button onclick="window.history.back()" class="btn btn-info">KEMBALI</button>';

                        if(empty($row['file'])){
                            echo '';
                        } else {

                            $ekstensi = array('jpg','png','jpeg');
                            $ekstensi2 = array('doc','docx');
                            $file = $row['file'];
                            $x = explode('.', $file);
                            $eks = strtolower(end($x));

                            if(in_array($eks, $ekstensi) == true){
                                echo '<img class="gbr" data-caption="'.date('d M Y', strtotime($row['tgl_diterima'])).'" src="./upload/surat_masuk/'.$row['file'].'"/>';
                            } else {

                                if(in_array($eks, $ekstensi2) == true){
                                    echo '
                                    ';
                                } else {
                                    echo '
                                    ';
                                }
                            }
                        } echo '
                    </div>';
            }
        }
    }
?>
