<?php

namespace App\Models;

use CodeIgniter\Model;

class SubstansiMDL extends Model
{
    protected $table = 'substansi_luaran';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','makro_riset','file','urutan_tahun',
                                'kelompok_luran','jenis_luaran','target','keterangan'];

    public function searchSubstansi($penelitianID){
        $this->where('penelitian_id',$penelitianID);
        return $this->findAll();
    }

    public function delAnggota($id){        
        $this->delete(['id'=>$id]);
    }

}
