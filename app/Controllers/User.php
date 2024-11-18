<?php

namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\AnggotaMDL;
use App\Models\NonDosenMDL;
use App\Models\SubstansiMDL;
use App\Models\RabMDL;
use App\Models\MitraMDL;
use App\Models\PenelitianMDL;
use App\Models\PengabdianMDL;
use App\Models\AnggotaPBMDL;
use App\Models\VokasiMDL;
use App\Models\MahasiswaMDL;
use App\Models\SubstansiPBMDL;
use App\Models\UserMDL;
use App\Models\UserModel;

class User extends BaseController
{

    protected $dosenModel, $anggotaModel, $nonDosenModel, $penelitianModel,
                $substansiModel, $rabModel, $mitraModel, $pengabdianModel,
                $anggotapbModel, $vokasiModel, $mahasiswaModel, $substansipbModel,
                $userModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
        $this->anggotaModel = new AnggotaMDL();
        $this->nonDosenModel = new NonDosenMDL();
        $this->substansiModel = new SubstansiMDL();
        $this->rabModel = new RabMDL();
        $this->mitraModel = new MitraMDL();
        $this->penelitianModel = new PenelitianMDL();
        $this->pengabdianModel = new PengabdianMDL();
        $this->anggotapbModel = new AnggotaPBMDL();
        $this->vokasiModel = new VokasiMDL();
        $this->vokasiModel = new VokasiMDL();
        $this->mahasiswaModel = new MahasiswaMDL();
        $this->substansipbModel = new SubstansiPBMDL();
        $this->userModel = new UserMDL();
    }

    public function index()
    {
        if (in_groups('peneliti')) :
            $dosenID = user()->dosen_id;
            if ($dosenID == null) {
                $data = [
                    'title' => "Silahkan Isi Profile Data Anda Dulu"
                ];
                return view('user/baru', $data);            
            }
            
            $data = [
                'title' => "Dashboard",
                'dosen' => $this->dosenModel->searchDosen(user_id()),
                'plCount' => $this->dosenModel->countDosenPL(user_id()),
                'pbCount' => $this->dosenModel->countDosenPB(user_id()),
            ];
            return view('user/dashboard', $data);
        endif;

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data = [
            'title' => "Administrator",
            'dosen' => $this->dosenModel->searchDosen(),
            'data_penelitian'=> $this->penelitianModel->searchPenelitian(user_id()),
            'penelitian'  => $this->penelitianModel->paginate(5, 'user'),
            'pager' => $this->penelitianModel->pager,
            'currentPage' => $currentPage,
            'countPL' => $this->penelitianModel->countPL(),
            'countPB' => $this->pengabdianModel->countPB(),
            'setujuPL' => $this->penelitianModel->setujuPL(),
            'setujuPB' => $this->pengabdianModel->setujuPB(),
            'tolakPL' => $this->penelitianModel->tolakPL(),
            'tolakPB' => $this->pengabdianModel->tolakPB(),
        ];
        return view('admin/dashboard', $data);

    }

    public function arsip(){
        $data = [
            'title' => "Arsip File",
        ];
        return view('admin/arsip', $data);
    }

    public function plpb($id){        
        $data = [
            'title' => "Penelitian & Pengabdian dari ",
            'dosen' => $this->dosenModel->searchDosen($id),
            'data_penelitian'=> $this->penelitianModel->searchPenelitian($id),
            'data_pengabdian'=> $this->pengabdianModel->searchPengabdian($id),
        ];
        return view('admin/plpb', $data);
    }

    public function statuspl($id, $dosen_id){    
        $data = [
            'title' => "Detail Data Penelitian",
            'penelitianID' => $id,
            'dosen_id' => $dosen_id,
            'data_penelitian'=> $this->penelitianModel->searchJudulPenelitian($id)
        ];
        return view('detail/statuspl', $data);        
    }

    public function statuspb($id, $dosen_id){        
        $data = [
            'title' => "Detail Data Pengabdian",
            'pengabdianID' => $id,
            'dosen_id' => $dosen_id,
            'data_pengabdian'=> $this->pengabdianModel->searchJudulPengabdian($id)
        ];
        return view('detail/statuspb', $data);        
    }

    public function plsetuju($penelitianID,$dosen_id){     
        $db = \Config\Database::connect();
        $db->query('
            UPDATE usulan_penelitian SET status=1 
            WHERE id='.$penelitianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_dosen SET status=1 
            WHERE penelitian_id='.$penelitianID.' AND dosen_id='.$dosen_id            
        );

        $data = [
            'title' => "Penelitian & Pengabdian dari ",
            'dosen' => $this->dosenModel->searchDosen($dosen_id),
            'data_penelitian'=> $this->penelitianModel->searchPenelitian($dosen_id),
            'data_pengabdian'=> $this->pengabdianModel->searchPengabdian($dosen_id),
        ];
        return view('admin/plpb', $data);
    }

    public function plditolak($penelitianID,$dosen_id){     
        $db = \Config\Database::connect();
        $db->query('
            UPDATE usulan_penelitian SET status=0 
            WHERE id='.$penelitianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_dosen SET status=0 
            WHERE penelitian_id='.$penelitianID.' AND dosen_id='.$dosen_id            
        );

        $data = [
            'title' => "Penelitian & Pengabdian dari ",
            'dosen' => $this->dosenModel->searchDosen($dosen_id),
            'data_penelitian'=> $this->penelitianModel->searchPenelitian($dosen_id),
            'data_pengabdian'=> $this->pengabdianModel->searchPengabdian($dosen_id),
        ];
        return view('admin/plpb', $data);
    }

    public function pbsetuju($pengabdianID,$dosen_id){     
        $db = \Config\Database::connect();
        $db->query('
            UPDATE usulan_pengabdian SET status=1 
            WHERE id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_dosen_pb SET status=1 
            WHERE pengabdian_id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_vokasi SET status=1 
            WHERE pengabdian_id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_mahasiswa SET status=1 
            WHERE pengabdian_id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );

        $data = [
            'title' => "Penelitian & Pengabdian dari ",
            'dosen' => $this->dosenModel->searchDosen($dosen_id),
            'data_penelitian'=> $this->penelitianModel->searchPenelitian($dosen_id),
            'data_pengabdian'=> $this->pengabdianModel->searchPengabdian($dosen_id),
        ];
        return view('admin/plpb', $data);
    }

    public function pbditolak($pengabdianID,$dosen_id){     
        $db = \Config\Database::connect();
        $db->query('
            UPDATE usulan_pengabdian SET status=0 
            WHERE id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_dosen_pb SET status=0 
            WHERE pengabdian_id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_vokasi SET status=0 
            WHERE pengabdian_id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );
        $db->query('
            UPDATE anggota_mahasiswa SET status=0 
            WHERE pengabdian_id='.$pengabdianID.' AND dosen_id='.$dosen_id            
        );

        $data = [
            'title' => "Penelitian & Pengabdian dari ",
            'dosen' => $this->dosenModel->searchDosen($dosen_id),
            'data_penelitian'=> $this->penelitianModel->searchPenelitian($dosen_id),
            'data_pengabdian'=> $this->pengabdianModel->searchPengabdian($dosen_id),
        ];
        return view('admin/plpb', $data);
    }

    public function registrasi(){       
        $data = [
            'title' => "Daftar Pengguna Baru Penelitian dan Pengabdian<br/>Stikep PPNI Jawa Barat",
            'validation'=> \Config\Services::validation()
        ];
        //dd($data);
        return view('form/registrasi', $data);        
    }
    
    public function listUser(){
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data = [
            'title' => "List User yg Mendaftar",
            'users' => $this->userModel->search(),
            'paginates' => $this->userModel->paginate(5,'user'),
            'pager' => $this->userModel->pager,
            'currentPage' => $currentPage
        ];
        //dd($data);
        return view('list/users', $data);   
    }

    public function listPenelitian(){
        $keyword = $this->request->getVar('keyword');        
        if ($keyword){
            $this->penelitianModel->searchPenelitian(user_id(),$keyword);
        } else {
            $this->penelitianModel->searchPenelitian(user_id());
        }
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data = [
            'title' => "List Penelitian",
            'dosen' => $this->dosenModel->searchDosen(user_id()),
            'data_penelitian'=> $this->penelitianModel->searchPenelitian(user_id()),
            'penelitian'  => $this->penelitianModel->paginate(5, 'user'),
            'pager' => $this->penelitianModel->pager,
            'currentPage' => $currentPage
        ];
        //dd($data);
        return view('list/penelitian', $data);   
    }

    public function listPenelitianReject(){
        $this->penelitianModel->searchPenelitianReject();
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data = [
            'title' => "List Penelitian yang Ditolak",
            'dosen' => $this->dosenModel->searchDosen(user_id()),
            'data_penelitian'=> $this->penelitianModel->searchPenelitianReject(),
            'penelitian'  => $this->penelitianModel->paginate(5, 'user'),
            'pager' => $this->penelitianModel->pager,
            'currentPage' => $currentPage
        ];
        //dd($data);
        return view('list/penelitian_reject', $data);   
    }

    public function listPengabdian(){
        $keyword = $this->request->getVar('keyword');        
        if ($keyword){
            $this->pengabdianModel->searchPengabdian(user_id(),$keyword);
        } else {
            $this->pengabdianModel->searchPengabdian(user_id());
        }
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data = [
            'title' => "List Pengabdian",
            'dosen' => $this->dosenModel->searchDosen(user_id()),
            'data_pengabdian'=> $this->pengabdianModel->searchPengabdian(user_id()),
            'pengabdian'  => $this->pengabdianModel->paginate(5, 'user'),
            'pager' => $this->pengabdianModel->pager,
            'currentPage' => $currentPage
        ];
        //dd($data);
        return view('list/pengabdian', $data);   
    }

    public function listPengabdianReject(){
        $this->pengabdianModel->searchPengabdianReject();
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data = [
            'title' => "List Pengabdian yang Ditolak",
            'dosen' => $this->dosenModel->searchDosen(user_id()),
            'data_pengabdian'=> $this->pengabdianModel->searchPengabdianReject(),
            'pengabdian'  => $this->pengabdianModel->paginate(5, 'user'),
            'pager' => $this->pengabdianModel->pager,
            'currentPage' => $currentPage
        ];
        //dd($data);
        return view('list/pengabdian_reject', $data);   
    }

    public function detpl($penelitianID,$dosen_id) {
        $data = [
            'title' => "Detail Data Penelitian",
            'penelitianID' => $penelitianID,
            'dosen_id' => $dosen_id,
            'data_penelitian'=> $this->penelitianModel->searchJudulPenelitian($penelitianID)
        ];
        return view('detail/detpl', $data);        
    }

    public function detpb($pengabdianID,$dosen_id) {
        $data = [
            'title' => "Detail Data Pengabdian",
            'pengabdianID' => $pengabdianID,
            'dosen_id' => $dosen_id,
            'data_pengabdian'=> $this->pengabdianModel->searchJudulPengabdian($pengabdianID)
        ];
        return view('detail/detpb', $data);        
    }
    
    public function inpl($penelitianID,$dosen_id) {
        $db = \Config\Database::connect();
        $tableAnggota="anggota_dosen_".user_id();
        $ {'anggota'.$penelitianID} = $this->anggotaModel->copyTable($db,$tableAnggota,$penelitianID,$dosen_id);
        ${'nonDosen'.$penelitianID} = $this->nonDosenModel->searchAnggota($penelitianID,$dosen_id);
        ${'substansi'.$penelitianID} = $this->substansiModel->searchSubstansi($penelitianID,$dosen_id);
        ${'rab_detail'.$penelitianID} = $this->rabModel->searchRab($penelitianID,$dosen_id);
        ${'mitra'.$penelitianID} = $this->mitraModel->searchMitra($penelitianID,$dosen_id);

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;        

        $data = [
            'title' => "Input Data Penelitian",
            'judul'=> $this->penelitianModel->searchJudulPenelitian($penelitianID),
            'id'=> $penelitianID,
            'dosen_id'=>$dosen_id,

            //for Anggota Dosen
            'anggota_'.$penelitianID => $ {'anggota'.$penelitianID},
            'paginate_'.$penelitianID => $this->anggotaModel->paginate(5, 'user'),
            'pager' => $this->anggotaModel->pager,
            'currentPage' => $currentPage,

            // Non Dosen
            'nonDosen_'.$penelitianID => ${'nonDosen'.$penelitianID},
            'paginate_nondosen' => $this->nonDosenModel->paginate(5, 'user'),
            'pager_nondosen' => $this->nonDosenModel->pager,
            'currentPage' => $currentPage,

            //Subtansi
            'substansi_'.$penelitianID => ${'substansi'.$penelitianID},
            'paginate_substansi' => $this->substansiModel->paginate(5, 'user'),
            'pager_substansi' => $this->substansiModel->pager,
            'currentPage' => $currentPage,
            
            //RAB
            'rab_'.$penelitianID => ${'rab_detail'.$penelitianID},
            'paginate_rab' => $this->rabModel->paginate(5, 'user'),
            'pager_rab' => $this->rabModel->pager,
            'currentPage' => $currentPage,
            
            //Mitra
            'mitra_'.$penelitianID => ${'mitra'.$penelitianID},
            'paginate_mitra' => $this->mitraModel->paginate(5, 'user'),
            'pager_mitra' => $this->mitraModel->pager,
            'currentPage' => $currentPage,
        ];
        return view('detail/inpl', $data);        
    }

    public function inpb($pengabdianID,$dosen_id) {
        $data = [
            'title' => "Input Data Pengabdian",
            'judul'=> $this->pengabdianModel->searchJudulPengabdian($pengabdianID),
            'id'=> $pengabdianID,
            'dosen_id'=>$dosen_id,
        ];
        return view('detail/inpb', $data);        
    }
    
    public function currURL(){
        $currURL = $this->request->getVar('currURL');
    }

}
