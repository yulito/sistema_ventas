<?php

namespace App\Models;

class Sale extends Model
{
    protected $table = 'venta';

    private $subtotal;
    private $descventa;
    private $total;
    private $rutempresa; //--- desde aca hacia abajo son opcionales salvo iddoc e idpago
    private $nomempresa;
    private $direccion;
    private $idcomuna;
    private $idsucursal;
    private $iddoc;
    private $idpago;

    //setters
    function setSubtotal($subtotal){
        $this->subtotal = $subtotal;
    }
    function setDescventa($descventa){
        $this->descventa = $descventa;
    }
    function setTotal($total){
        $this->total = $total;
    }
    function setRutempresa($rutempresa){
        $this->rutempresa = $this->connection->real_escape_string($rutempresa);
    }
    function setNomempresa($nomempresa){
        $this->nomempresa = $this->connection->real_escape_string($nomempresa);
    }
    function setDireccion($direccion){
        $this->direccion = $this->connection->real_escape_string($direccion);
    }
    function setIdcomuna($idcomuna){
        $this->idcomuna = $idcomuna;
    }
    function setIdsucursal($idsucursal){
        $this->idsucursal = $idsucursal;
    }
    function setIddoc($iddoc){
        $this->iddoc = $iddoc;
    }
    function setIdpago($idpago){
        $this->idpago = $idpago;
    }
    //getters
    function getSubtotal(){
        return $this->subtotal;
    }
    function getDescventa(){
        return $this->descventa;
    }
    function getTotal(){
       return $this->total;
    }
    function getRutempresa(){
        return $this->rutempresa;
    }
    function getNomempresa(){
        return $this->nomempresa;
    }
    function getDireccion(){
        return $this->direccion;
    }
    function getIdcomuna(){
        return $this->idcomuna;
    }
    function getIdsucursal(){
        return $this->idsucursal;
    }
    function getIddoc(){
        return $this->iddoc;
    }
    function getIdpago(){
        return $this->idpago;
    }  
    
    
    /* 
    //------
    public function getAll(){
        $sql = "SELECT * FROM area";
        $obj = $this->connection->query($sql);
        return $obj;
    }
    public function getOne($id){
        $sql = "SELECT * FROM area WHERE id_area = '$id'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_object();
    }
    public function save(){
        $sql = "INSERT INTO area (area_) VALUES('{$this->getArea()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function update($id){
        $sql = "UPDATE area SET 
                area_ = '{$this->getArea()}'
                WHERE id_area = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function verify($name){
        $sql = "SELECT * FROM area WHERE area_ = '$name'";
        $obj = $this->connection->query($sql);        
        return $obj->fetch_object();
    } */
}