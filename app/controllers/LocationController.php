<?php

namespace App\Controllers;

use App\Models\Location;
use App\Helpers\Msg;

class LocationController extends Controller{

    public function index(){
        
        return $this->view('location');
    }
    public function showAdd(){
        return $this->view('addlocation');
    }
    public function store(){        
        $this->headJson();
        $this->validateToken($_POST['token_']);   

        $location = !empty($_POST['nLocation']) ? $_POST['nLocation'] : null;

        $msg['msg'] = [];
        if($location == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        if(empty($msg['msg'])){
            $obj = new Location();
            $result = $obj->verify($location);
            if(!$result){
                $obj->setLocation(ucfirst($location));
                $obj->save();                
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['exist'] = Msg::NAME_EXIST;
            }            
        }
        echo json_encode($msg['msg']);

    }
    public function showEdit($id){        
        $obj = new Location();
        $location = $obj->getOne($id);
        return $this->view('editlocation', compact("location"));
    }
    public function edit(){
        $this->headJson();
        $this->validateToken($_POST['token_']); 
        
        $id = !empty($_POST['idlocation']) ? $_POST['idlocation'] : null;
        $location = !empty($_POST['location']) ? $_POST['location'] : null;

        $msg['msg'] = [];
        if($location == null || $id == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        else{            
            $obj = new Location();            
            $obj->setLocation(ucfirst($location));
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