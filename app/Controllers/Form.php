<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\KategoriMDL;

class Form extends BaseController
{
    protected $userModel, $kategoriModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        //$this->kategoriModel = new KategoriMDL();
    }

    public function addDosen(){       
        $data = [
            'title' => "Form Isian Dosen Penelitian dan Pengabdian<br/>Stikep PPNI Jawa Barat",
            'validation'=> \Config\Services::validation()
        ];
        //dd($data);
        return view('form/addDosen', $data);        
    }

    public function addPenelitian()
    {
        // d($this->request->getVar('url'));
        $data = [
            'title'   => "Form Isian Penelitian<br/>Stikep PPNI Jawa Barat",
            //'kategori_soal' => $this->kategoriModel->findAll()
        ];
        return view('form/addPenelitian', $data);
    }

    public function addPengabdian()
    {
        // d($this->request->getVar('url'));
        $data = [
            'title'   => "Form Isian Pengabdian<br/>Stikep PPNI Jawa Barat",
        ];
        return view('form/addPengabdian', $data);
    }
}
