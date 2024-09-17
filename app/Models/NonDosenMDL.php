<?php

namespace App\Models;

use CodeIgniter\Model;

class NonDosenMDL extends Model
{
    protected $table = 'anggota_non_dosen';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','jenis','ktp','nama',
                                'institusi','tugas','status'];

    public function searchAnggota($id,$dosen_id){        
        $this->where(['penelitian_id'=>$id, 'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delAnggota($id){        
        $this->delete(['id'=> $id]);
    }

}
