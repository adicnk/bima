<?php

namespace App\Controllers;

use App\Models\ConfigMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\KategoriMDL;
use App\Models\LatihanMDL;
use App\Models\LoginMDL;
use App\Models\UserMDL;
use App\Models\KategoriMDLMDL;
use App\Models\UserSubcribeMDL;

class Exercise extends BaseController
{

    protected $soalModel, $configModel, $jawabanModel, $latihanModel, $loginModel, $userModel, $kategoriModel, $userSubcribeModel;

    public function __construct()
    {
        $this->soalModel = new SoalMDL();
        $this->jawabanModel = new JawabanMDL();
        $this->configModel = new ConfigMDL();
        $this->latihanModel = new LatihanMDL();
        $this->loginModel = new LoginMDL();
        $this->userModel = new UserMDL();
        $this->kategoriModel = new KategoriMDL();
        $this->userSubcribeModel = new UserSubcribeMDL();
    }

    public function index()
    {
        $data = [
            'title' => "USER LOGIN"
        ];

        return view('exercise/login', $data);
    }
 
    public function login()
    {
        $usr = $this->request->getVar('username');
        $pwd = $this->request->getVar('password');

        if (!$usr or !$pwd) {
            $data = [
                'title' => 'Login Status',
                'login' => $this->loginModel->index()
            ];
            return view('exercise/relogin', $data);
        } else {
            $loginStatus = $this->userModel->statusLogin($usr, $pwd);


            if ($loginStatus) {
                session()->set('userID', $loginStatus);
                $data = [
                    'title'   => "Dashboard"
                ];
                return view('exercise/getdashboard', $data);
            } else {
                $data = [
                    'title' => 'Login Status',
                    'login' => $this->loginModel->index(),                   
                ];
                return view('exercise/relogin', $data);
            }
        }
    }

    public function dashboard()
    {
        if (session()->start==false):
            session()->set('start', true);
            $start=0;
            if ($start==1) :
                $data = [
                    'title' => "USER LOGIN"
                ];
                return view('exercise/login', $data);            
            endif;
        endif;
        
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }
    }

    public function registrasi(){       
        $data = [
            'title' => "Daftar Pengguna Baru Penelitian dan Pengabdian<br/>Stikep PPNI Jawa Barat",
            'validation'=> \Config\Services::validation()
        ];
        //dd($data);
        return view('form/registrasi', $data);        
    }

    public function daftarDosen(){       
        $data = [
            'title' => "Form Isian Dosen Penelitian dan Pengabdian<br/>Stikep PPNI Jawa Barat",
            'validation'=> \Config\Services::validation()
        ];
        //dd($data);
        return view('form/daftarDosen', $data);        
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
