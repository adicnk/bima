<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraMDL extends Model
{
    protected $table = 'mitra';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','nama','institusi',
                                'alamat','email','file'];

    public function searchMitra($penelitianID,$dosen_id){
        $this->where(['penelitian_id'=>$penelitianID,'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delMitra($id){        
        $this->delete(['id'=>$id]);
    }

    public function searchUploadMitra($name){
        $this->like('file', $name);
        $sumRows = $this->countAllResults();
        if ($sumRows==0) {
            return 1;
        } else {
            return $sumRows+1;
        };
    }    

}
