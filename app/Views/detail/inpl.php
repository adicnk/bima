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
        $nidn = $nama = $institusi = $prodi = $tugas = "";        
 
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
          }

          switch ($fungsi){
              case 'dosen':
                  $sql = 'INSERT INTO anggota_dosen (penelitian_id,dosen_id,nidn,nama,institusi,prodi,tugas) '. 'VALUES ('.$id.','.$dosen_id.',"'.$nidn.'","'.$nama.'","'.$institusi.'","'.$prodi.'","'.$tugas.'")';                
               break;
               case 'non dosen':
                   $sql = 'INSERT INTO anggota_non_dosen (penelitian_id,dosen_id,jenis,ktp,nama,institusi,tugas) '. 'VALUES ('.$id.','.$dosen_id.',"'.$jenis_nondosen.'","'.$ktp_nondosen.'","'.$nama_nondosen.'","'.$institusi_nondosen.'","'.$tugas_nondosen.'")';
               break;
            }
            $db->query($sql);                        
        } 
        
          $sql = "SELECT * FROM anggota_dosen WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;  
          ${'anggota_'.$id} = $db->query($sql)->getResultArray();
          $sql = "SELECT * FROM anggota_non_dosen WHERE dosen_id=".$dosen_id." AND penelitian_id=".$id;                
          ${'nonDosen_'.$id} = $db->query($sql)->getResultArray();
          $sql = "SELECT * FROM substansi_luaran WHERE penelitian_id=".$id;                
          ${'substansi_'.$id} = $db->query($sql)->getResultArray();
          //dd(${'anggota_'.$id});
        
 
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
                    <td><?= $data['nidn'] ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['institusi'] ? $data['institusi'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['prodi'] ? $data['prodi'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['tugas'] ? $data['tugas'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
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
                    <td><?= $data['jenis'] ? $data['jenis'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['ktp'] ? $data['ktp'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['institusi'] ? $data['institusi'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['tugas'] ? $data['tugas'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
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
                        <a href="/delete/nonDosen/<?= $id ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
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
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3" id="formBox" hidden>        
        <div class="col-md-2"><input name="makroRiset" type="text" class="form-control" placeholder="Makro Riset ...." aria-label="Makro Riset" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-12 h5 mb-3 text-gray-800"><center><strong>Upload File</strong></center></div>
        <div class="col-md-2"><input name="urutanTahun" type="text" class="form-control" placeholder="Makro Riset ...." aria-label="Makro Riset" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <div class="col-md-10 mt-2">           
            <select class="form-control" name="kelompokLuran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Artikel di Jurnal">Artikel di Jurnal</option>
            </select>
        </div>
        <div class="col-md-2 mt-2">           
            <select class="form-control" name="jenisLuaran" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Artikel di Jurnal Bereputasi Nasional Terindeks SINTA 1-4">Artikel di Jurnal Bereputasi Nasional Terindeks SINTA 1-4</option>
            </select>
        </div>
        <div class="col-md-2 mt-2">           
            <select class="form-control" name="target" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                <option value="Accepted/Published">Accepted/Published</option>
            </select>
        </div>
        <div class="col md-6"><input name="keterangan" type="text" class="form-control" placeholder="Keterangan ....." aria-label="Keterangan" onfocusin="yellowin(this);" onfocusout="whiteout(this)"></div>
        <button class="btn btn-lg btn-danger btn-block mt-3 mb-4" type="submit" name="fungsi" value="substansi">Submit</button>
    </form>

    <?php if (${'substansi_'.$id}){?>
    <div>        
        <p scope="col" width="50px">Makro Riset</p>
        <p scope="col" width="200px">File</p>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="100px">Urutan Tahun</th>
                    <th scope="col" width="200px">Kelompok Luaran</th>
                    <th scope="col" width="200px">Jenis Luaran</th>
                    <th scope="col" width="100px">Target</th>
                    <th scope="col" width="150px">Keterangan</th>
                    <th scope="col" width="80px"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1 + (5 * ($currentPage - 1));
                    foreach ($subtansi as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['makro_riset'] ?></td>
                    <td><?= '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['urutan_tahun'] ?></td>
                    <td><?= $data['kelompok_luaran'] ? $data['kelompok_luaran'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['jenis_luaran'] ? $data['jenis_luaran'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['target'] ? $data['target'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['keterangan'] ? $data['keterangan'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td>
                        <a href="/delete/anggotaDosen/<?= $id ?>/<?= $data['id'] ?>" title="Delete Data Anggota">
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

    <form method="post" action="<?= base_url() ?>/user/listPenelitian">
        <?= csrf_field() ?>
        <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">Kembali ke List Penelitian</button>
    </form>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>