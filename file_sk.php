<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
        $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE id_surat='$id_surat'");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_array($query)){
                echo '
                <div class="container-fluid">  
                    <div class="row page-titles">
                        <div class="col-md-5 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Detail Surat Keluar</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Detail Surat Keluar</li>
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
                                                    </tr>
                                                    <tr>
                                                    <td width="13%">Isi Ringkas</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%">'.$row['isi'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Tujuan Surat</td>
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

                                                        <td width="86%">'.$d." ".$nm." ".$y.'</td>
                                                    </tr>
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
                                echo '
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            
                                            <div class="col-md-4">
                                            
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-md-5">
                                <div class="col-md-12">
                                <img style="width:150px; margin-top: -40px;" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./upload/surat_keluar/'.$row['file'].'"/>
                                </div>
                                </div>';
                            } else {

                                if(in_array($eks, $ekstensi2) == true){
                                    echo '
                                    <div class="gbr">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="col s9 left">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <p>File lampiran surat keluar ini bertipe <strong>document</strong>, silakan klik link dibawah ini untuk melihat file lampiran tersebut.</p>
                                                        </div>
                                                        <div class="card-action">
                                                            <strong>Lihat file :</strong> <a class="blue-text" href="./upload/surat_keluar/'.$row['file'].'" target="_blank">'.$row['file'].'</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col s3 right">
                                                    <img class="file" src="./asset/img/word.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                } else {
                                    echo '
                                    <div class="gbr">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="col s9 left">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <p>File lampiran surat keluar ini bertipe <strong>PDF</strong>, silakan klik link dibawah ini untuk melihat file lampiran tersebut.</p>
                                                        </div>
                                                        <div class="card-action">
                                                            <strong>Lihat file :</strong> <a class="blue-text" href="./upload/surat_keluar/'.$row['file'].'" target="_blank">'.$row['file'].'</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col s3 right">
                                                    <img class="file" src="./asset/img/pdf.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        } echo '
                    </div>';
            }
        }
    }
?>
