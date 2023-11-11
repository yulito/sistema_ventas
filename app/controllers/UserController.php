<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Msg;

class UserController extends Controller{

    public function index(){
        
        return $this->view('userAdmin');
    }

    public function store(){

        $this->headJson();
        $this->validateToken($_POST['token_']);

        $name = !empty($_POST['user']) ? $_POST['user'] : NULL;
        $pass = !empty($_POST['password']) ? $_POST['password'] : NULL;
        $type = isset($_POST['typeUser']) ? (int)$_POST['typeUser'] : NULL;

        $msg['msg'] = [];
        if($name == null || $pass == null || $type == null)
        {            
            $msg['msg']['field'] = Msg::EMPTY_FIELD;            
        }       
        if(strlen($pass) > 8 || strlen($pass) < 4){
            $msg['msg']['pass'] = Msg::PASS_LENGTH;
        }
        if($type <= 0 || $type > 3){
            $msg['msg']['type'] = Msg::TYPE_INCORRECT;
        }
        // agregar usuario
        if(empty($msg['msg']))
        {                        
            //validar nombre usuario
            $obj = new User();

            $resultName = $obj->validateName($name);
            if($resultName){
                $msg['msg']['name'] = Msg::NAME_EXIST;
            }            
            else{
                //crear usuario
                $obj->setName($name);
                $obj->setPassword($pass);
                $obj->setType($type);
                $result = $obj->save();

                $msg['msg']["user"] = $result;
                $msg['msg']['success'] = Msg::MSG_SUCCESS;   
            }                        
        }
        //---- Enviar msg
        echo json_encode($msg['msg']);

    }

    public function show(){
        $this->headJson();

        $obj = new User();
        $user = $obj->getAll();
        echo json_encode($user);
    }
}