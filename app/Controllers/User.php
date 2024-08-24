<?php

namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\SoalMDL;


class User extends BaseController
{

    protected $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
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
