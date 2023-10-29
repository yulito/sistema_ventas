<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Msg;

class SessionController extends Controller{

    public function index(){
        return $this->view('login.login'); 
    }
}