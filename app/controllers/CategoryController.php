<?php

namespace App\Controllers;

use App\Models\Category;
use App\Helpers\Msg;

class CategoryController extends Controller{

    public function index(){
        if($_SESSION['auth']){
            return $this->view('addcat');
        }else{
            return $this->redirect('/');
        }        
    }

    public function store(){
        $this->headJson();
        $this->validateToken($_POST['token_']);   

        $cat = !empty($_POST['nameCat']) ? $_POST['nameCat'] : null;

        $msg['msg'] = [];
        if($cat == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        if(empty($msg['msg'])){
            $obj = new Category();
            $result = $obj->verify($cat);
            if(!$result){
                $obj->setCat(ucfirst($cat));
                $obj->save();                
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['exist'] = Msg::NAME_EXIST;
            }            
        }
        echo json_encode($msg['msg']);        
        
    }

    public function showEdit($id){
        if($_SESSION['auth']){
            $obj = new Category();
            $cat = $obj->getOne($id);            
            if($cat){
                return $this->view('editcat', compact("cat"));
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
        
        $id = !empty($_POST['idcat']) ? $_POST['idcat'] : null;
        $cat = !empty($_POST['cat']) ? $_POST['cat'] : null;

        $msg['msg'] = [];
        if($cat == null || $id == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        else{            
            $obj = new Category();            
            $obj->setCat(ucfirst($cat));
            $result = $obj->update($id);
            if($result){
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['fail'] = Msg::FAILED_OPERATION;
            }            
        }
        echo json_encode($msg['msg']);
    }
}