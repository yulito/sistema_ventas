<?php

namespace App\Controllers;

use App\Models\Area;
use App\Helpers\Msg;

class AreaController extends Controller{

    public function index(){
        
        return $this->view('addarea');
    }

    public function store(){
        $this->headJson();
        $this->validateToken($_POST['token_']);   

        $area = !empty($_POST['nameArea']) ? $_POST['nameArea'] : null;

        $msg['msg'] = [];
        if($area == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        if(empty($msg['msg'])){
            $obj = new Area();
            $result = $obj->verify($area);
            if(!$result){
                $obj->setArea(ucfirst($area));
                $obj->save();                
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['exist'] = Msg::NAME_EXIST;
            }            
        }
        echo json_encode($msg['msg']);        
        
    }

    public function showEdit($id){

        $obj = new Area();
        $area = $obj->getOne($id);
        return $this->view('editarea', compact("area"));
    }

    public function edit(){
        $this->headJson();
        $this->validateToken($_POST['token_']); 
        
        $id = !empty($_POST['idarea']) ? $_POST['idarea'] : null;
        $area = !empty($_POST['area']) ? $_POST['area'] : null;

        $msg['msg'] = [];
        if($area == null || $id == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        else{            
            $obj = new Area();            
            $obj->setArea(ucfirst($area));
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