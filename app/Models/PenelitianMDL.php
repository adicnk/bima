<?php

namespace App\Models;

use CodeIgniter\Model;

class PenelitianMDL extends Model
{
    protected $table = 'usulan_penelitian';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','judul','file','bidang_fokus','ruang_lingkup','skema',
                                'tahun_usulan','tahun_pelaksanaan','lama','tema','topik','rumpun_ilmu',
                                'target_tkt'];

    public function searchPenelitian($dosenID, $keyword=false)
    {
        $this->where(['dosen_id' => $dosenID]);
        if ($keyword == false) {
            return $this->findall();            
        } else {
            return  $this->like('judul', $keyword);
        }        
    }

    public function searchPenelitianReject()
    {
        $this->where(['status' => 0]);
        return $this->findall();            
    }    

    public function searchJudulPenelitian($penelitianID){
        $this->where(['id' => $penelitianID]);
        return $this->findall();            
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

    public function countPL(){
        return $this->countAllResults();
    }

    public function setujuPL(){
        $this->where(['status' => 1]);
        return $this->countAllResults();
    }

    public function tolakPL(){
        $this->where(['status' => 0]);
        return $this->countAllResults();
    }

}
