<?php

namespace App\Controllers;

use App\Models\Delivery;
use App\Models\SaleDetails;
use App\Helpers\Msg;

class DeliveryController extends Controller{

    public function index(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){             
            return $this->view('deliveries');
        }else{
            return $this->redirect('/');
        } 
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
                  
        $obj = new Delivery();
        $result = $obj->getAll($p);

        echo json_encode($result); 
    }

    public function showAdd(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){             
            return $this->view('adddelivery');
        }else{
            return $this->redirect('/');
        }
    }

    public function store(){
        $this->headJson();
        $this->validateToken($_POST['token_']);  
        //recibir post
        $run    = !empty($_POST['nRun']) ? $_POST['nRun'] : null; 
        $nro   = isset($_POST['nro']) ? (int)$_POST['nro'] : null;        
        $direccion = !empty($_POST['nAddress']) ? $_POST['nAddress'] : null;
        $comuna  = isset($_POST['nLocation']) ? (int)$_POST['nLocation'] : null; 
        $observacion = !empty($_POST['nText']) ? $_POST['nText'] : null;
       
        //validaciones
        $msg['msg'] = [];
        if($run == null || $nro == null || $direccion == null || $comuna == null){
            $msg['msg']['field'] =  Msg::EMPTY_FIELD;
        }        
        //objeto despacho
        $obj = new Delivery();

        //verificar cliente
        $client = $obj->verifyClient($run);
            
        if(!isset($client) || $client == false){
            $msg['msg']['client'] = Msg::CLIENT_ERROR;
        }
        
        if(empty($msg['msg'])){           
            //enviar datos a la clase
            $obj->setDireccion($direccion);
            $obj->setComuna($comuna);
            $obj->setVenta($nro);
            $obj->setCliente($client->id_cliente);
            $obj->setObservacion($observacion);                        

            if($obj->save()){
                $msg['msg']['success'] = Msg::MSG_SUCCESS; 
            }else{
                $msg['msg']['fail'] = Msg::FAILED_OPERATION; 
            }            
        }        
        echo json_encode($msg['msg']);        
    }

    public function show($id){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){
            $obj = new Delivery();
            $dt = new SaleDetails();

            $obj = $obj->getOne($id);
            if($obj){
                $dt = $dt->getAllforId($obj->id_venta);
                return $this->view('showdelivery',['delivery'=>$obj, 'details'=>$dt]);
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

        $id = isset($_POST['idDelivery']) ? (int)$_POST['idDelivery'] : NULL;

        $msg['msg'] = [];
        $obj = new Delivery();

        if($obj->update($id)){
            $msg['msg']['success'] = Msg::MSG_SUCCESS; 
        }else{
            $msg['msg']['fail'] = Msg::FAILED_OPERATION; 
        } 

        echo json_encode($msg['msg']); 
    }

    public function delete($id){
        $obj = new Delivery();
        if($obj->remove($id)){
            return $this->view('deliveries'); 
        }else{
            return $this->redirect('/'); 
        }
    }
}