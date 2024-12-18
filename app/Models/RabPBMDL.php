<?php

namespace App\Models;

use CodeIgniter\Model;

class RabPBMDL extends Model
{
    protected $table = 'rab_pb';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id', 'tahun',
                                'dana_direncanakan','dana_disetujui'];

    public function searchRab($pengabdianID,$dosen_id){
        $this->join('rab_detail','rab.id=rab_detail.rab_id');
        $this->where(['penelitian_id'=>$pengabdianID,'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delRab($pen,$dosen){ 
        $this-> where(['pengabdian_id'=>$pen, 'dosen_id'=>$dosen]);
        $this->delete();
    }

}
