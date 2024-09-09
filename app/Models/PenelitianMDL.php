<?php

namespace App\Models;

use CodeIgniter\Model;

class PenelitianMDL extends Model
{
    protected $table = 'usulan_penelitian';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','judul','file','bidang_fokus','ruang_lingkup',
                                'tahun_usulan','tahun_pelaksanaan','lama','tema','topik','rumpun_ilmu',
                                'target_tkt'];

    public function searchPenelitian($dosenID, $keyword=false)
    {
        $this->where(['id' => $dosenID]);
        if ($keyword == false) {
            return $this->findall();            
        } else {
            return  $this->like('dosen_id', $keyword);
        }        
    }

    public function searchUploadPenelitian($name){
        $this->like('file', $name);
        $sumRows = $this->countAllResults();
        if ($sumRows==0) {
            return 1;
        } else {
            return $sumRows+1;
        };
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
