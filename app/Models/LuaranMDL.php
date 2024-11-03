<?php

namespace App\Models;

use CodeIgniter\Model;

class LuaranMDL extends Model
{
    protected $table = 'luaran_pb';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','tahun','kelompok',
                                'jenis','target_','keterangan'];

    public function searchAnggota($id,$dosen_id){        
        $this->where(['pengabdian_id'=>$id, 'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delAnggota($id){        
        $this->delete(['id'=> $id]);
    }

}
