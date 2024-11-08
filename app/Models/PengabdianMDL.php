<?php

namespace App\Models;

use CodeIgniter\Model;

class PengabdianMDL extends Model
{
    protected $table = 'usulan_pengabdian';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','judul','file','bidang_fokus','ruang_lingkup','skema',
                                'tahun_usulan','tahun_pelaksanaan','lama','rumpun_ilmu'];

    public function searchPengabdian($dosenID, $keyword=false)
    {
        $this->where(['dosen_id' => $dosenID]);
        if ($keyword == false) {
            return $this->findall();            
        } else {
            return  $this->like('judul', $keyword);
        }        
    }

    public function searchJudulPengabdian($pengabdianID){
        $this->where(['id' => $pengabdianID]);
        return $this->findall();            
    }

    public function searchUploadPengabdian($name){
        $this->like('file', $name);
        $sumRows = $this->countAllResults();
        if ($sumRows==0) {
            return 1;
        } else {
            return $sumRows+1;
        };
    }

    public function statusPengabdian($id)
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

    public function delPengabdian($id)
    {
        $this->delete(['id' => $id]);
    }

    public function countPB(){
        return $this->countAllResults();
    }

    public function setujuPB(){
        $this->where(['status' => 1]);
        return $this->countAllResults();
    }

    public function tolakPB(){
        $this->where(['status' => 0]);
        return $this->countAllResults();
    }
}
