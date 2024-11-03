<?php

namespace App\Models;

use CodeIgniter\Model;

class FilePBMDL extends Model
{
    protected $table = 'pendukung';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','jenis','file'];

    public function searchPendukung($pengabdianID,$dosen_id){
        $this->where(['pengabdian_id'=>$pengabdianID,'dosen_id'=>$dosen_id]);
        return $this->findAll();
    }

    public function delAnggota($id){        
        $this->delete(['id'=>$id]);
    }

    public function searchUploadPendukung($name){
        $this->like('file', $name);
        $sumRows = $this->countAllResults();
        if ($sumRows==0) {
            return 1;
        } else {
            return $sumRows+1;
        };
    }    

}
