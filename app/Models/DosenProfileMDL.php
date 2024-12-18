<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenProfileMDL extends Model
{
    protected $table = 'dosen_profile';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian','pengabdian','artikel_internasional',
                                'hki','buku'];

    public function searchDosen($keyword = false)
    {
        $this->join('dosen_profile', 'dosen.id = id');
        if ($keyword == false) {
            return $this->findall();            
        } else {
            return  $this->like('name', $keyword);
        }        
    }

    public function profileID($id){
        $this->where(['dosen_id' => $id]);
        $query = $this->findAll();
        foreach ($query as $qry) {
            if ($qry) {
                return $qry['id'];
            } else {
                return false;
            }
        }
    }

    public function statusDosen($id)
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

    public function delDosen($id)
    {
        $this->delete(['id' => $id]);
    }

    public function countPeneliti()
    {
        $this->where(['status' => 2]);
        // dd($this->findAll());
        return $this->countAllResults();
    }

    public function countPenilai()
    {
        $this->where(['status' => 3]);
        // dd($this->countAllResults());
        return $this->countAllResults();
    }

    public function countAdmin()
    {
        $this->table('user');
        $this->where(['status' => 3]);
        // dd($this->countAllResults());
        return $this->countAllResults();
    }
}
