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
        $nidn = $nama = $institusi = $prodi = $tugas = 
        $jenis_nondosen = $ktp_nondosen = $nama_nondosen = 
        $institusi_nondosen = $tugas_nondosen = 
        $makro_riset = $fileSubstansi = $urutanTahun =
        $kelompokLuaran = $jenisLuaran = $targetLuaran = 
        $keteranganLuaran = $kelompokRAB = $komponenRAB =
        $itemRAB = $tahunRAB = null;   
        
        $hargaRAB = $volumeRAB = $danaRencanaRAB = 0;
 
        // Checking for a POST request
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $fungsi = input_data($_POST["fungsi"]);
          switch($fungsi){
            case 'dosen': //Get Var Dosen
                $nidn = input_data($_POST["nidn"]);
                $nama = input_data($_POST["nama"]);
                $institusi = input_data($_POST["institusi"]);
                $prodi = input_data($_POST["prodi"]);
                $tugas = input_data($_POST["tugas"]);
            break;          
            case 'non dosen': //Get Var Non Dosen
                $jenis_nondosen = input_data($_POST["jenis_nondosen"]);
                $ktp_nondosen = input_data($_POST["ktp_nondosen"]);
                $nama_nondosen = input_data($_POST["nama_nondosen"]);
                $institusi_nondosen = input_data($_POST["institusi_nondosen"]);
                $tugas_nondosen = input_data($_POST["tugas_nondosen"]);
            break;
            case "substansi":
                $makroRiset = input_data($_POST["makroRiset"]);
                $fileSubstansi = input_data($_FILES["fileSubstansi"]["name"]);                
                if ($fileSubstansi) {
                    $path = "file/".basename($fileSubstansi);
                    $renFile = "PLSub".date("Ymd")."_".$id.'_'.$dosen_id.".".
                                strtolower(pathinfo($path,PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["fileSubstansi"]["tmp_name"], "file/".$renFile);
                } else { $renFile=null; }

                $urutanTahun = input_data($_POST["urutanTahun"]);
                $kelompokLuaran = input_data($_POST["kelompokLuaran"]);
                $jenisLuaran = input_data($_POST["jenisLuaran"]);
                $targetLuaran = input_data($_POST["targetLuaran"]);
                $keteranganLuaran = input_data($_POST["keteranganLuaran"]);
                break;

                case 'rab' :
                $tahunRAB =  input_data($_POST["tahunRAB"]);                
                $kelompokRAB = input_data($_POST["kelompokRAB"]);                
                $komponenRAB = input_data($_POST["komponenRAB"]);                
                $itemRAB = input_data($_POST["itemRAB"]);                
                $satuanRAB = input_data($_POST["satuanRAB"]);                
                $hargaRAB = input_data($_POST["hargaRAB"]);                
                $volumeRAB = input_data($_POST["volumeRAB"]);              


                if ($hargaRAB==""){$hargaRAB=0;}
                if ($volumeRAB==""){$volumeRAB=0;} 
                $totalRAB = $hargaRAB * $volumeRAB;

                $sql = "SELECT * FROM rab  WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;  
                $query = $db->query($sql)->getResultArray();
                foreach ($query as $qry) :
                    $danaRencanaRAB = $qry['dana_direncanakan'] + $totalRAB;
                endforeach;

                break;
                
                case "tahun rab":
                    if (isset($_POST["danaRencanaRAB"])){
                        //$danaRencanaRAB = input_data($_POST["danaRencanaRAB"]);
                        if ($danaRencanaRAB==""){$danaRencanaRAB=0;}
                        $sql = "SELECT * FROM rab WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;  
                        $tahunRAB = $db->query($sql)->getNumRows() + 1;
                    }                    
                break;
          }

          switch ($fungsi){
              case 'dosen':
                  $sql = 'INSERT INTO anggota_dosen (penelitian_id,dosen_id,nidn,nama,institusi,prodi,tugas) '. 
                        'VALUES ('.$id.','.$dosen_id.',"'.$nidn.'","'.$nama.'","'.$institusi.'","'.$prodi.'","'.$tugas.'")';                
               break;
               case 'non dosen':
                   $sql = 'INSERT INTO anggota_non_dosen (penelitian_id,dosen_id,jenis,ktp,nama,institusi,tugas) '. 
                        'VALUES ('.$id.','.$dosen_id.',"'.$jenis_nondosen.'","'.$ktp_nondosen.'","'.$nama_nondosen.'","'.$institusi_nondosen.'","'.$tugas_nondosen.'")';
               break;
               case 'substansi':
                   $sql = 'INSERT INTO substansi_luaran (penelitian_id,dosen_id,makro_riset,file_luaran,urutan_tahun,kelompok_luaran,jenis_luaran,target_luaran,keterangan) '. 
                        'VALUES ('.$id.','.$dosen_id.',"'.$makroRiset.'","'.$renFile.'","'.$urutanTahun.'","'.$kelompokLuaran.'","'.$jenisLuaran.'","'.$targetLuaran.'","'.$keteranganLuaran.'")';
               break;
               case 'rab':
                   $sql = 'INSERT INTO rab_detail (rab_id,rab_kelompok_id,rab_komponen_id,item,rab_satuan_id,harga,volume,total) '. 
                        'VALUES ('.$tahunRAB.','.$kelompokRAB.','.$komponenRAB.',"'.$itemRAB.'",'.$satuanRAB.','.$hargaRAB.','.$volumeRAB.','.$totalRAB.')';
                    $db->query($sql); 
                    $sql = "UPDATE rab SET dana_direncanakan = ".$danaRencanaRAB." WHERE penelitian_id=".$id." AND dosen_id=".$dosen_id;                
               break;
               case 'tahun rab':
                   $sql = 'INSERT INTO rab (penelitian_id,dosen_id,tahun,dana_direncanakan) '. 
                        'VALUES ('.$id.','.$dosen_id.','.$tahunRAB.','.$danaRencanaRAB.')';
               break;
            }
            $db->query($sql);                        
            //dd($sql);
        } 
        
        $sql = "SELECT * FROM anggota_dosen WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;  
        ${'anggota_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM anggota_non_dosen WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;                
        ${'nonDosen_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM substansi_luaran WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;                
        ${'substansi_'.$id} = $db->query($sql)->getResultArray();
        $sql = "SELECT * FROM rab r INNER JOIN rab_detail rd ON r.id=rd.rab_id WHERE r.dosen_id=".$dosen_id." AND r.penelitian_id=".$id.'' ;                
        ${'rab_'.$id} = $db->query($sql)->getResultArray();
        
 
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
        <div class="col-md-2"><input name="nidn" type="text" class="form-control" placeholder="NIDN ...." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col md-6"><input name="nama" type="text" class="form-control" placeholder="Nama ....." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-10 mt-2">           
            <select class="form-control" name="institusi" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Sekolah Tinggi Ilmu Keperawatan PPNI Jawa Barat">Sekolah Tinggi Ilmu Keperawatan PPNI Jawa Barat</option>
            </select>
        </div>
        <div class="col-md-2 mt-2">           
            <select class="form-control" name="prodi" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Pofesi Ners">Pofesi Ners</option>
                <option value="Keperawatan">Keperawatan</option>
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
                    <th scope="col" width="200px">Institusi</th>
                    <th scope="col" width="100px">Prodi</th>
                    <th scope="col" width="200px">Tugas</th>
                    <th scope="col" width="80px">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1 + (5 * ($currentPage - 1));
                    foreach (${'anggota_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['nidn'] ? $data['nidn'] : '-' ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                    <td><?= $data['institusi'] ? $data['institusi'] : '-' ?></td>
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
                        <a href="/delete/anggotaDosen/<?= $id ?>/<?= $dosen_id ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
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

    <?= $pager->links('user', 'custom_pagination') ?>
    <!-- End Table Anggota -->
    <hr/>
    <?php } ?>

    <!-- Table Anggota Non Dosen -->
    <div class="h4 font-weight-bold mt-3">Daftar Anggota Non Dosen<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('non dosen')"/></div>
    <hr/>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox_nondosen" hidden>        
        <div class="col-md-2"><input name="jenis_nondosen" type="text" class="form-control" placeholder="Jenis ...." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-2"><input name="ktp_nondosen" type="text" class="form-control" placeholder="No.Identitas ...." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col md-6"><input name="nama_nondosen" type="text" class="form-control" placeholder="Nama ....." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-10 mt-2">           
            <select class="form-control" name="institusi_nondosen" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Sekolah Tinggi Ilmu Keperawatan PPNI Jawa Barat">Sekolah Tinggi Ilmu Keperawatan PPNI Jawa Barat</option>
            </select>
        </div>
        <div class="col-md-12 mt-2"><textarea class="form-control" name="tugas_nondosen" rows="4" placeholder="Tugas ....." aria-label="First name" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="non dosen">Submit</button>
    </form>

    <?php if (${'nonDosen_'.$id}){?>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="50px">Jenis</th>
                    <th scope="col" width="100px">Identitas</th>
                    <th scope="col" width="200px">Nama</th>
                    <th scope="col" width="200px">Institusi</th>
                    <th scope="col" width="200px">Tugas</th>
                    <th scope="col" width="80px">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1 + (5 * ($currentPage - 1));
                    foreach (${'nonDosen_'.$id} as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td><?= $data['ktp'] ? $data['ktp'] : '-' ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                    <td><?= $data['institusi'] ? $data['institusi'] : '-' ?></td>
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
                        <a href="/delete/nonDosen/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
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

    <?= $pager_nondosen->links('user', 'custom_pagination') ?>
    <!-- End Table Anggota Non Dosen -->

    <?php } ?>

   <!-- Table Substansi Luaran -->
   <div class="h4 font-weight-bold">Daftar Substansi dan Luaran<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('substansi')"/></div>
    <hr/>
    <form method="post" enctype="multipart/form-data" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="formBox_substansi" hidden>        
        <div  class="row g-3">
            <?php  
                $sql = "SELECT * FROM substansi_luaran WHERE penelitian_id=".$id ;
                ${'substansi_x'.$id} = $db->query($sql)->getResultArray();
                if (!${'substansi_x'.$id}) {
            ?>
            <div class="col-md-4"><input name="makroRiset" type="text" class="form-control" placeholder="Makro Riset ...." aria-label="Makro Riset" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
            <div class="col-md-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="fileSubstansi">
                    <label class="custom-file-label" for="fileSubstansi">Upload File Substansi</label>
                </div>
            </div>
            <?php } else { ?>
                <div>
                    <input name="makroRiset" type="text" hidden>
                    <input type="file" class="custom-file-input" name="fileSubstansi" hidden>
                </div>
            <?php } ?>
        </div>
        <hr/>
        <div  class="row g-3">
            <div class="col-md-2"><input name="urutanTahun" type="text" class="form-control" placeholder="Urutan Tahun ...." aria-label="Makro Riset" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
            <div class="col-md-10">           
                <select class="form-control" name="kelompokLuaran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                    <option value="Artikel di Jurnal">Artikel di Jurnal</option>
                </select>
            </div>
            <div class="col-md-8 mt-2">           
                <select class="form-control" name="jenisLuaran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                    <option value="Artikel di Jurnal Bereputasi Nasional Terindeks SINTA 1-4">Artikel di Jurnal Bereputasi Nasional Terindeks SINTA 1-4</option>
                </select>
            </div>
            <div class="col-md-4 mt-2">           
                <select class="form-control" name="targetLuaran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                    <option value="Accepted/Published">Accepted/Published</option>
                </select>
            </div>
            <div class="col md-6 mt-2"><input name="keteranganLuaran" rows="2" type="text" class="form-control" placeholder="Keterangan ....." aria-label="Keterangan" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="substansi">Submit</button>
    </form>

    <?php if (${'substansi_'.$id}){?>
       <?php  
          $sql = "SELECT * FROM substansi_luaran WHERE penelitian_id=".$id." AND (makro_riset IS NOT null OR file_luaran IS NOT null)" ;
          ${'substansi_x'.$id} = $db->query($sql)->getResultArray();        
          if (${'substansi_x'.$id}) :
            $idx=1;
            foreach (${'substansi_x'.$id} as $dataSecondary) :
                if ($idx==1):
        ?> 
            <div>        
                <p scope="col" width="50px"><b>Nama Makro Riset :</b>  <?= $dataSecondary['makro_riset'] ?></p>
                <p scope="col" width="200px"><b>Subtansi : <?= $dataSecondary['file_luaran'] ?
                    '<a target="_blank" rel="noopener noreferrer" href="" download="" 
                    class="btn btn-sm btn-danger"><span class="fa fa-file-pdf"></span>'.$dataSecondary['file_luaran'].'</a></b></p>' : '-' ?></b>
            </div>
        <?php $idx++; endif; endforeach; endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="120px">Urutan Tahun</th>
                    <th scope="col" width="150px">Kelompok Luaran</th>
                    <th scope="col" width="250px">Jenis Luaran</th>
                    <th scope="col" width="50px">Target</th>
                    <th scope="col" width="200px">Keterangan</th>
                    <th scope="col" width="50px"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1 + (5 * ($currentPage - 1));
                    foreach (${'substansi_'.$id} as $data) :                        
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td>Tahun ke - <?= $data['urutan_tahun'] ?></td>
                    <td><?= $data['kelompok_luaran'] ? $data['kelompok_luaran'] : '-' ?></td>
                    <td><?= $data['jenis_luaran'] ? $data['jenis_luaran'] : '-' ?></td>
                    <td><?= $data['target_luaran'] ? $data['target_luaran'] : '-' ?></td>
                    <td><?= $data['keterangan'] ? $data['keterangan'] : '-' ?></td>
                    <td>
                        <a href="/delete/substansi/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Substansi">
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

    <?= $pager->links('user', 'custom_pagination') ?>
    <!-- End Table Substansi -->
    <hr/>
    <?php } ?>

   <!-- Table RAB -->   
    <?php 
        $sql= "SELECT * FROM rab WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;  
        $rabCombo = $db->query($sql)->getResultArray();
    ?>
    <div class="h4 font-weight-bold">Daftar Rancangan Anggaran Biaya</div>
    <hr/>
    <div class="row mr-2">
        <form method="post" action="<?= 'user/inpl/'.$id.'/'.$dosen_id ?>">
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
                                        <a href="/delete/rab/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Item">
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
                                    $sql="SELECT * FROM rab_kelompok"; 
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
                                    $sql="SELECT * FROM rab_komponen"; 
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
                    <input id="tahunRAB" name="tahunRAB" type="text" hidden>
                </div>
            </div>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="rab">Submit</button>    </form>
    </form>
    
    <?php if (${'rab_'.$id}){           
    $sql ="SELECT * FROM rab WHERE penelitian_id=".$id." AND dosen_id=".$dosen_id;
    //dd($sql);
    $query  = $db->query($sql)->getResultArray();
    foreach ($query as $qry) :
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
                    <th scope="col" width="50px"></th>
                </tr>
                    <?php 
                        $index = 1 + (5 * ($currentPage - 1));
                        foreach (${'rab_'.$id} as $data) :                            
                            if ($data['tahun']==$qry['tahun']) :
                    ?>
            </thead>
                 <tbody>
                    <td style="text-align: center"><?= $index ?></td>

                    <?php
                        $query="SELECT * FROM rab_kelompok WHERE id=". $data['rab_kelompok_id']; 
                        $rabDetail = $db->query($query)->getResultArray();
                        foreach ($rabDetail as $rd) :
                    ?>
                    <td><?= $rd['name'] ? $rd['name'] : '-' ?></td>
                    <?php endforeach ?>
                    
                    <?php 
                        $query="SELECT * FROM rab_komponen WHERE id=". $data['rab_komponen_id']; 
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
                    <td>
                        <a href="/delete/item/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Item">
                            <img src="<?= base_url() ?>/icon/delete.png" class="mr-2"/></a>
                    </td>                    
            <?php $index++; endif; 
        endforeach; ?>
            </tbody>
        </table>
    </div>

    <?= $pager->links('user', 'custom_pagination') ?>
    <?php           
        endforeach;
    ?>
    <!-- End Table RAB -->
    <hr/>
    <?php } ?>

   <!-- Table Mitra -->
   <div class="h4 font-weight-bold">Daftar Mitra<img src="<?= base_url() ?>/icon/add.png" onclick="showForm('mitra')"/></div>
    <hr/>
    <form method="post" enctype="multipart/form-data" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="formBox_mitra" hidden>        
        <div  class="row g-3">
            <div class="col-md-6 mb-2"><input name="namaMitra" type="text" class="form-control" placeholder="Nama ...." aria-label="Nama" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
            <div class="col-md-8 mb-2"><input name="institusiMitra" type="text" class="form-control" placeholder="Institusi ...." aria-label="Insitusi" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
            <div class="col-md-12 mb-2"><textarea class="form-control" name="alamatMitra" rows="2" placeholder="Alamat ....." aria-label="Alamat" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></textarea></div>
            <div class="col-md-8 mb-2"><input name="emailMitra" type="text" class="form-control" placeholder="Email ...." aria-label="Email" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
            <div class="col-md-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="fileNitra">
                    <label class="custom-file-label" for="fileMitra">Upload Surat Kesanggupan</label>
                </div>
            </div>
        </div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="substansi">Submit</button>
    </form>

    <?php if (${'mitra_'.$id}){?>
       <?php  
          $sql = "SELECT * FROM substansi_luaran WHERE penelitian_id=".$id." AND (makro_riset IS NOT null OR file_luaran IS NOT null)" ;
          ${'substansi_x'.$id} = $db->query($sql)->getResultArray();        
          if (${'substansi_x'.$id}) :
            $idx=1;
            foreach (${'substansi_x'.$id} as $dataSecondary) :
                if ($idx==1):
        ?> 
            <div>        
                <p scope="col" width="50px"><b>Nama Makro Riset :</b>  <?= $dataSecondary['makro_riset'] ?></p>
                <p scope="col" width="200px"><b>Subtansi : <?= $dataSecondary['file_luaran'] ?
                    '<a target="_blank" rel="noopener noreferrer" href="" download="" 
                    class="btn btn-sm btn-danger"><span class="fa fa-file-pdf"></span>'.$dataSecondary['file_luaran'].'</a></b></p>' : '-' ?></b>
            </div>
        <?php $idx++; endif; endforeach; endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="120px">Urutan Tahun</th>
                    <th scope="col" width="150px">Kelompok Luaran</th>
                    <th scope="col" width="250px">Jenis Luaran</th>
                    <th scope="col" width="50px">Target</th>
                    <th scope="col" width="200px">Keterangan</th>
                    <th scope="col" width="50px"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1 + (5 * ($currentPage - 1));
                    foreach (${'substansi_'.$id} as $data) :                        
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td>Tahun ke - <?= $data['urutan_tahun'] ?></td>
                    <td><?= $data['kelompok_luaran'] ? $data['kelompok_luaran'] : '-' ?></td>
                    <td><?= $data['jenis_luaran'] ? $data['jenis_luaran'] : '-' ?></td>
                    <td><?= $data['target_luaran'] ? $data['target_luaran'] : '-' ?></td>
                    <td><?= $data['keterangan'] ? $data['keterangan'] : '-' ?></td>
                    <td>
                        <a href="/delete/substansi/<?= $id ?>/<?= $data['dosen_id'] ?>/<?= $data['id'] ?>" title="Delete Substansi">
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

    <?= $pager->links('user', 'custom_pagination') ?>
    <!-- End Table Mitra -->
    <hr/>
    <?php } ?>

    <form method="post" action="<?= base_url() ?>/user/listPenelitian">
        <?= csrf_field() ?>
        <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">Kembali ke List Penelitian</button>
    </form>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>