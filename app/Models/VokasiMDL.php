<?php

namespace App\Models;

use CodeIgniter\Model;

class VokasiMDL extends Model
{
    protected $table = 'anggota_vokasi';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','jenis','ktp','nama',
                                'institusi','tugas','status'];

    public function searchAnggota($id,$dosen_id){        
        $this->where(['pengabdian_id'=>$id, 'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delAnggota($id){        
        $this->delete(['id'=> $id]);
    }

}
