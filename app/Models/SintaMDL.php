<?php

namespace App\Models;

use CodeIgniter\Model;

class SintaMDL extends Model
{
    protected $table = 'sinta';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','sinta_id','score','overall','3_year'];

    public function searchSinta($id)
    {
        $this->where(['id' => $id]);
        return $this->findAll();
 
    }
}
