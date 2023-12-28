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
        $this->idprod = $idprod;
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
    
}