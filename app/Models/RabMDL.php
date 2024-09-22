<?php

namespace App\Models;

use CodeIgniter\Model;

class RabMDL extends Model
{
    protected $table = 'rab';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id', 'tahun',
                                'dana_direncanakan','dana_disetujui'];

    public function searchRab($penelitianID,$dosen_id){
        $this->join('rab_detail','rab.id=rab_detail.rab_id');
        $this->where(['penelitian_id'=>$penelitianID,'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delRab($id){        
        $this->delete(['id'=>$id]);
    }

}
