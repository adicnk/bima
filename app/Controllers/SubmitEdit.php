<?php
namespace App\Controllers;

Use App\Models\UserMDL;
use App\Models\DosenMDL;
use App\Models\DosenProfileMDL;
use App\Models\PenelitianMDL;
use App\Models\RabMDL;
use App\Models\SintaMDL;
use App\Models\ScopusMDL;
use App\Models\PengabdianMDL;

class SubmitEdit extends BaseController

{

    protected $userModel, $dosenModel, $dosenProfileModel,
                $penelitianModel, $sintaModel, $scopusModel,
                $rabModel, $pengabdianModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->dosenModel = new DosenMDL();
        $this->dosenProfileModel = new DosenProfileMDL();
        $this->penelitianModel = new PenelitianMDL();
        $this->rabModel = new RabMDL();
        $this->sintaModel = new SintaMDL();
        $this->scopusModel = new ScopusMDL();
        $this->pengabdianModel = new PengabdianMDL();
    }

    public function dosen($id)
    {
        $user_id = user_id();
        
        //dd($this->dosenModel->addDosenID($user_id))

        $this->dosenModel->save([
            'id' => $id, 
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
            'id' => $this->dosenProfileModel->profileID($id),
            'dosen_id' => $user_id,
            'penelitian' =>  $this->request->getVar('penelitian'),
            'pengabdian' =>  $this->request->getVar('pengabdian'),
            'artikel_internasional' =>  $this->request->getVar('artikel'),
            'hki' =>  $this->request->getVar('HKI'),
            'buku' =>  $this->request->getVar('buku'),
        ]);

        $this->sintaModel->save([
            'id' => $this->sintaModel->sintaID($id),
            'dosen_id' => $user_id,
            'sinta_id' =>  $this->request->getVar('sintaIndex'),
            'overall' =>  $this->request->getVar('sintaOverall'),
            '3_year' =>  $this->request->getVar('sinta3yr'),
        ]);

        $this->scopusModel->save([
            'id' => $this->scopusModel->scopusID($id),
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
            'dosen' => $this->dosenModel->searchDosen(user_id()),
            'plCount' => $this->dosenModel->countPenelitian(user_id()),
            'pbCount' => $this->dosenModel->countPengabdian(user_id()),
        ];

        return view('user/dashboard', $data);
    }

    public function penelitian($id)
    {
        //The attribute of File
        //$isFileUpload = $this->request->getVar('isFileUpload');

        //The File
        $isFileUpload = $this->request->getFile('fileUpload');
        $renFile = null;

        //dd($this->request->getVar('judulPenelitian'));
        
        if ($isFileUpload) {
            // Pindahkan file ke folder file
            //$isFileUpload->move('file');            
            $renFile = date("Ymd")."_".$this->penelitianModel->searchUploadPenelitian(date("Ymd")).'_'.user_id();
            $extension = $isFileUpload->getExtension();
            $isFileUpload->move('file', 'PL'.$renFile.'.'.$isFileUpload->getExtension());
            $file = 'PL'.$renFile.'.'.$extension;
            // Ambil nama file
            //$namaFile = $isFileUpload->getName();
        } else { 
            $file = null;
        };

        if ($file){
            $this->penelitianModel->save([
                'id' => $id,
                'file' => $file
            ]);
        }

        $this->penelitianModel->save([
            'id' => $id,
            'dosen_id'=> user_id(),
            'judul' => $this->request->getVar('judulPenelitian'),
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
            'dosen' => $this->dosenModel->searchDosen(user_id()),
            'plCount' => $this->dosenModel->countPenelitian(user_id()),
            'pbCount' => $this->dosenModel->countPengabdian(user_id()),
        ];

        return view('user/dashboard', $data);
    }

    public function pengabdian($id)
    {
        //The attribute of File
        //$isFileUpload = $this->request->getVar('isFileUpload');

        //The File
        $isFileUpload = $this->request->getFile('fileUpload');
        $renFile = null;

        //dd($this->request->getVar('judulPenelitian'));
        
        if ($isFileUpload) {
            // Pindahkan file ke folder file
            //$isFileUpload->move('file');            
            $renFile = date("Ymd")."_".$this->penelitianModel->searchUploadPenelitian(date("Ymd")).'_'.user_id();
            $extension = $isFileUpload->getExtension();
            $isFileUpload->move('file', 'PB'.$renFile.'.'.$isFileUpload->getExtension());
            $file = 'PB'.$renFile.'.'.$extension;
            // Ambil nama file
            //$namaFile = $isFileUpload->getName();
        } else { 
            $file = null;
        };

        if ($file){
            $this->pengabdianModel->save([
                'id'=> $id,
                'file'=> $file,
            ]);    
        }

        $this->pengabdianModel->save([
            'id' => $id,
            'dosen_id'=> user_id(),
            'judul' => $this->request->getVar('judulPengabdian'),
            'bidang_fokus' => $this->request->getVar('bidangFokus'),
            'skema' => $this->request->getVar('kelompokSkema'),
            'ruang_lingkup' => $this->request->getVar('ruangLingkup'),
            'tahun_usulan' => $this->request->getVar('tahunUsulan'),
            'tahun_pelaksanaan' => $this->request->getVar('tahunPelaksanaan'),
            'lama' => $this->request->getVar('lamaKegiatan'),
            'rumpun_ilmu' => $this->request->getVar('rumpunIlmu'),
        ]);

        $data = [
            'title' => "Dashboard",
            'dosen' => $this->dosenModel->searchDosen(user_id()),
            'plCount' => $this->dosenModel->countPenelitian(user_id()),
            'pbCount' => $this->dosenModel->countPengabdian(user_id()),
        ];

        return view('user/dashboard', $data);
    }
    
}

