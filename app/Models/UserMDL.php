<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMDL extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id'];

    public function dosenID($id)
    {
        $this->where(['id' => $id]);
        $query = $this->findAll();
        foreach ($query as $qry) {
            if ($qry) {
                return $qry['id'];
            } else {
                return false;
            }
        }
    }

    public function addDosenID($id,$val=null){
        $val=$id;
        $this->where(['id' => $id]);
        $query = $this->findAll();
        foreach ($query as $q) {
            $q['dosen_id']=$val;
            $this->set('dosen_id', $val);
            $this->update();            
        }
    }

}
