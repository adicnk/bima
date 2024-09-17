<?php
namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\AnggotaMDL;
use App\Models\NonDosenMDL;
use App\Models\SubstansiMDL;
use App\Models\PenelitianMDL;


class Delete extends BaseController
{

    protected $dosenModel, $anggotaModel, $nonDosenModel, $substansiModel, $penelitianModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
        $this->anggotaModel = new AnggotaMDL();
        $this->nonDosenModel = new NonDosenMDL();
        $this->substansiModel = new SubstansiMDL();
        $this->penelitianModel = new PenelitianMDL();
    }

    public function anggotaDosen($penelitianID,$dosen_id,$anggotaID)
    {
        $this->anggotaModel->delAnggota($anggotaID);
        $data = $this->dataAnggotaNon($penelitianID,$dosen_id);
        return view('detail/inpl', $data);

    }

    public function nonDosen($penelitianID,$dosen_id,$anggotaID)
    {
        $this->nonDosenModel->delAnggota($anggotaID);
        $data = $this->dataAnggotaNon($penelitianID,$dosen_id);
        return view('detail/inpl', $data);
    }

    public function dataAnggotaNon($penelitianID,$dosen_id){
        $ {'anggota'.$penelitianID} = $this->anggotaModel->copyTable(null,null,$penelitianID,$dosen_id);
        ${'nonDosen'.$penelitianID} = $this->nonDosenModel->searchAnggota($penelitianID,$dosen_id);
        ${'substansi'.$penelitianID} = $this->substansiModel->searchSubstansi($penelitianID);

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;        
        $currentPage_nondosen = $this->request->getVar('page_user_nondosen') ? $this->request->getVar('page_user_nondosen') : 1;        
        $data = [
            'title' => "Input Data Penelitian",
            'judul'=> $this->penelitianModel->searchJudulPenelitian($penelitianID),
            'id'=> $penelitianID,
            'dosen_id'=>$dosen_id,


            //for Anggota Dosen
            'anggota_'.$penelitianID => $ {'anggota'.$penelitianID},
            'paginate_'.$penelitianID => $this->anggotaModel->paginate(5, 'user'),
            'pager' => $this->anggotaModel->pager,
            'currentPage' => $currentPage,

            // Non Dosen
            'nonDosen_'.$penelitianID => ${'nonDosen'.$penelitianID},
            'paginate_nondosen' => $this->nonDosenModel->paginate(5, 'user'),
            'pager_nondosen' => $this->nonDosenModel->pager,
            'currentPage_nondosen' => $currentPage_nondosen,

            //Subtansi
            'substansi_'.$penelitianID => ${'substansi'.$penelitianID},
            'paginate_nondosen' => $this->nonDosenModel->paginate(5, 'user'),
            'pager_nondosen' => $this->nonDosenModel->pager,
            'currentPage_nondosen' => $currentPage_nondosen
        ];
        return $data;
    }
    
}

