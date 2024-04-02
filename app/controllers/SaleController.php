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
        $lctn = false;
        if($doc == "2")
        {                        
            if(!empty($json->totalSale->location)){
                $lctn = (int)$json->totalSale->location;
            }
            $saleObj->setRutempresa($json->totalSale->rutCompany);
            $saleObj->setNomempresa($json->totalSale->nameCompany);
            $saleObj->setDireccion($json->totalSale->addressCompany);
            $saleObj->setIdcomuna($lctn);
            $saleObj->setIdsucursal(false);
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

            //traer comuna
            if($lctn)
            {
                $obj = new Sale();
                $resp = $obj->getLocation($lctn);
                $msg['msg']['location'] = $resp;
            }
            $msg['msg']['success'] = Msg::MSG_SUCCESS;
            $msg['msg']['nro'] = $idResponse; //nro venta 
            echo json_encode($msg['msg']);
        }else{
            $msg['msg']['fail'] = Msg::FAILED_OPERATION;
            echo json_encode($msg['msg']);
        }           
    }
    
    //----
    public function list(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 1){
            return $this->view('showlistsale');
        }else{
            return $this->redirect('/');
        } 
    }

    public function getList(){
        $this->headJson();       

        $date1 = $_POST['idfrom'];
        $date2 = $_POST['idto'];

        $obj = new Sale();
        $result = $obj->getAll($date1,$date2);
        if($result){
            echo json_encode($result);
        }else{
            $msg['msg']['emptySection'] = Msg::EMPTY_SECTION;
            echo json_encode($msg['msg']);
        }
    }

    //----
    public function delShow(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){            
            return $this->view('delview');
        }else{
            return $this->redirect('/');
        }
    }

    public function delete(){
        $this->headJson();
        $this->validateToken($_POST['token_']); 

        $id = !empty($_POST['idSale']) ? $_POST['idSale'] : NULL;
        
        $msg['msg'] = [];

        if($id == null){ $msg['msg']['empty'] = Msg::EMPTY_FIELD; }
        if(empty($msg['msg'])){
            $obj = new Sale();
            if($obj->remove($id)){
                $msg['msg']['success'] = Msg::MSG_SUCCESS;            
            }else{
                $msg['msg']['fail'] = Msg::FAILED_OPERATION; 
            }
        }
        echo json_encode($msg['msg']);
    }

    public function showOne($id){
        if(isset($_SESSION['auth'])){
            $obj = new Sale();
            $objDetail = new SaleDetails();

            $sale = $obj->getOne($id);
            //sleep(1);
            $detail = $objDetail->getAllforId($sale->id_venta);

            if($sale && $detail){
                return $this->view('showsale',['detail'=>$detail, 'sale'=>$sale]);
            }else{
                $msg = Msg::ERROR_404;
                return $this->view('error/page404', compact("msg"));
            }
        }else{
            return $this->redirect('/');
        }
    }
}