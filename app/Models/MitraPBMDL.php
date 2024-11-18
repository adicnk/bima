<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraPBMDL extends Model
{
    protected $table = 'mitra_pb';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','nama','jenis','kelompok',
                                'dana_tahun_1','dana_tahun_2','dana_tahun_3'];

    public function searchAnggota($id,$dosen_id){        
        $this->where(['pengabdian_id'=>$id, 'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delMitra($id){        
        $this->delete(['id'=> $id]);
    }

}