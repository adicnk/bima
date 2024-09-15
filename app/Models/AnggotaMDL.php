<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaMDL extends Model
{
    protected $table = 'anggota_dosen';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id','penelitian_id','nidn','nama','institusi',
                                'prodi','tugas'];

    public function copyTable($db,$tableAnggota,$penelitianID,$dosen_id){
        //$db->query('DROP TABLE IF EXISTS '.$tableAnggota);

        //$db->query('
          //  CREATE TABLE IF NOT EXISTS '.$tableAnggota.'(
            //    `id` INT(11) NOT NULL AUTO_INCREMENT,
            //    `penelitian_id` INT(11) NULL DEFAULT NULL,
            //    `dosen_id` INT(11) NULL DEFAULT NULL,
            //    `created_at` DATETIME NULL DEFAULT NULL,
            //    `updated_at` DATETIME NULL DEFAULT NULL,
            //    PRIMARY KEY (`id`) USING BTREE
        //    )
        //');
        
        $this->where('penelitian_id',$penelitianID);
        $this->where('dosen_id',$dosen_id);
        return $this->findAll();
        
        //$query=$this->findAll();
        
        //Make array with id penelitian from table anggota_dosen
        //dd(${'anggota_dosen_'.$penelitianID}[0]['dosen_id']);
        //${'anggota_dosen_'.$penelitianID} = $this->findAll();
    }

    public function delAnggota($id){        
        $this->delete(['id'=>$id]);
    }

}
