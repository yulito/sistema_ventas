<?php

namespace App\Controllers;

use App\Models\SubCategory;
use App\Helpers\Msg;

class SubcategoryController extends Controller{

    public function index(){
        
        return $this->view('addsub');
    }

    public function store(){
        $this->headJson();
        $this->validateToken($_POST['token_']);   

        $sub = !empty($_POST['nameSub']) ? $_POST['nameSub'] : null;
        $cat = !empty($_POST['idcategory']) ? $_POST['idcategory'] : null;

        $msg['msg'] = [];
        if($sub == null || $cat == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        if(empty($msg['msg'])){
            $obj = new SubCategory();
            $result = $obj->verify($sub);
            if(!$result){
                $obj->setSub(ucfirst($sub));
                $obj->setIdcat($cat);
                $obj->save();                
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['exist'] = Msg::NAME_EXIST;
            }            
        }
        echo json_encode($msg['msg']);        
        
    }

    public function showEdit($id){

        $obj = new SubCategory();
        $sub = $obj->getOne($id);
        return $this->view('editsub', compact("sub"));
    }

    public function edit(){
        $this->headJson();
        $this->validateToken($_POST['token_']); 
        
        $idsub = !empty($_POST['idsub']) ? $_POST['idsub'] : null;
        $sub = !empty($_POST['subcat']) ? $_POST['subcat'] : null;
        $cat = !empty($_POST['idCat']) ? $_POST['idCat'] : null;        

        $msg['msg'] = [];
        if($sub == null || $idsub == null || $cat == null){
            $msg['msg']['field'] = Msg::ALL_FIELDS;
        }
        else{            
            $obj = new SubCategory();            
            $obj->setSub(ucfirst($sub));
            $obj->setIdcat($cat);
            $result = $obj->update($idsub);
            if($result){
                $msg['msg']['success'] = Msg::MSG_SUCCESS;
            }else{
                $msg['msg']['fail'] = Msg::FAILED_OPERATION;
            }            
        }
        echo json_encode($msg['msg']);
    }
}