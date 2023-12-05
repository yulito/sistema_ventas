<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Msg;

class UserController extends Controller{

    public function index(){
        if($_SESSION['auth']){
            return $this->view('userAdmin');
        }else{
            return $this->redirect('/');
        }                 
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

    public function viewEdit($name){  
        if(isset($_SESSION['auth'])){
            $name = str_replace("0y0", " ", $name);
            $obj = new User();
            $user = $obj->validateName($name);
            if($user){
                return $this->view('editUser', compact("user"));
            }else{
                $msg = Msg::ERROR_404;
                return $this->view('error/page404', compact("msg"));
            }
        }else{
            return $this->redirect('/');
        }                
    }

    public function edit(){

        $this->headJson();
        $this->validateToken($_POST['token_']); 
        
        $id = !empty($_POST['idUser']) ? $_POST['idUser'] : null;
        $name = !empty($_POST['nameUser']) ? $_POST['nameUser'] : null;
        $type = !empty($_POST['type']) ? $_POST['type'] : null;
        $pass = isset($_POST['password']) ? $_POST['password'] : null;

        $msg['msg'] = [];
        if($name == null || $type == null || $id == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        else{
            $param = false;
            $obj = new User();
            if($pass != null || !empty($pass)){
                $obj->setPassword($pass);
                $param = true;
            }
            $obj->setName($name);
            $obj->setType($type);
            $obj->update($id, $param);
            $msg['msg']['success'] = Msg::MSG_SUCCESS;
        }

        echo json_encode($msg['msg']);
       
    }
}