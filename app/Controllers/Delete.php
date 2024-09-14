<?php
namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\AnggotaMDL;
use App\Models\PenelitianMDL;


class Delete extends BaseController
{

    protected $dosenModel, $anggotaModel, $penelitianModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
        $this->anggotaModel = new AnggotaMDL();
        $this->penelitianModel = new PenelitianMDL();
    }

    public function anggotaDosen($penelitianID,$anggotaID)
    {
        $this->anggotaModel->delAnggota($anggotaID);
        
        $ {'anggota'.$penelitianID} = $this->anggotaModel->copyTable(null,null,$penelitianID);
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;        
        $data = [
            'title' => "Input Data Penelitian",
            'judul'=> $this->penelitianModel->searchJudulPenelitian($penelitianID),
            'id'=> $penelitianID,
            'anggota_'.$penelitianID => $ {'anggota'.$penelitianID},
            'paginate_'.$penelitianID => $this->anggotaModel->paginate(5, 'user'),
            'pager' => $this->anggotaModel->pager,
            'currentPage' => $currentPage
        ];
        return view('detail/inpl', $data);        
    }
    
}

