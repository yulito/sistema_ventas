<?php

namespace App\Models;

class Sale extends Model
{
    protected $table = 'venta';

    private $subtotal;
    private $descventa;
    private $total;
    private $rutempresa; 
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
        if(!$idsucursal){
            $idsucursal = '(SELECT id_sucursal FROM sucursal)';
        }
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
        
    //------
    public function save(){
        $idcom = $this->getIdcomuna();
        if(!$idcom){
            $idcom = 'NULL';
        }
        $sql = "INSERT INTO venta (fecventa, vendedor, subtotal, descventa, total, rutempresa, nomempresa, direcemp, estado, id_comuna ,id_sucursal, id_doc , id_pago) 
                VALUES (NOW(),'{$_SESSION['auth']->nomusuario}','{$this->getSubtotal()}','{$this->getDescventa()}','{$this->getTotal()}','{$this->getRutempresa()}','{$this->getNomempresa()}','{$this->getDireccion()}',1,$idcom,{$this->getIdsucursal()},'{$this->getIddoc()}','{$this->getIdpago()}')";
        $this->connection->query($sql);
        //obtener el id insertado con el auto_increment
        return $this->connection->insert_id;
    }    

    public function getLocation($param){
        $sql = "SELECT comuna_ FROM comuna WHERE id_comuna = '$param'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_assoc();
    }

    public function remove($id){
        $sql = "UPDATE venta SET 
                estado = 0
                WHERE id_venta = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function getAll($d1,$d2){ 
        $sql = "SELECT id_venta, fecventa, total, doc, vendedor 
        FROM venta LEFT OUTER JOIN documento USING(id_doc)
        WHERE estado = 1 AND date_format(fecventa,'%Y-%m-%d')
        BETWEEN date_format('$d1','%Y-%m-%d') AND date_format('$d2','%Y-%m-%d');";
        
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
    
    public function getOne($id){
        $sql = "SELECT 
        id_venta,
        fecventa,
        subtotal,
        descventa,
        total,
        rutempresa,
        nomempresa,
        direcemp,
        comuna_,
        id_doc,
        doc,
        pago 
        FROM venta LEFT OUTER JOIN comuna USING(id_comuna)                    
                    LEFT OUTER JOIN documento USING(id_doc)
                    LEFT OUTER JOIN medio_pago USING(id_pago)
                    WHERE id_venta = '$id'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_object();
    }    
 
}