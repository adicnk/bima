<?php

namespace App\Models;

use CodeIgniter\Model;

class RabDetailMDL extends Model
{
    protected $table = 'rab_detail';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['rab_id'];
   
    public function delRab($id){      
        $this-> where('rab_id',$id);
        $this->delete();
    }

    public function delItem($id){        
        $this->delete(['id'=>$id]);
    }

}
