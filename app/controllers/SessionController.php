<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Msg;

class SessionController extends Controller{

    public function index(){        
        if(isset($_SESSION['auth'])){
            return $this->view('dashboard');
        }else{
            return $this->view('login.login');
        }
    }
    public function login(){        
        $this->headJson();
        
        $name = !empty($_POST['user']) ? $_POST['user'] : NULL;
        $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
        
        $msg['msg'] = [];
        if($name == null || $password == null){
            $msg['msg']['field'] = Msg::EMPTY_FIELD;             
        }else{
            $obj = new User();
            $result = $obj->validatePassword($password,$name);
            if(!$result){
                $msg['msg']['fail'] = Msg::FAILED_OPERATION;
            }
            if(empty($msg['msg'])){                        
                $_SESSION['auth'] = $result;
                $msg['msg']['success'] = Msg::MSG_SUCCESS;           
            }            
        }
        echo json_encode($msg['msg']);          
    }
    public function logout()
    {
        unset($_SESSION['auth']);
        return $this->redirect('/');
    }
}