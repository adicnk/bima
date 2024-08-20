<?php
namespace App\Controllers;

Use App\Models\UserMDL;
use App\Models\DosenMDL;
use App\Models\PenelitianMDL;

class dosenSubmit extends BaseController

{

    protected $userModel, $dosenModel, $penelitianModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->dosenModel = new DosenMDL();
        $this->penelitianModel = new PenelitianMDL();

    }

    public function dosen()

    {
        // dd($this->request->getVar());
        $dosen_id = user_id();

        $this->userModel->save([
            'dosen_id' => $dosen_id,
        ]);

        $this->dosenModel->save([
            'dosen_id' => $dosen_id,
        ]);

        //ID terakhir yg di buat di tabel user
        //$db      = \Config\Database::connect();
        //$lastID = $db->insertID();
    }

    public function penelitian()
    {
        //The attribute of File
        //$isFileUpload = $this->request->getVar('isFileUpload');

        //The File
        $isFileUpload = $this->request->getFile('isFileUpload');
        $namaFile = null;

        if ($isFileUpload) :
            // Pindahkan file ke folder file
            $isFileUpload->move('file');

            // Ambil nama file
            $namaFile = $isFileUpload->getName();
        endif;

        $this->penelitianModel->save([
            'judul' => $this->request->getVar('judulPenelitian'),
            'file' => $this->$namaFile
        ]);

    }
}

