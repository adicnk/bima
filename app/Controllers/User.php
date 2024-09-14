<?php

namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\AnggotaMDL;
use App\Models\NonDosenMDL;
use App\Models\PenelitianMDL;


class User extends BaseController
{

    protected $dosenModel, $anggotaModel, $nonDosenModel, $penelitianModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
        $this->anggotaModel = new AnggotaMDL();
        $this->nonDosenModel = new NonDosenMDL();
        $this->penelitianModel = new PenelitianMDL();
    }

    public function index()
    {
        $dosenID = user()->dosen_id;
        if ($dosenID == null) {
            $data = [
                'title' => "Silahkan Isi Profile Data Anda Dulu"
            ];
            return view('user/baru', $data);            
        }
        
        $data = [
            'title' => "Dashboard",
            'dosen' => $this->dosenModel->searchDosen(user_id())
        ];
        return view('user/dashboard', $data);
    }


    public function registrasi(){       
        $data = [
            'title' => "Daftar Pengguna Baru Penelitian dan Pengabdian<br/>Stikep PPNI Jawa Barat",
            'validation'=> \Config\Services::validation()
        ];
        //dd($data);
        return view('form/registrasi', $data);        
    }

    public function usulanPenelitian(){       
        $data = [
            'title' => "Form Isian Usulan Penlitian<br/>Stikep PPNI Jawa Barat",
            'validation'=> \Config\Services::validation()
        ];
        //dd($data);
        return view('form/usulanPenelitian', $data);        
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

    public function detpl($penelitianID) {
        $data = [
            'title' => "Detail Data Penelitian",
            'penelitianID' => $penelitianID,
            'data_penelitian'=> $this->penelitianModel->searchJudulPenelitian($penelitianID)
        ];
        return view('detail/detpl', $data);        
    }
    
    public function inpl($penelitianID) {
        $db = \Config\Database::connect();
        $tableAnggota="anggota_dosen_".user_id();
        $ {'anggota'.$penelitianID} = $this->anggotaModel->copyTable($db,$tableAnggota,$penelitianID);
        $nonDosen = $this->nonDosenModel->searchAnggota($penelitianID);

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;        
        $currentPage_nondosen = $this->request->getVar('page_user_nondosen') ? $this->request->getVar('page_user_nondosen') : 1;        
        $data = [
            'title' => "Input Data Penelitian",
            'judul'=> $this->penelitianModel->searchJudulPenelitian($penelitianID),
            'id'=> $penelitianID,

            //for Anggota Dosen
            'anggota_'.$penelitianID => $ {'anggota'.$penelitianID},
            'paginate_'.$penelitianID => $this->anggotaModel->paginate(5, 'user'),
            'pager' => $this->anggotaModel->pager,
            'currentPage' => $currentPage,

            // Non Dosen
            'nonDosen' => $nonDosen,
            'paginate_nondosen' => $this->nonDosenModel->paginate(5, 'user'),
            'pager_nondosen' => $this->nonDosenModel->pager,
            'currentPage_nondosen' => $currentPage_nondosen
        ];
        return view('detail/inpl', $data);        
    }
    
    public function currURL(){
        $currURL = $this->request->getVar('currURL');
    }

}
