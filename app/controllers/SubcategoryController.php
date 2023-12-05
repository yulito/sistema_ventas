<?php

namespace App\Controllers;

use App\Models\SubCategory;
use App\Helpers\Msg;

class SubcategoryController extends Controller{

    public function index(){
        if($_SESSION['auth']){
            return $this->view('addsub');
        }else{
            return $this->redirect('/');
        }        
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
        if($_SESSION['auth']){
            $obj = new SubCategory();
            $sub = $obj->getOne($id);
            if($sub){
                return $this->view('editsub', compact("sub"));
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

    public function getOneType($id){
        $this->headJson();

        $obj = new SubCategory();
        $result = $obj->getAll((int)$id);     
        if($result->num_rows > 0){
            while($data = $result->fetch_assoc()){
                $dt[] = $data;
            }
            echo json_encode($dt);
        }else{
            echo json_encode(['msg'=>Msg::EMPTY_SUB]);
        }    
    }

}