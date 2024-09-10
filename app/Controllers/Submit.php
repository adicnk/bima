<?php
namespace App\Controllers;

Use App\Models\UserMDL;
use App\Models\DosenMDL;
use App\Models\DosenProfileMDL;
use App\Models\PenelitianMDL;
use App\Models\SintaMDL;
use App\Models\ScopusMDL;

class Submit extends BaseController

{

    protected $userModel, $dosenModel, $dosenProfileModel,
                $penelitianModel, $sintaModel, $scopusModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->dosenModel = new DosenMDL();
        $this->dosenProfileModel = new DosenProfileMDL();
        $this->penelitianModel = new PenelitianMDL();
        $this->sintaModel = new SintaMDL();
        $this->scopusModel = new ScopusMDL();
    }

    public function dosen()
    {
        $user_id = user_id();
        
        //dd($this->dosenModel->addDosenID($user_id))

        $this->dosenModel->save([
            'user_id' => $user_id,
            'nama' => $this->request->getVar('namaUser'),
            'nidn_nidk' => $this->request->getVar('nidn'),
            'klaster' => $this->request->getVar('klaster'),
            'institusi' => $this->request->getVar('institusi'),
            'program_studi' => $this->request->getVar('programStudi'),
            'pendidikan' => $this->request->getVar('jenjangPendidikan'),
            'jabatan' => $this->request->getVar('jabatanAkademik'),
            'alamat' => $this->request->getVar('alamat'),
            'tempat_lahir' => $this->request->getVar('tempatLahir'),
            'tanggal_lahir' => $this->request->getVar('tanggalLahir'),
            'ktp' => $this->request->getVar('noKTP'),
            'telp' => $this->request->getVar('noTelp'),
            'hp' => $this->request->getVar('noHP'),
            'website' => $this->request->getVar('website')
        ]);

        $this->dosenProfileModel->save([
            'dosen_id' => $user_id,
            'penelitian' =>  $this->request->getVar('penelitian'),
            'pengabdian' =>  $this->request->getVar('pengabdian'),
            'artikel_internasional' =>  $this->request->getVar('artikel'),
            'hki' =>  $this->request->getVar('HKI'),
            'buku' =>  $this->request->getVar('buku'),
        ]);

        $this->sintaModel->save([
            'dosen_id' => $user_id,
            'sinta_id' =>  $this->request->getVar('sintaIndex'),
            'overall' =>  $this->request->getVar('sintaOverall'),
            '3_year' =>  $this->request->getVar('sinta3yr'),
        ]);

        $this->scopusModel->save([
            'dosen_id' => $user_id,
            'scopus_id' =>  $this->request->getVar('scopusIndex'),
            'h_index' =>  $this->request->getVar('scopusHIndex'),
            'articles' =>  $this->request->getVar('jumlahArtikel'),
            'citation' =>  $this->request->getVar('citation'),
        ]);

        //Add dosen_id in user table
        $this->userModel->addDosenID($user_id);
        
        //ID terakhir yg di buat di tabel user
        //$db      = \Config\Database::connect();
        //$lastID = $db->insertID();
        $data = [
            'title' => "Dashboard",
            'dosen' => $this->dosenModel->searchDosen(user_id())
        ];

        return view('user/dashboard', $data);
    }

    public function penelitian()
    {
        //The attribute of File
        //$isFileUpload = $this->request->getVar('isFileUpload');

        //The File
        $isFileUpload = $this->request->getFile('fileUpload');
        $renFile = null;

        //dd($this->request->getVar('judulPenelitian'));
        
        if ($isFileUpload) :
            // Pindahkan file ke folder file
            //$isFileUpload->move('file');            
            $renFile = 'PL'.date("Ymd")."_".$this->penelitianModel->searchUploadPenelitian(date("Ymd")).'_'.user_id();
            $isFileUpload->move('file', $renFile.'.'.$isFileUpload->getExtension());

            // Ambil nama file
            //$namaFile = $isFileUpload->getName();
        endif;


        $this->penelitianModel->save([
            'dosen_id'=> user_id(),
            'judul' => $this->request->getVar('judulPenelitian'),
            'file' => $renFile.'.'.$isFileUpload->getExtension(),
            'bidang_fokus' => $this->request->getVar('bidangFokus'),
            'skema' => $this->request->getVar('kelompokSkema'),
            'ruang_lingkup' => $this->request->getVar('ruangLingkup'),
            'tahun_usulan' => $this->request->getVar('tahunUsulan'),
            'tahun_pelaksanaan' => $this->request->getVar('tahunPelaksanaan'),
            'lama' => $this->request->getVar('lamaKegiatan'),
            'tema' => $this->request->getVar('temaPenelitian'),
            'topik' => $this->request->getVar('topikPenelitian'),
            'rumpun_ilmu' => $this->request->getVar('rumpunIlmu'),
            'target_tkt' => $this->request->getVar('targetTKT')
        ]);

        $data = [
            'title' => "Dashboard",
            'dosen' => $this->dosenModel->searchDosen(user_id())
        ];

        return view('user/dashboard', $data);
    }
    
}

