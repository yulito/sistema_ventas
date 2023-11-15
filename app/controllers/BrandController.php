<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Helpers\Msg;

class BrandController extends Controller{

    public function index(){
        
        return $this->view('addbrand');
    }

    public function store(){
        $this->headJson();
        $this->validateToken($_POST['token_']);   

        $brand = !empty($_POST['nameBrand']) ? $_POST['nameBrand'] : null;

        $msg['msg'] = [];
        if($brand == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        if(empty($msg['msg'])){
            $obj = new Brand();
            $result = $obj->verify($brand);
            if(!$result){
                $obj->setBrand(ucfirst($brand));
                $obj->save();                
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['exist'] = Msg::NAME_EXIST;
            }            
        }
        echo json_encode($msg['msg']);        
        
    }

    public function showEdit($id){

        $obj = new Brand();
        $brand = $obj->getOne($id);
        return $this->view('editbrand', compact("brand"));
    }

    public function edit(){
        $this->headJson();
        $this->validateToken($_POST['token_']); 
        
        $id = !empty($_POST['idbrand']) ? $_POST['idbrand'] : null;
        $brand = !empty($_POST['brand']) ? $_POST['brand'] : null;

        $msg['msg'] = [];
        if($brand == null || $id == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        else{            
            $obj = new Brand();            
            $obj->setBrand(ucfirst($brand));
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