<?php


namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\KategoriMDL;
use App\Models\DosenMDL;
use App\Models\PenelitianMDL;
use App\Models\PengabdianMDL;

class Form extends BaseController
{
    protected $userModel, $kategoriModel, $dosenModel, $penelitianModel, $pengabdianModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        //$this->kategoriModel = new KategoriMDL();
        $this->dosenModel = new DosenMDL();
        $this->penelitianModel = new PenelitianMDL();
        $this->pengabdianModel = new PengabdianMDL();
    }

    public function addDosen(){       
        $data = [
            'title' => "Form Isian Dosen Penelitian dan Pengabdian<br/>Stikep PPNI Jawa Barat",
            'validation'=> \Config\Services::validation()
        ];
        //dd($data);
        return view('form/addDosen', $data);        
    }

    public function editDosen($id)
    {
        // d($this->request->getVar('url'));
        $data = [
            'title'   => "Form Isian Dosen Penelitian dan Pengabdian<br/>Stikep PPNI Jawa Barat",
            'dosen'    => $this->dosenModel->searchDosen($id),
            'validation'=> \Config\Services::validation(),
            //'kategori_soal' => $this->kategoriModel->findAll()
        ];        
        return view('form/editDosen', $data);
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

    public function editPenelitian($id)
    {
        // d($this->request->getVar('url'));
        $data = [
            'title'   => "Form Isian Penelitian<br/>Stikep PPNI Jawa Barat",
            'data'    => $this->penelitianModel->searchJudulPenelitian($id),
            //'kategori_soal' => $this->kategoriModel->findAll()
        ];        
        return view('form/editPenelitian', $data);
    }

    public function editPengabdian($id)
    {
        // d($this->request->getVar('url'));
        $data = [
            'title'   => "Form Isian Pengabdian<br/>Stikep PPNI Jawa Barat",
            'data'    => $this->pengabdianModel->searchJudulPengabdian($id),
            //'kategori_soal' => $this->kategoriModel->findAll()
        ];        
        return view('form/editPengabdian', $data);
    }

}
