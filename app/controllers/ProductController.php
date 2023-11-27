<?php

namespace App\Controllers;

use App\Models\Product;
use App\Helpers\Msg;

class ProductController extends Controller{

    public function index(){
        
        return $this->view('productAdmin');
    }
    public function showAdd(){

        return $this->view('addproduct');
    }
    public function store(){        
        $this->headJson();
        $this->validateToken($_POST['token_']);  
        //recibir post
        $cod    = !empty($_POST['nameCod']) ? $_POST['nameCod'] : null; //opcional
        $prod   = !empty($_POST['nameProd']) ? $_POST['nameProd'] : null;
        $text   = !empty($_POST['nameText']) ? $_POST['nameText'] : null; //opcional
        $measure = isset($_POST['idmeasure']) ? (int)$_POST['idmeasure'] : null;
        $price  = isset($_POST['nameValue']) ? (double)$_POST['nameValue'] : null; 
        $desc   = isset($_POST['nameDesc']) ? (double)$_POST['nameDesc'] : null; //opcional
        $sub    = isset($_POST['idsubcat']) ? (int)$_POST['idsubcat'] : null;
        $area   = isset($_POST['idarea']) ? (int)$_POST['idarea'] : null;
        $brand  = isset($_POST['idbrand']) ? (int)$_POST['idbrand'] : null;
        $photo  = !empty($_FILES['idFile']) ? $_FILES['idFile'] : null; //opcional
        //validaciones
        $msg['msg'] = [];
        if($prod == null || $measure == null || $price == null || $sub == null || $area == null || $brand == null){
            $msg['msg']['field'] = Msg::EMPTY_FIELD;
        }
        $measureResult = match($measure){
            1 => "Unidad",
            2 => "Litros",
            3 => "Kilos",
            4 => "Metros",
            default => "Unidad",
        };
        //verificar existencia
        $obj = new Product();
        
        if($obj->verifyCod($cod)){
            $msg['msg']['cod_exist'] = Msg::COD_EXIST;
        }
        if($obj->verifyProd($prod)){
            $msg['msg']['name_exist'] = Msg::NAME_EXIST;
        }
        if(empty($msg['msg'])){
            //---- Nombrar foto 
            $namePhoto = null;            
            if(!is_null($photo)){
                $mimetype   = $photo['type'];                
                if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif')
                {                                        
                    if(!is_dir('uploads')){
                        mkdir('uploads', 0777, true);
                    }
                    $namePhoto  = date("d-m-Y").'_'.$photo['name'];
                    move_uploaded_file($photo['tmp_name'], 'uploads/'.$namePhoto);                                                   
                }
            }
            //enviar datos a la clase
            $obj->setCod($cod);
            $obj->setProd($prod);
            $obj->setDescription($text);
            $obj->setPhoto($namePhoto);
            $obj->setMeasure($measureResult);
            $obj->setStock(0);
            $obj->setPrice($price);
            $obj->setDiscount($desc);
            $obj->setBrand($brand);
            $obj->setSubcategory($sub); 
            $obj->setArea($area); 
            $obj->save();

            $msg['msg']['success'] = Msg::MSG_SUCCESS;        
        }        
        echo json_encode($msg['msg']);
    }
} 