<?php

namespace App\Controllers;

use App\Models\Shrinkage;
use App\Helpers\Msg;

class ShrinkageController extends Controller{

    public function index(){
        if($_SESSION['auth']){
            return $this->view('shrinkage');
        }else{
            return $this->redirect('/');
        }         
    }
    public function showAdd(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){            
            return $this->view('addshrinkage');            
        }else{
            return $this->redirect('/');
        }        
    }
    public function store(){ 
        $this->headJson();
        $this->validateToken($_POST['token_']);  
        //recibir post
        $fecha    = !empty($_POST['nfecha']) ? $_POST['nfecha'] : null; 
        $cod   = !empty($_POST['ncod']) ? $_POST['ncod'] : null;
        $cantidad   = isset($_POST['nqn']) ? (int)$_POST['nqn'] : null; 
        $descripcion = !empty($_POST['nText']) ? $_POST['nText'] : null;  
       
        //validaciones
        $msg['msg'] = [];
        if($fecha == null || $cod == null || $cantidad == null || $descripcion == null ){
            $msg['msg']['field'] = Msg::EMPTY_FIELD;
        }
        
        //objeto cliente
        $obj = new Shrinkage();
        
        if(empty($msg['msg'])){           
            //enviar datos a la clase
            $obj->setFecha($fecha);
            $obj->setCod($cod);
            $obj->setCantidad($cantidad);
            $obj->setDescripcion($descripcion);            

            if($obj->save()){
                $msg['msg']['success'] = Msg::MSG_SUCCESS; 
            }else{
                $msg['msg']['fail'] = Msg::FAILED_OPERATION; 
            }            
        }        
        echo json_encode($msg['msg']);
    }    
    public function list($param){
        header('Content-Type: text/html; charset=utf-8'); 
        $p = null;
        if($param === 'false'){
            $p = "";
        }else{
            $param = str_replace("0y0", " ", $param);
            $p = $param;
        }

        $this->headJson();
                  
        $obj = new Shrinkage();
        $result = $obj->getAll($p);

        echo json_encode($result); 
    }
    public function show($id){   
        header('Content-Type: text/html; charset=utf-8');      
        $this->headJson();

        $obj = new Shrinkage();
        $result = $obj->getOne($id);        
        echo json_encode($result);
    }
}