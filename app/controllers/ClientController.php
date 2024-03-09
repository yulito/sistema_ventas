<?php

namespace App\Controllers;

use App\Models\Client;
use App\Helpers\Msg;

class ClientController extends Controller{

    public function index(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){
            return $this->view('client');
        }else{
            return $this->redirect('/');
        }         
    }
    public function showAdd($id){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){
            if($id !=='false'){
                $obj = new Client();
                $client = $obj->getOne($id);
                return $this->view('addclient',['accion'=>'Editar','client'=>$client]);
            }
            else{
                return $this->view('addclient',['accion'=>'Agregar']);
            }
        }else{
            return $this->redirect('/');
        }        
    }
    public function store($accion){        
        $this->headJson();
        $this->validateToken($_POST['token_']);  
        //recibir post
        $run    = !empty($_POST['nRun']) ? $_POST['nRun'] : null; 
        $nombre   = !empty($_POST['nName']) ? $_POST['nName'] : null;
        $fono   = !empty($_POST['nPhone']) ? $_POST['nPhone'] : null; 
        $direccion = !empty($_POST['nAddress']) ? $_POST['nAddress'] : null;
        $comuna  = isset($_POST['idLocation']) ? (int)$_POST['idLocation'] : null; 
       
        //validaciones
        $msg['msg'] = [];
        if($run == null || $nombre == null || $fono == null || $direccion == null || $comuna == null){
            $msg['msg']['field'] = Msg::EMPTY_FIELD;
        }
        
        //objeto cliente
        $obj = new Client();
        
        if(empty($msg['msg'])){           
            //enviar datos a la clase
            $obj->setRun($run);
            $obj->setNombre($nombre);
            $obj->setFono($fono);
            $obj->setDireccion($direccion);
            $obj->setIdComuna($comuna);

            if($accion === "Agregar"){
                if($obj->save()){
                    $msg['msg']['success'] = Msg::MSG_SUCCESS; 
                }else{
                    $msg['msg']['fail'] = Msg::FAILED_OPERATION; 
                }
            }
            else if ($accion === "Editar"){
                $obj->setId($_POST['nId']);
                if($obj->update()){
                    $msg['msg']['success'] = Msg::MSG_SUCCESS; 
                }else{
                    $msg['msg']['fail'] = Msg::FAILED_OPERATION; 
                }
            }
            else{
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
                  
        $obj = new Client();
        $result = $obj->getAll($p);

        echo json_encode($result); 
    }
}