<?= $this->extend('template/dashboard-user') ?>
<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <?php foreach ($judul as $jdl) : ?>
        <div class="row">   
            <!-- Penelitian -->
            <div class="col-xl-8 col-md-6 mt-4">
                <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
            </div>
            <div class="col-xl-10 col-md-6 mt-4">
                <h5 class="h6 mb-0 text-gray-800"><?= $jdl['judul'] ?></h5>
                <hr/>
            </div>
        </div>
    
    <?php endforeach; ?>

    <?php
        site_url(uri_string());
        $db = \Config\Database::connect();
        // Defining variables
        $nidn = $nama = $peran = $rumpunIlmu = $prodi = $tugas = 
        $nidnVokasi = $namaVokasi = $peranVokasi = $rumpunIlmuVokasi = 
        $prodiVokasi = $tugasVokasi =
        $nidnMahasiswa = $namaMahasiswa = $peranMahasiswa = 
        $instansiMahasiswa = $prodiMahasiswa = $mataKuliah = $sks = $tugasVokasi =
        $tahunLuaran = $kelompokLuaran = $jenisLuaran = $targetLuaran = 
        $keteranganLuaran = $kelompokRAB = $komponenRAB =
        $namaMitra = $jenisMitra = $kelompokMitra = 
        $dana1Mitra = $dana2Mitra = $dana3Mitra =
        $fileMitra = $itemRAB = $tahunRAB = null;   
        
        $hargaRAB = $volumeRAB = $danaRencanaRAB = 
        $dana1Mitra = $dana2Mitra = $dana3Mitra = 0;
 
        // Checking for a POST request
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $fungsi = input_data($_POST["fungsi"]);
          switch($fungsi){
            case 'dosen': //Get Var Dosen
                $nidn = input_data($_POST["nidn"]);
                $nama = input_data($_POST["nama"]);
                $peran = input_data($_POST["peran"]);
                $rumpunIlmu = input_data($_POST["rumpunIlmu"]);
                $prodi = input_data($_POST["prodi"]);
                $tugas = input_data($_POST["tugas"]);
            break;          
            case 'vokasi': //Get Var Vokasi
                $nidnVokasi = input_data($_POST["nidnVokasi"]);
                $namaVokasi = input_data($_POST["namaVokasi"]);
                $peranVokasi = input_data($_POST["peranVokasi"]);
                $rumpunIlmuVokasi = input_data($_POST["rumpunIlmuVokasi"]);
                $prodiVokasi = input_data($_POST["prodiVokasi"]);
                $tugasVokasi = input_data($_POST["tugasVokasi"]);
            break;
            case 'mahasiswa': //Get Var Vokasi
                $nidnMahasiswa = input_data($_POST["nidnMahasiswa"]);
                $namaMahasiswa = input_data($_POST["namaMahasiswa"]);
                $peranMahasiswa = input_data($_POST["peranMahasiswa"]);
                $instansiMahasiswa = input_data($_POST["instansiMahasiswa"]);
                $prodiMahasiswa = input_data($_POST["prodiMahasiswa"]);
                $mataKuliah = input_data($_POST["mataKuliah"]);
                $sks = input_data($_POST["sks"]);
                if ($sks==""){$sks=0;}
                $tugasMahasiswa = input_data($_POST["tugasMahasiswa"]);
            break;
            case "substansi":
                $jenisSubstansi = input_data($_POST["jenisSubstansi"]); 
                $fileSubstansi = input_data($_FILES["fileSubstansi"]["name"]);                
                if ($fileSubstansi) {
                    $path = "file/".basename($fileSubstansi);
                    $renFile = "PBSub".date("Ymd")."_".$id.'_'.$dosen_id.".".
                    strtolower(pathinfo($path,PATHINFO_EXTENSION));
                    move_uploaded_file($_FILES["fileSubstansi"]["tmp_name"], "file/".$renFile);
                } else { $renFile=null; }
            break;
            case 'luaran': //Get Var Vokasi
                    $tahunLuaran = input_data($_POST["tahunLuaran"]);
                    if ($tahunLuaran==""){$tahunLuaran=0;}
                    $kelompokLuaran = input_data($_POST["kelompokLuaran"]);
                    $jenisLuaran = input_data($_POST["jenisLuaran"]);
                    $targetLuaran = input_data($_POST["targetLuaran"]);
                    $keteranganLuaran = input_data($_POST["keteranganLuaran"]);
            break;
            case 'iku': //Get Var Vokasi
                    $indikatorIKU = input_data($_POST["indikatorIKU"]);
                    $uraianIKU = input_data($_POST["uraianIKU"]);
                    $kegiatanIKU = input_data($_POST["kegiatanIKU"]);
            break;
            case 'sdgs': //Get Var Vokasi
                    $SDGs = input_data($_POST["sdgs"]);
                    $kegiatanSDGs = input_data($_POST["kegiatanSDGs"]);
            break;
            case 'rab' :
                $tahunRAB =  input_data($_POST["tahunRAB"]);                
                $kelompokRAB = input_data($_POST["kelompokRAB"]);                
                $komponenRAB = input_data($_POST["komponenRAB"]);                
                $itemRAB = input_data($_POST["itemRAB"]);                
                $satuanRAB = input_data($_POST["satuanRAB"]);                
                $hargaRAB = input_data($_POST["hargaRAB"]);                
                $volumeRAB = input_data($_POST["volumeRAB"]);              
                $urlRAB = input_data($_POST["urlHPS"]);              

                if ($hargaRAB==""){$hargaRAB=0;}
                if ($volumeRAB==""){$volumeRAB=0;} 
                $totalRAB = $hargaRAB * $volumeRAB;
            break;                
            case "tahun rab":                    
                        $sql = "SELECT * FROM rab_pb WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;  
                        $tahunRAB = $db->query($sql)->getNumRows() + 1;        
                        //dd($tahunRAB);
            break;
            case "mitra":
                    $namaMitra =  input_data($_POST["namaMitra"]);
                    $jenisMitra =  input_data($_POST["jenisMitra"]);
                    $kelompokMitra =  input_data($_POST["kelompokMitra"]);
                    $dana1Mitra =  input_data($_POST["dana1Mitra"]);
                    $dana2Mitra =  input_data($_POST["dana2Mitra"]);
                    $dana3Mitra =  input_data($_POST["dana3Mitra"]);

                    if($dana1Mitra=="") {$dana1Mitra=0;}
                    if($dana2Mitra=="") {$dana2Mitra=0;}
                    if($dana3Mitra=="") {$dana3Mitra=0;}
            break;
            case "file_mitra" :
                    $sql = "SELECT * FROM mitra_file_pb";
                    $fileNumber = $db->query($sql)->getNumRows() + 1;
                    $fileMitra = input_data($_FILES["fileMitra"]["name"]);                
                    if ($fileMitra) {
                        $path = "file/".basename($fileMitra);
                        $renFileMitra = "PBMit".date("Ymd")."_".$id.'_'.$dosen_id."_".$fileNumber.".".
                                    strtolower(pathinfo($path,PATHINFO_EXTENSION));                                    
                    move_uploaded_file($_FILES["fileMitra"]["tmp_name"], "file/".$renFileMitra);
                    } else { $renFileMitra=null; }    
            break;
            case "pendukung" :
                $sql = "SELECT * FROM pendukung WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id.'' ;
                $fileNumber = $db->query($sql)->getNumRows() + 1;
                $filePendukung = input_data($_FILES["filePendukung"]["name"]);                
                $jenisPendukung =  input_data($_POST["jenisPendukung"]);
                if ($filePendukung) {
                    $path = "file/".basename($filePendukung);
                    $renFilePendukung = "PBPend".date("Ymd")."_".$id.'_'.$dosen_id."_".$fileNumber.".".
                                strtolower(pathinfo($path,PATHINFO_EXTENSION));                                    
                move_uploaded_file($_FILES["filePendukung"]["tmp_name"], "file/".$renFilePendukung);
                } else { $renFilePendukung=null; }    
            break;
          }

          switch ($fungsi){
              case 'dosen':
                  $sql = 'INSERT INTO anggota_dosen_pb (pengabdian_id,dosen_id,nidn,nama,peran,rumpun_ilmu,prodi,tugas) '. 
                        'VALUES ('.$id.','.$dosen_id.',"'.$nidn.'","'.$nama.'","'.$peran.'","'.$rumpunIlmu.'","'.$prodi.'","'.$tugas.'")';                
               break;
               case 'vokasi':
                $sql = 'INSERT INTO anggota_vokasi (pengabdian_id,dosen_id,nidn,nama,peran,rumpun_ilmu,prodi,tugas) '. 
                'VALUES ('.$id.','.$dosen_id.',"'.$nidnVokasi.'","'.$namaVokasi.'","'.$peranVokasi.'","'.$rumpunIlmuVokasi.'","'.$prodiVokasi.'","'.$tugasVokasi.'")';                
               break;
               case 'mahasiswa':
                $sql = 'INSERT INTO anggota_mahasiswa (pengabdian_id,dosen_id,nidn,nama,peran,instansi,prodi,mata_kuliah,sks,tugas) '. 
                'VALUES ('.$id.','.$dosen_id.',"'.$nidnMahasiswa.'","'.$namaMahasiswa.'","'.$peranMahasiswa.'","'.$instansiMahasiswa.'","'.$prodiMahasiswa.'","'.$mataKuliah.'",'.$sks.',"'.$tugasMahasiswa.'")';                
               break;
               case 'substansi':
                   $sql = 'INSERT INTO substansi_pb (pengabdian_id,dosen_id,jenis,file_) '. 
                        'VALUES ('.$id.','.$dosen_id.',"'.$jenisSubstansi.'","'.$renFile.'")';
               break;
               case 'luaran':
                   $sql = 'INSERT INTO luaran_pb (pengabdian_id,dosen_id,tahun,kelompok,jenis,target_,keterangan) '. 
                        'VALUES ('.$id.','.$dosen_id.','.$tahunLuaran.',"'.$kelompokLuaran.'","'.$jenisLuaran.'","'.$targetLuaran.'","'.$keteranganLuaran.'")';
               break;
               case 'iku':
                $sql = 'INSERT INTO iku (pengabdian_id,dosen_id,indikator,uraian,kegiatan) '. 
                'VALUES ('.$id.','.$dosen_id.',"'.$indikatorIKU.'","'.$uraianIKU.'","'.$kegiatanIKU.'")';                
               break;
               case 'sdgs':
                $sql = 'INSERT INTO sdgs (pengabdian_id,dosen_id,sdgs,kegiatan) '. 
                'VALUES ('.$id.','.$dosen_id.',"'.$SDGs.'","'.$kegiatanSDGs.'")';                
               break;
               case 'rab':
                   $sql = 'INSERT INTO rab_detail_pb (rab_id,rab_kelompok_id,rab_komponen_id,item,rab_satuan_id,harga,volume,total,url_) '. 
                        'VALUES ('.$tahunRAB.','.$kelompokRAB.','.$komponenRAB.',"'.$itemRAB.'",'.$satuanRAB.','.$hargaRAB.','.$volumeRAB.','.$totalRAB.',"'.$urlRAB.'")';
                    $db->query($sql); 

                    $sql = "SELECT SUM(rd.total) as total FROM rab_pb r 
                    INNER JOIN rab_detail_pb rd ON r.id = rd.rab_id 
                    WHERE r.dosen_id=".$dosen_id." AND r.pengabdian_id=".$id;  
                    $query = $db->query($sql)->getResultArray();
                    $idx=1;
                    foreach ($query as $qry) :
                        if ($idx==1) :
                            $danaRencanaRAB = $qry['total'];
                        endif;
                    endforeach;
                    $sql = "UPDATE rab_pb SET dana_direncanakan = ".$danaRencanaRAB." WHERE pengabdian_id=".$id." AND dosen_id=".$dosen_id;                
               break;
               case 'tahun rab':
                   $sql = 'INSERT INTO rab_pb (pengabdian_id,dosen_id,tahun,dana_direncanakan) '. 
                        'VALUES ('.$id.','.$dosen_id.','.$tahunRAB.','.$danaRencanaRAB.')';
               break;
               case "mitra":
                    $sql = 'INSERT INTO mitra_pb (pengabdian_id,dosen_id,nama,kelompok,jenis,dana_tahun_1,dana_tahun_2,dana_tahun_3) '. 
                    'VALUES ('.$id.','.$dosen_id.',"'.$namaMitra.'","'.$kelompokMitra.'","'.$jenisMitra.'",'.$dana1Mitra.
                    ','.$dana2Mitra.','.$dana3Mitra.')';
               break;
               case "file_mitra" :
                    $sql = "SELECT * FROM mitra_pb";
                    $query = $db->query($sql)->getResultArray();
                    foreach ($query as $data) :
                        $mitraID = $data['id'];
                    endforeach;
                    $sql = 'INSERT INTO mitra_file_pb (mitra_pb_id,file_mitra) '.
                            'VALUES ('.$mitraID.',"'.$renFileMitra.'")';
                break;
                case "pendukung":
                    $sql = 'INSERT INTO pendukung (pengabdian_id,dosen_id,jenis,file_) '. 
                    'VALUES ('.$id.','.$dosen_id.',"'.$jenisPendukung.'","'.$renFilePendukung.'")';
               break;
            }
            //dd($sql);
            $db->query($sql);                        
        } 
                
        $sql = "SELECT * FROM anggota_dosen_pb WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;  
        ${'anggota_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM anggota_vokasi WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;
        ${'vokasi_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM anggota_mahasiswa WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;
        ${'mahasiswa_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM substansi_pb WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;                
        ${'substansi_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM luaran_pb WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;                
        ${'luaran_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM iku WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;
        ${'iku_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM sdgs WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;
        ${'sdgs_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM rab_pb r INNER JOIN rab_detail_pb rd ON r.id=rd.rab_id WHERE r.dosen_id=".$dosen_id." AND r.pengabdian_id=".$id.'' ;                
        ${'rab_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM mitra_pb WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id.'' ;                
        ${'mitra_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM pendukung WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id.'' ;                
        ${'pendukung_'.$id} = $db->query($sql)->getResultArray();
        
 
        // Removing the redundant HTML characters if any exist.
        function input_data($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
    ?>    

    <!-- Table Anggota -->
    <div class="h4 font-weight-bold">Daftar Anggota Dosen<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('dosen')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox" hidden>        
        <div class="col-md-3"><input name="nidn" type="text" class="form-control" placeholder="NIDN ...." onkeypress="return numOnly(event);" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-4"><input name="nama" type="text" class="form-control" placeholder="Nama ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-4">           
            <select class="form-control" name="peran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Anggota Pengusul">Anggota Pengusul</option>
            </select>
        </div>
        <div class="col-md-3 mt-2">           
            <select class="form-control" name="rumpunIlmu" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Ilmu Kesehatan Umum">Ilmu Kesehatan Umum</option>
            </select>
        </div>
        <div class="col-md-2 mt-2">           
            <select class="form-control" name="prodi" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Ners">Ners</option>
                <option value="Pofesi Ners">Pofesi Ners</option>
            </select>
        </div>
        <div class="col-md-12 mt-2"><textarea class="form-control" name="tugas" rows="4" placeholder="Tugas ....." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="dosen">Submit</button>
    </form>

    <?php if (${'anggota_'.$id}){?>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="50px">NIDN</th>
                    <th scope="col" width="200px">Nama</th>
                    <th scope="col" width="100px">Peran</th>
                    <th scope="col" width="200px">Rumpun Ilmu</th>
                    <th scope="col" width="100px">Prodi</th>
                    <th scope="col" width="200px">Tugas</th>
                    <th scope="col" width="80px">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach (${'anggota_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['nidn'] ? $data['nidn'] : '-' ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                    <td><?= $data['peran'] ? $data['peran'] : '-' ?></td>
                    <td><?= $data['rumpun_ilmu'] ? $data['rumpun_ilmu'] : '-' ?></td>
                    <td><?= $data['prodi'] ? $data['prodi'] : '-' ?></td>
                    <td><?= $data['tugas'] ? $data['tugas'] : '-' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-primary text-white small">usulan</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-success text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>
                    <td>
                        <a href="/deletepb/anggotaDosen/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <hr/>
    <?php } ?>
    <!-- End Table Anggota -->

    <!-- Table Anggota Vokasi -->
    <div class="h4 font-weight-bold mt-3">Daftar Anggota Vokasi<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('vokasi')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox_vokasi" hidden>        
    <div class="col-md-3"><input name="nidnVokasi" type="text" class="form-control" placeholder="NIDN ...." onkeypress="return numOnly(event);" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-4"><input name="namaVokasi" type="text" class="form-control" placeholder="Nama ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-4">           
            <select class="form-control" name="peranVokasi" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Anggota Pengusul">Anggota Pengusul</option>
            </select>
        </div>
        <div class="col-md-4 mt-2">           
            <select class="form-control" name="rumpunIlmuVokasi" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Ilmu Keperawatan dan Kebidanan">Ilmu Keperawatan dan Kebidanan</option>
            </select>
        </div>
        <div class="col-md-3 mt-2">           
            <select class="form-control" name="prodiVokasi" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Keperawatan">Keperawatan</option>
            </select>
        </div>
        <div class="col-md-12 mt-2"><textarea class="form-control" name="tugasVokasi" rows="4" placeholder="Tugas ....." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="vokasi">Submit</button>
    </form>

    <?php if (${'vokasi_'.$id}){?>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="50px">NIDN</th>
                    <th scope="col" width="200px">Nama</th>
                    <th scope="col" width="100px">Peran</th>
                    <th scope="col" width="200px">Rumpun Ilmu</th>
                    <th scope="col" width="100px">Prodi</th>
                    <th scope="col" width="200px">Tugas</th>
                    <th scope="col" width="80px">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach (${'vokasi_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['nidn'] ? $data['nidn'] : '-' ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                    <td><?= $data['peran'] ? $data['peran'] : '-' ?></td>
                    <td><?= $data['rumpun_ilmu'] ? $data['rumpun_ilmu'] : '-' ?></td>
                    <td><?= $data['prodi'] ? $data['prodi'] : '-' ?></td>
                    <td><?= $data['tugas'] ? $data['tugas'] : '-' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-primary text-white small">usulan</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-success text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>
                    <td>
                        <a href="/deletepb/anggotaVokasi/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <!-- End Table Anggota Vokasi -->

    <!-- Table Anggota Mahasiswa -->
    <div class="h4 font-weight-bold mt-3">Daftar Anggota Mahasiswa<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('mahasiswa')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox_mahasiswa" hidden>        
        <div class="col-md-3"><input name="nidnMahasiswa" type="text" class="form-control" placeholder="NIDN ...." onkeypress="return numOnly(event);" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-4"><input name="namaMahasiswa" type="text" class="form-control" placeholder="Nama ....."  onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-5">           
            <select class="form-control" name="instansiMahasiswa" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Sekolah Tinggi Ilmu Keperawatan PPNI Jawa Barat">Sekolah Tinggi Ilmu Keperawatan PPNI Jawa Barat</option>
            </select>
        </div>
        <div class="col-md-2 mt-2">           
            <select class="form-control" name="peranMahasiswa" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Mahasiswa">Mahasiswa</option>
            </select>
        </div>
        <div class="col-md-3 mt-2">           
            <select class="form-control" name="prodiMahasiswa" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Keperawatan">Keperawatan</option>
            </select>
        </div>
        <div class="col-md-5 mt-2">           
            <select class="form-control" name="mataKuliah" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Keperawatan Agregat Komunitas">Keperawatan Agregat Komunitas</option>
            </select>
        </div>
        <div class="col-md-3 mt-2"><input name="sks" type="text" class="form-control" onkeypress="return numOnly(event);" placeholder="SKS ...." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-12 mt-2"><textarea class="form-control" name="tugasMahasiswa" rows="4" placeholder="Tugas ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="mahasiswa">Submit</button>
    </form>

    <?php if (${'mahasiswa_'.$id}){?>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="50px">NIDN</th>
                    <th scope="col" width="200px">Nama</th>
                    <th scope="col" width="100px">Peran</th>
                    <th scope="col" width="100px">Instansi</th>
                    <th scope="col" width="100px">Prodi</th>
                    <th scope="col" width="80px">Mata Kuliah</th>
                    <th scope="col" width="10px">SKS</th>
                    <th scope="col" width="250px">Tugas</th>
                    <th scope="col" width="50px">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach (${'mahasiswa_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['nidn'] ? $data['nidn'] : '-' ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                    <td><?= $data['peran'] ? $data['peran'] : '-' ?></td>
                    <td><?= $data['instansi'] ? $data['instansi'] : '-' ?></td>
                    <td><?= $data['prodi'] ? $data['prodi'] : '-' ?></td>
                    <td><?= $data['mata_kuliah'] ? $data['mata_kuliah'] : '-' ?></td>
                    <td><?= $data['sks'] ? $data['sks'] : '-' ?></td>
                    <td><?= $data['tugas'] ? $data['tugas'] : '-' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-primary text-white small">usulan</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-success text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>
                    <td>
                        <a href="/deletepb/anggotaMahasiswa/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <!-- End Table Anggota Mahasiswa -->

   <!-- Table Substansi -->
   <div class="h4 font-weight-bold">Daftar Substansi <img src="<?= base_url() ?>/icon/add.png" onclick="showForm('substansi_pb')"/></div>
    <hr/>
    <form method="post" enctype="multipart/form-data" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="formBox_substansi_pb" hidden>        
        <div  class="row g-3">
            <div class="col-md-4"><input name="jenisSubstansi" type="text" class="form-control" placeholder="Jenis ...." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
            <div class="col-md-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="fileSubstansi">
                    <label class="custom-file-label" for="fileSubstansi">Upload File Substansi</label>
                </div>
            </div>
        </div>
        <hr/>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="substansi">Submit</button>
    </form>

    <?php if (${'substansi_'.$id}){
        ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="50px" style="text-align: center">#</th>
                    <th scope="col" width="250px">Jenis</th>
                    <th scope="col" width="150px">File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach (${'substansi_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td><?= $data['file_'] ?'<a href="'. 
                    base_url().'/FileController/download/'.$data['file_'].'">
                    <button class="btn btn-sm btn-danger">
                    <i class="fa fa-file-pdf"></i>Download</button></a>' : '-' ?></td>
                    <td>
                        <a href="/deletepb/substansi/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Substansi">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <hr/>
    <?php } ?>
    <!-- End Table Substansi -->

    <!-- Table Luaran -->
    <div class="h4 font-weight-bold">Daftar Luaran yang Dijanjikan<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('luaran')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox_luaran" hidden>        
        <div class="col-md-2"><input name="tahunLuaran" type="text" class="form-control" placeholder="Urutan Tahun ...." onkeypress="return numOnly(event);" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-10">           
            <select class="form-control" name="kelompokLuaran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Peningkatan Level Keberdayaan Mitra: Aspek Sosial Kemasyarakatan">Peningkatan Level Keberdayaan Mitra: Aspek Sosial Kemasyarakatan</option>
                <option value="Artikel Ilmiah">Artikel Ilmiah</option>
                <option value="Rekognisi SKS Mahasiswa">Rekognisi SKS Mahasiswa</option>
                <option value="Publikasi berita pada media massa">Publikasi berita pada media massa</option>
                <option value="Karya Audio visual">Karya Audio Visual</option>
                <option value="Karya Visual">Karya Visual</option>
            </select>
        </div>
        <div class="col-md-8 mt-2">           
            <select class="form-control" name="jenisLuaran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Peningkatan Keterampilan">Peningkatan Keterampilan</option>
                <option value="Artikel ilmiah pada jurnal terindeks SINTA">Artikel ilmiah pada jurnal terindeks SINTA</option>
                <option value="Rekognisi Mmahasiswa Menjadi Bagian MBKM Mminimal 6 (enam) SKS">Rekognisi Mahasiswa Menjadi Bagian MBKM Mminimal 6 (enam) SKS</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Video Kegiatan">Video Kegiatan</option>
                <option value="Poster">Poster</option>
            </select>
        </div>
        <div class="col-md-4 mt-2">           
            <select class="form-control" name="targetLuaran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Tercapai">Tercapai</option>
                <option value="Published">Published</option>
                <option value="Terbit">Terbit</option>
                <option value="Unggah di Laman Youtube Lembaga">Unggah di Laman Youtube Lembaga</option>
            </select>
        </div>
        <div class="col-md-12 mt-2"><textarea class="form-control" name="keteranganLuaran" rows="4" placeholder="Keterangan Luaran ....." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="luaran">Submit</button>
    </form>

    <?php if (${'luaran_'.$id}){?>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="80px">Tahun Kegiatan</th>
                    <th scope="col" width="200px">Kelompok</th>
                    <th scope="col" width="100px">Jenis</th>
                    <th scope="col" width="80px">Target</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach (${'luaran_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['tahun'] ? $data['tahun'] : '-' ?></td>
                    <td><?= $data['kelompok'] ? $data['kelompok'] : '-' ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td><?= $data['target_'] ? $data['target_'] : '-' ?></td>
                    <td><?= $data['keterangan'] ? $data['keterangan'] : '-' ?></td>
                    <td>
                        <a href="/deletepb/luaran/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <hr/>
    <?php } ?>
    <!-- End Table Luaran -->

    <!-- Table Mitra -->
    <div class="h4 font-weight-bold mt-3">Daftar Mitra<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('mitra')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox_mitra" hidden>        
        <div class="col-md-12 mt-2"><textarea class="form-control" name="namaMitra" rows="2" placeholder="Nama Mitra ....."  onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
        <div class="col-md-4 mt-2">           
            <select class="form-control" name="jenisMitra" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Sasaran">Sasaran</option>
            </select>
        </div>
        <div class="col-md-8 mt-2">           
            <select class="form-control" name="kelompokMitra" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Kelompok masyarakat yang tidak produktif secara ekonomi">Kelompok masyarakat yang tidak produktif secara ekonomi</option>
            </select>
        </div>
        <div class="col-md-4 mt-2"><input type="text" name="dana1Mitra" class="form-control" placeholder="Masukkan Dana Tahun 1  ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);"></div>
        <div class="col-md-4 mt-2"><input type="text" name="dana2Mitra" class="form-control" placeholder="Masukkan Dana Tahun 2  ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);"></div>
        <div class="col-md-4 mt-2"><input type="text" name="dana3Mitra" class="form-control" placeholder="Masukkan Dana Tahun 3  ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);"></div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="mitra">Submit</button>
    </form>

    <?php 
        $mitra = $db->query('SELECT * FROM mitra_pb WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$id)->getResultArray(); 
        if ($mitra) :
    ?>    
    <div class="col-6">
        <select id="mitraSelect" class="form-control" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onchange="insertValue('mitra')">
            <option value="">Pilih Mitra</option>
            <?php
            $mitraCombo = $db->query('SELECT * FROM mitra_pb WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$id)->getResultArray(); 
            foreach ($mitraCombo as $data) :
                ?>
            <option value="<?= $data['id'] ?>"> <?= $data['nama']; ?></option>
            <?php endforeach; ?>
        </select>
        <div id="tambahFile" onclick="showForm('file_mitra')" class="btn btn-sm btn-danger shadow-sm mt-2" hidden><i class="fas fa-plus fa-sm text-white-50"></i> Tambah File</div>
    </div>
<?php endif; ?>

    <form method="post" enctype="multipart/form-data" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="formBox_file_mitra" hidden>        
        <div  class="row g-3">
            <div class="col-md-6 mt-2 mb-2">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="fileMitra">
                    <label class="custom-file-label" for="fileMitra">Upload File</label>
                </div>
            </div>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="file_mitra">Submit</button>
    </form>


    <?php if (${'mitra_'.$id}){?>
    
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="120px">Nama Mitra</th>
                    <th scope="col" width="150px">Jenis Mitra</th>
                    <th scope="col" width="250px">Kelompok Mitra</th>
                    <th scope="col" width="100px">Dana Tahun 1</th>
                    <th scope="col" width="100px">Dana Tahun 2</th>
                    <th scope="col" width="150px">Dana Tahun 3</th>
                    <th scope="col" width="80px">File</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <?php
                    $index = 1;
                    foreach (${'mitra_'.$id} as $data) :                        
                    ?>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td><?= $data['kelompok'] ? $data['kelompok'] : '-' ?></td>
                    <td><?= $data['dana_tahun_1'] ? number_format($data['dana_tahun_1']) : '-' ?></td>
                    <td><?= $data['dana_tahun_2'] ? number_format($data['dana_tahun_2']) : '-' ?></td>
                    <td><?= $data['dana_tahun_3'] ? number_format($data['dana_tahun_3']) : '-' ?></td>
                    <td>
                        <?php 
                            $sql = "SELECT * FROM mitra_file_pb WHERE mitra_pb_id=".$data['id'];
                            $query = $db->query($sql)->getResultArray();
                            foreach ($query as $dataFile) :
                        ?>
                        <?= $dataFile['file_mitra'] ? '<a href="'. base_url().'/FileController/download/'.$dataFile['file_mitra'].'">
                        <button class="btn btn-sm btn-danger"><i class="fa fa-file-pdf"></i>
                        Download</button></a>' : '-' ?><br/><br/>
                        <?php endforeach;; ?>
                    </td>
                    <td>
                        <a href="/deletepb/mitra/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data IKU">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <!-- End Table Mitra -->    

    <!-- Table SDGs -->
    <div class="h4 font-weight-bold mt-3">Daftar SDGs<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('sdgs')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox_sdgs" hidden>        
    <div class="col-md-12 mt-2"><textarea class="form-control" name="sdgs" rows="4" placeholder="SDGs Terkait ....."  onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
    <div class="col-md-12 mt-2"><textarea class="form-control" name="kegiatanSDGs" rows="4" placeholder="Uraian Kegiatan ....."  onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
    <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="sdgs">Submit</button>
    </form>

    <?php if (${'sdgs_'.$id}){?>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="300px">SDGs Terkait`</th>
                    <th scope="col" width="500px">Uraian Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach (${'sdgs_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['sdgs'] ? $data['sdgs'] : '-' ?></td>
                    <td><?= $data['kegiatan'] ? $data['kegiatan'] : '-' ?></td>
                    </td>
                    <td>
                        <a href="/deletepb/sdgs/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data IKU">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <!-- End Table SDGs -->

    <!-- Table IKU -->
    <div class="h4 font-weight-bold mt-3">Daftar IKU<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('iku')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox_iku" hidden>        
    <div class="col-md-12 mt-2"><textarea class="form-control" name="indikatorIKU" rows="4" placeholder="Indikator IKU ....."  onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
    <div class="col-md-12 mt-2"><textarea class="form-control" name="uraianIKU" rows="4" placeholder="Uraian IKU ....."  onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
    <div class="col-md-12 mt-2"><textarea class="form-control" name="kegiatanIKU" rows="4" placeholder="Uraian Kegiatan ....."  onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
    <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="iku">Submit</button>
    </form>

    <?php if (${'iku_'.$id}){?>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="300px">Indikator IKU Terkait`</th>
                    <th scope="col" width="300x">Uraian IKU</th>
                    <th scope="col" width="300px">Uraian Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach (${'iku_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['indikator'] ? $data['indikator'] : '-' ?></td>
                    <td><?= $data['uraian'] ? $data['uraian'] : '-' ?></td>
                    <td><?= $data['kegiatan'] ? $data['kegiatan'] : '-' ?></td>
                    </td>
                    <td>
                        <a href="/deletepb/iku/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data IKU">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <!-- End Table IKU -->    

   <!-- Table RAB -->   
    <?php 
        $sql= "SELECT * FROM rab_pb WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$id;  
        $rabCombo = $db->query($sql)->getResultArray();
    ?>
    <div class="h4 font-weight-bold">Daftar Rencana Anggaran Biaya</div>
    <hr/>
    <div class="row mr-2">
        <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="form-group mt-2">                        
                <div class="accordion" id="accordion">
                    <div class="card-body">
                        <div class=" form-row align-items-right mt-2">
                            <?php  
                            if ($rabCombo) { 
                                $idx=1;
                                foreach ($rabCombo as $data) :
                                    if ($idx==1) :
                                        ?>
                                <div class="col-12 mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><strong>Dana yang direncanakan</strong></div>
                                        <input type="text" name="danaRencanaRAB" class="form-control mr-4" value="<?= number_format($data['dana_direncanakan']) ?>" disabled>
                                        <a href="/deletepb/rab/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Item">
                                        <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                                    </div>
                                </div>
                            <?php $idx++; endif; endforeach; } else { ?>                            
                            <div class="col-12 mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Dana yang direncanakan</strong></div>
                                    <input type="text" name="danaRencanaRAB" class="form-control" value=0 onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);" disabled>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-6">
                                <button name="fungsi" value="tahun rab" type="submit" class="btn btn-sm btn-primary shadow-sm mb-2"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Tahun</button>
                                <select id="tahunSelect" class="form-control" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onchange="insertValue('rab')">
                                    <option value="">Pilih Tahun</option>
                                    <?php                                  
                                    foreach ($rabCombo as $data) :
                                        ?>
                                    <option value="<?= $data['id'] ?>"> <?= $data['tahun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="tambahTahun" onclick="showForm('rab')" class="btn btn-sm btn-danger shadow-sm mt-2" hidden><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Item</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <form method="post" enctype="multipart/form-data" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="formBox_rab" hidden>        
        <hr/><b>Add Detail RAB</b>
        <div class="form-group mt-2">                        
            <div class="accordion" id="accordion">
                <div class="card-body">
                    <div class="form-row align-items-right">
                        <div class="col-8">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong>Kelompok</strong></div>
                                <select class="form-control" name="kelompokRAB" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                <?php 
                                    $sql="SELECT * FROM rab_kelompok_pb"; 
                                    $rabCombo = $db->query($sql)->getResultArray();
                                    foreach ($rabCombo as $data) :
                                ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>    
                                <?php endforeach; ?>                            </select>
                                </div>
                            </div>
                        </div>
                    <div class="form-row align-items-right mt-2">
                        <div class="col-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong>Komponen</strong></div>
                                <select class="form-control" name="komponenRAB" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                <?php 
                                    $sql="SELECT * FROM rab_komponen_pb"; 
                                    $rabCombo = $db->query($sql)->getResultArray();
                                    foreach ($rabCombo as $data) :
                                ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>    
                                <?php endforeach; ?>                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row align-items-right mt-2">
                        <div class="col-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong>Satuan</strong></div>
                                <select class="form-control" name="satuanRAB" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                <?php 
                                    $sql="SELECT * FROM rab_satuan"; 
                                    $rabCombo = $db->query($sql)->getResultArray();
                                    foreach ($rabCombo as $data) :
                                ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>    
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" form-row align-items-right mt-2">
                        <div class="col-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong>Item</strong></div>
                                <textarea class="form-control" name="itemRAB" rows="2" placeholder="Masukkan Item ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class=" form-row align-items-right mt-2">
                        <div class="col-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong>Harga (Rp)</strong></div>
                                <input type="text" name="hargaRAB" class="form-control" placeholder="Masukkan Harga ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);">
                            </div>
                        </div>
                    </div>
                    <div class=" form-row align-items-right mt-2">
                        <div class="col-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong>Volume</strong></div>
                                <input type="text" name="volumeRAB" class="form-control" placeholder="Masukkan Volume ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);">
                            </div>
                        </div>
                    </div>
                    <div class=" form-row align-items-right mt-2">
                        <div class="col-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong>Item</strong></div>
                                <textarea class="form-control" name="urlHPS" rows="2" placeholder="Masukkan Item ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea>
                            </div>
                        </div>
                    </div>
                    <input id="tahunRAB" name="tahunRAB" type="text" hidden>
                </div>
            </div>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="rab">Submit</button>    </form>
    </form>
    
    <?php if (${'rab_'.$id}){           
    $sql ="SELECT * FROM rab_pb WHERE pengabdian_id=".$id." AND dosen_id=".$dosen_id;
    //dd($sql);
    $query  = $db->query($sql)->getResultArray();
    foreach ($query as $qry) :
        $tahun = $qry['tahun'];
    ?>
    Tahun ke - <?= $qry['tahun'] ?>     
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="250px">Kelompok</th>
                    <th scope="col" width="250px">Komponen</th>
                    <th scope="col" width="300px">Item</th>
                    <th scope="col" width="150px">Satuan</th>
                    <th scope="col" width="80px">Harga</th>
                    <th scope="col" width="80px">Volume</th>
                    <th scope="col" width="80px">Total</th>
                    <th scope="col" width="50px">URL HPS</th>
                    <th scope="col" width="50px"></th>
                </tr>
                    <?php 
                        $totalTahun=0;
                        $index = 1;
                        foreach (${'rab_'.$id} as $data) :                            
                            if ($data['tahun']==$qry['tahun']) :
                    ?>
            </thead>
                 <tbody>
                    <td style="text-align: center"><?= $index ?></td>

                    <?php                        
                        $query="SELECT * FROM rab_kelompok_pb WHERE id=". $data['rab_kelompok_id']; 
                        $rabDetail = $db->query($query)->getResultArray();
                        foreach ($rabDetail as $rd) :
                    ?>
                    <td><?= $rd['name'] ? $rd['name'] : '-' ?></td>
                    <?php endforeach ?>
                    
                    <?php 
                        $query="SELECT * FROM rab_komponen_pb WHERE id=". $data['rab_komponen_id']; 
                        $rabDetail = $db->query($query)->getResultArray();
                        foreach ($rabDetail as $rd) :
                            ?>
                    <td><?= $rd['name'] ? $rd['name'] : '-' ?></td>
                    <?php endforeach ?>
                    
                    <td><?= $data['item'] ? $data['item'] : '-' ?></td>
                    
                    <?php 
                        $query="SELECT * FROM rab_satuan WHERE id=". $data['rab_satuan_id']; 
                        $rabDetail = $db->query($query)->getResultArray();
                        foreach ($rabDetail as $rd) :
                            ?>
                    <td><?= $rd['name'] ? $rd['name'] : '-' ?></td>
                    <?php endforeach ?>
                    
                    <td><?= $data['harga'] ? number_format($data['harga']) : '-' ?></td>
                    <td><?= $data['volume'] ? number_format($data['volume']) : '-' ?></td>
                    <td><?= $data['total'] ? number_format($data['total']) : '-' ?></td>
                    <td><?= $data['url_'] ? '<a href="'.$data['url_'].'" target="_blank">Lihat</a>' : '-' ?></td>
                    <td>
                        <a href="/deletepb/item/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Item">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>                    
            <?php $totalTahun=$totalTahun+$data['total']; $index++; endif; 
        endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="mb-3"><b>Total Biaya Tahun ke- <?= $tahun ?> : <?= number_format($totalTahun) ?></b></div>

    <?php           
        endforeach;
    ?>
    <hr/>
    <?php } ?>
    <!-- End Table RAB -->

   <!-- Table Pendukung -->
    <div class="h4 font-weight-bold">File Pendukung
    <img src="<?= base_url() ?>/icon/add.png" onclick="showForm('pendukung')"/>
    </div>
    <hr/>
    <form method="post" enctype="multipart/form-data" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="formBox_pendukung" hidden>        
        <div  class="row g-3">
            <div class="col-md-6 mb-2"><input name="jenisPendukung" type="text" class="form-control" placeholder="Jenis ...." onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
            <div class="col-md-6 mb-2">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="filePendukung">
                    <label class="custom-file-label" for="filePendukung">Upload File</label>
                </div>
            </div>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="pendukung">Submit</button>
    </form>

    <?php if (${'pendukung_'.$id}){?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="500px">Jenis</th>
                    <th scope="col" width="500px">File</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <?php
                    $index = 1;
                    foreach (${'pendukung_'.$id} as $data) :                        
                    ?>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td>
                        <?= $data['file_'] ? '<a href="'. base_url().'/FileController/download/'.$data['file_'].'">
                        <button class="btn btn-sm btn-danger"><i class="fa fa-file-pdf"></i>
                        Download</button></a>' : '-' ?><br/><br/>
                    </td>                                        
                    <td>
                        <a href="/deletepb/pendukung/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Mitra">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <!-- End Table Pendukung -->    

    <form method="post" action="<?= base_url() ?>/user/listPengabdian">
        <?= csrf_field() ?>
        <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">Kembali ke List Pengabdian</button>
    </form>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>