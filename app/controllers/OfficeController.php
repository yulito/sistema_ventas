<?php

namespace App\Controllers;

use App\Models\Office;
use App\Helpers\Msg;

class OfficeController extends Controller{

    public function store(){
        $this->headJson();
        $this->validateToken($_POST['token_']);   

        $office = !empty($_POST['office']) ? $_POST['office'] : null;
        $address = !empty($_POST['idaddress']) ? $_POST['idaddress'] : null;
        $idLocation = isset($_POST['loc']) ? (int)$_POST['loc'] : null;

        $msg['msg'] = [];
        if($office == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        if(empty($msg['msg'])){
            $obj = new Office();
            $obj->setOffice(ucfirst($office));
            $obj->setAddress(ucfirst($address));
            $obj->setIdLocation($idLocation);
            $result = $obj->verify();
            if($result){
                //actualizar  
                $obj->update();                
                $msg['msg']['update'] = Msg::UPDATE_SUCCESS;
            }else if(!$result){
                //insertar
                $obj->save();
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['fail'] = Msg::FAILED_OPERATION;
            }           
        }
        echo json_encode($msg['msg']);
    }
}