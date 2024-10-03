<?php
namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\AnggotaMDL;
use App\Models\NonDosenMDL;
use App\Models\SubstansiMDL;
use App\Models\RabMDL;
use App\Models\RabDetailMDL;
use App\Models\MitraMDL;
use App\Models\PenelitianMDL;


class Delete extends BaseController
{

    protected $dosenModel, $anggotaModel, $nonDosenModel, $substansiModel, $penelitianModel,
                $rabModel, $rabDetailModel, $mitraModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
        $this->anggotaModel = new AnggotaMDL();
        $this->nonDosenModel = new NonDosenMDL();
        $this->substansiModel = new SubstansiMDL();
        $this->rabModel = new RabMDL();
        $this->rabDetailModel = new RabDetailMDL();
        $this->mitraModel = new MitraMDL();
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

    public function substansi($penelitianID,$dosen_id,$id)
    {
        $this->substansiModel->delAnggota($id);
        $data = $this->dataAnggotaNon($penelitianID,$dosen_id);
        return view('detail/inpl', $data);
    }

    public function rab($penelitianID,$dosen_id,$id)
    {
        $this->rabModel->where(['penelitian_id'=>$penelitianID, 'dosen_id'=>$dosen_id]);
        $query = $this->rabModel->findAll();
        foreach ($query as $qry) :
            $this->rabDetailModel->delRab($qry['id']);
        endforeach;
        $this->rabModel->delRab($penelitianID,$dosen_id);
        $data = $this->dataAnggotaNon($penelitianID,$dosen_id);
        return view('detail/inpl', $data);
    }

    public function item($penelitianID,$dosen_id,$id)
    {
        $this->rabDetailModel->delItem($id);

        $this->rabDetailModel->selectSum('total');
        $query=$this->rabDetailModel->findAll();
        $idx=1;
        foreach ($query as $qry) :
            if ($idx==1) :
                $total = $qry['total'];
        endif; endforeach;
        $db = \Config\Database::connect();
        $db->query('
            UPDATE rab SET dana_direncanakan='.$total.
            ' WHERE penelitian_id='.$penelitianID.' AND dosen_id='.$dosen_id
        );        

        $data = $this->dataAnggotaNon($penelitianID,$dosen_id);
        return view('detail/inpl', $data);
    }

    public function mitra($penelitianID,$dosen_id,$id)
    {
        $this->mitraModel->delMitra($id);
        $data = $this->dataAnggotaNon($penelitianID,$dosen_id);
        return view('detail/inpl', $data);
    }

    public function dataAnggotaNon($penelitianID,$dosen_id){
        $ {'anggota'.$penelitianID} = $this->anggotaModel->copyTable(null,null,$penelitianID,$dosen_id);
        ${'nonDosen'.$penelitianID} = $this->nonDosenModel->searchAnggota($penelitianID,$dosen_id);
        ${'substansi'.$penelitianID} = $this->substansiModel->searchSubstansi($penelitianID,$dosen_id);
        ${'rab_detail'.$penelitianID} = $this->rabModel->searchRab($penelitianID,$dosen_id);
        ${'mitra'.$penelitianID} = $this->mitraModel->searchMitra($penelitianID,$dosen_id);

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;        

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
            'currentPage' => $currentPage,

            //Subtansi
            'substansi_'.$penelitianID => ${'substansi'.$penelitianID},
            'paginate_substansi' => $this->substansiModel->paginate(5, 'user'),
            'pager_substansi' => $this->substansiModel->pager,
            'currentPage' => $currentPage,
            
            //RAB
            'rab_'.$penelitianID => ${'rab_detail'.$penelitianID},
            'paginate_rab' => $this->rabModel->paginate(5, 'user'),
            'pager_rab' => $this->rabModel->pager,
            'currentPage' => $currentPage,
            
            //Mitra
            'mitra_'.$penelitianID => ${'mitra'.$penelitianID},
            'paginate_mitra' => $this->mitraModel->paginate(5, 'user'),
            'pager_mitra' => $this->mitraModel->pager,
            'currentPage' => $currentPage,
        ];
        return $data;
    }
    
}

