<?php

namespace App\Controllers;

use App\Models\Sale;
use App\Models\SaleDetails;
use App\Helpers\Msg;

class SaleController extends Controller{

    public function index(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){
            return $this->view('sysbox');
        }else{
            return $this->redirect('/');
        }         
    }

    public function show($doc){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){            
            if($doc == "boleta"){
                return $this->view('bill',['document'=>'boleta']);
            }elseif($doc == "factura"){
                return $this->view('bill',['document'=>'factura']);
            }else{
                return $this->view('error.page404',['msg'=>Msg::ERROR_404]);
            }
        }else{
            return $this->redirect('/');
        }
    }

    public function store($doc){
        $this->headJson();
        $json=json_decode(file_get_contents('php://input'));

        //objeto venta
        $saleObj = new Sale();

        //seteamos los datos generales
        $saleObj->setSubtotal((double)$json->totalSale->subtotal);
        $saleObj->setDescventa((double)$json->totalSale->descxtotal);
        $saleObj->setTotal((double)$json->totalSale->total);        
        
        //datos para boleta
        if($doc == "1"){
            $saleObj->setRutempresa(null);
            $saleObj->setNomempresa(null);
            $saleObj->setDireccion(null);
            $saleObj->setIdcomuna(false); 
            $saleObj->setIdsucursal(false); //lo modifico en el set con sql (es una mala practica pero queria algo rapido xd)
            $saleObj->setIddoc((int)$doc);
            $saleObj->setIdpago((int)$json->totalSale->pay);
        }

        //datos para factura
        if($doc == "2")
        {
            /* Aun falta definir los campos del formulario para esta seccion (factura)
            $saleObj->setRutempresa($json->totalSale->);
            $saleObj->setNomempresa($json->totalSale->);
            $saleObj->setDireccion($json->totalSale->);
            $saleObj->setIdcomuna($json->totalSale->);
            $saleObj->setIdsucursal($json->totalSale->); */
            $saleObj->setIddoc((int)$doc);
            $saleObj->setIdpago((int)$json->totalSale->pay);
        }

        //guardar datos boleta/factura y obtener id del documento
        $idResponse = $saleObj->save();

        $msg['msg'] = [];
        if($idResponse)
        {
            //insertar detalle de venta
            $objDet = new SaleDetails();

            for($i = 0; $i < count($json->details); $i++)
            {
                $objDet->setCantidad((double)$json->details[$i]->qn);
                $objDet->setDescdetalle((double)substr($json->details[$i]->valueu, 1, strlen($json->details[$i]->valueu)));
                $objDet->setTotaldetalle((double)substr($json->details[$i]->total, 1, strlen($json->details[$i]->total)));
                $objDet->setIdventa((int)$idResponse);
                $objDet->setIdprod($json->details[$i]->product); 
                //guardar cambios de venta
                $objDet->save();
            }            
            echo json_encode($msg['msg']['success'] = Msg::MSG_SUCCESS);
        }else{
            echo json_encode($msg['msg']['fail'] = Msg::FAILED_OPERATION);
        }   
    }

    //----
    public function showEdit($id){
                        
    }
    public function edit(){
        $this->headJson();
        $this->validateToken($_POST['token_']); 
        
        
    }
}