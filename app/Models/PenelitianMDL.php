<?php

namespace App\Models;

use CodeIgniter\Model;

class PenelitianMDL extends Model
{
    protected $table = 'usulan';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','judul','file'];

    public function searchPenelitian($keyword = false)
    {
        $this->join('dosen', 'dosen.id = dosen_id');
        $this->join('dosen_profile', 'dosen_profile.dosen_id = ');
        if ($keyword == false) {
            return $this->findall();            
        } else {
            return  $this->like('name', $keyword);
        }        
    }

    public function statusPenelitian($id)
    {
        $this->where(['id' => $id]);
        $query = $this->findAll();
        foreach ($query as $qry) {
            if ($qry) {
                return $qry['status'];
            } else {
                return false;
            }
        }
    }

    public function delPenelitian($id)
    {
        $this->delete(['id' => $id]);
    }

}
