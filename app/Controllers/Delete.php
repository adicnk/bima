<?php
namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\AnggotaMDL;
use App\Models\NonDosenMDL;
use App\Models\PenelitianMDL;


class Delete extends BaseController
{

    protected $dosenModel, $anggotaModel, $nonDosenModel, $penelitianModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
        $this->anggotaModel = new AnggotaMDL();
        $this->nonDosenModel = new NonDosenMDL();
        $this->penelitianModel = new PenelitianMDL();
    }

    public function anggotaDosen($penelitianID,$anggotaID)
    {
        $this->anggotaModel->delAnggota($anggotaID);
        $data = $this->dataAnggotaNon($penelitianID);
        return view('detail/inpl', $data);

    }

    public function nonDosen($penelitianID,$anggotaID)
    {
        $this->nonDosenModel->delAnggota($anggotaID);
        $data = $this->dataAnggotaNon($penelitianID);
        return view('detail/inpl', $data);
    }

    public function dataAnggotaNon($penelitianID){
        $ {'anggota'.$penelitianID} = $this->anggotaModel->copyTable(null,null,$penelitianID);
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
        return $data;
    }
    
}

