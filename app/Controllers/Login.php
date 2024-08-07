<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\LoginMDL;


class Login extends BaseController
{
    protected $userModel, $loginModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->loginModel = new LoginMDL();
    }

    public function admin()
    {
        $data = [
            'title' => "Administrator",
            'user' => $this->userModel->searchAdmin()
        ];
        return view('admin/login', $data);
    }

    public function forgotPassword(){

    }

}