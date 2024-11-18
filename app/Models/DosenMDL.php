<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenMDL extends Model
{
    protected $table = 'dosen';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['user_id','nama','nidn_nidk','klaster','institusi','program_studi',
                                'pendidikan','jabatan','alamat','tempat_lahir','tanggal_lahir',
                                'ktp','telp','hp','email','website','status'];

    public function searchDosen($keyword = false)
    {
        $this->join('dosen_profile', 'dosen.id = dosen_profile.dosen_id');
        $this->join('sinta','dosen.id = sinta.dosen_id');
        $this->join('scopus','dosen.id = scopus.dosen_id');
        if ($keyword == true) {
            $this->where(['dosen.user_id'=> $keyword]);
        } 
        //dd($this->findall());
        return $this->findall();            
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

    public function addDosenID($id,$val=null){
        $this->where(['id' => $id]);
        $query = $this->findAll();
        foreach ($query as $q) {
            $val = $q['dosen_id'];
            $this->set('dosen_id', $val);
            $this->update();            
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

    public function countDosenPL($dosen_id)
    {
        $this->join('usulan_penelitian', 'usulan_penelitian.dosen_id=dosen.id');
        $this->where(['usulan_penelitian.dosen_id'=>$dosen_id]);
        return $this->countAllResults();
    }

    public function countDosenPB($dosen_id)
    {
        $this->join('usulan_pengabdian', 'usulan_pengabdian.dosen_id=dosen.id');
        $this->where(['usulan_pengabdian.dosen_id'=>$dosen_id]);
        //dd($this->findall());
        return $this->countAllResults();
    }
}
