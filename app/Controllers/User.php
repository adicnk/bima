<?php

namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\PenelitianMDL;


class User extends BaseController
{

    protected $dosenModel, $penelitianModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
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
            'penelitian'  => $this->penelitianModel->paginate(5, 'penelitian'),
            'pager' => $this->penelitianModel->pager,
            'currentPage' => $currentPage
        ];
        //dd($data);
        return view('list/penelitian', $data);   
    }
    
    public function profile()
    {
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $data = [
            'title' => "PAIT @ PPNI",
            'user' => $this->userModel->searhAdminID(session()->get('userID')),
            'nilai_ratarata' => $this->latihanModel->nilaiRatarata(session()->get('userID'))
        ];
        return view('exercise/profile', $data);
    }

    public function info()
    {
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $data = [
            'title' => "PAIT @ PPNI"
        ];
        return view('exercise/info', $data);
    }

    public function about()
    {
        return view('exercise/about');
    }

}
