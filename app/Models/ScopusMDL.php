<?php

namespace App\Models;

use CodeIgniter\Model;

class ScopusMDL extends Model
{
    protected $table = 'scopus';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','scopus_id','h_index','articles','citation'];

    public function searchSinta($id)
    {
        $this->where(['id' => $id]);
        return $this->findAll();
 
    }
}
