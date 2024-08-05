<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMDL extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['dosen_id', 'status_id', 'username', 'password'];

    public function searchUser($keyword = false)
    {
        $this->table('user');
        $this->join('dosen', 'dosen.id = user.dosen_id');
        if ($keyword == false) {
            // dd($this->findall());
            $this->where(['role_id' => 1]); //User is Administrator
        } else {
            $this->where(['role_id' => 2]); //User is Dosen
        }
        return  $this->like('name', $keyword);
    }

    public function searchDosen($keyword = false)
    {
        if ($keyword == false) {
            $this->table('user');
            return  $this->where(['status_id' => 1]); // User is Mahasiswa
        }
        $this->table('user');
        $this->join('jurusan', 'jurusan.id = user.jurusan_id');
        return  $this->like('name', $keyword);
    }

    public function statusLogin($username, $password)
    {
        $this->like('username', $username);
        $this->like('password', $password);
        $query = $this->findAll();
        foreach ($query as $qry) {
            if ($qry) {
                return $qry['id'];
            } else {
                return false;
            }
        }
    }

    public function delUser($id)
    {
        $this->delete(['id' => $id]);
    }

    public function countAdmin()
    {
        $this->table('user');
        $this->where(['role_id' => 1]);
        // dd($this->findAll());
        return $this->countAllResults();
    }

    public function countDosen()
    {
        $this->table('user');
        $this->where(['status_id' => 1]);
        // dd($this->countAllResults());
        return $this->countAllResults();
    }

    public function countStaff()
    {
        $this->table('user');
        $this->where(['status_id' => 3]);
        // dd($this->countAllResults());
        return $this->countAllResults();
    }
}
