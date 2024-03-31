<?php

namespace App\Models;

class SaleDetails extends Model
{
    protected $table = 'detalle_venta';

    private $cantidad;
    private $descdetalle;
    private $totaldetalle;
    private $idventa;
    private $idprod;

    //setters
    function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }
    function setDescdetalle($descdetalle){
        $this->descdetalle = $descdetalle;
    }
    function setTotaldetalle($totaldetalle){
        $this->totaldetalle = $totaldetalle;
    }
    function setIdventa($idventa){
        $this->idventa = $idventa;
    }
    function setIdprod($idprod){
        $this->idprod = $this->connection->real_escape_string($idprod);
    }
    //getters
    function getCantidad(){
        return $this->cantidad;
    }
    function getDescdetalle(){
        return $this->descdetalle;
    }
    function getTotaldetalle(){
        return $this->totaldetalle;
    }
    function getIdventa(){
        return $this->idventa;
    }
    function getIdprod(){
        return $this->idprod;
    }

    //functions
    public function save(){
        $descDet = $this->getDescdetalle();
        if(empty($descDet) || !isset($descDet) || is_null($descDet) || $descDet == false)
        {
            $descDet = 0;
        }
        $sql = "INSERT INTO detalle_venta (cantidad_prod, desc_detalle, total_detalle, id_venta, id_prod) 
                VALUES ('{$this->getCantidad()}',$descDet,'{$this->getTotaldetalle()}','{$this->getIdventa()}', (select id_prod from producto where producto_ = '{$this->getIdprod()}'))";
        $bool = false;
        if($this->connection->query($sql))
        {
            $sql = "UPDATE producto SET stock = stock - '{$this->getCantidad()}' 
                    WHERE producto_ = '{$this->getIdprod()}'";
            $bool = $this->connection->query($sql);
        }
        return $bool;
    }

    public function getAllforId($id){
        $sql = "SELECT
        producto_,
        cantidad_prod as cantidad
        FROM detalle_venta LEFT OUTER JOIN producto USING(id_prod)
        WHERE id_venta ='$id'";
        
        $result = $this->connection->query($sql);
        if($result->num_rows > 0){
            while($data = $result->fetch_assoc()){
                $obj[] = $data;
            }
            return $obj;
        }else{
            return false;
        }
    }
}