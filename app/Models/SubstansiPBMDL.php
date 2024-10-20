<?php

namespace App\Models;

use CodeIgniter\Model;

class SubstansiPBMDL extends Model
{
    protected $table = 'substansi_pb';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','jenis','file'];

    public function searchSubstansi($penelitianID,$dosen_id){
        $this->where(['penelitian_id'=>$penelitianID,'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delAnggota($id){        
        $this->delete(['id'=>$id]);
    }

    public function searchUploadSubstansi($name){
        $this->like('file', $name);
        $sumRows = $this->countAllResults();
        if ($sumRows==0) {
            return 1;
        } else {
            return $sumRows+1;
        };
    }    

}
