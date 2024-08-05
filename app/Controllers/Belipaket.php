<?php

namespace App\Controllers;

use App\Models\ConfigMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\LatihanMDL;
use App\Models\LoginMDL;
use App\Models\UserMDL;
use App\Models\KategoriMDL;
use App\Models\UserSubcribeMDL;

class Belipaket extends BaseController
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

    public function index(){
        
        $paket = $this->request->getVar('soalClass');
        
        $userID = session()->get('userID');
            
        $data = [
            'title'   => "User Login",
        ];                                 

        $this->userSubcribeModel->save([
            'user_id' => $userID,
            'subcribe_id' => 2,
            'kategori_soal_id' => $paket,
            'is_request' => 1     
        ]);

        $data = [
            'title' => 'Beli Paket'
        ];

        return view('exercise/deal',$data);
    }
}