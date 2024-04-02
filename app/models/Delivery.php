<?php

namespace App\Models;

class Delivery extends Model
{
    protected $table = 'despacho';

    private $id;
    private $direccion;
    private $comuna;
    private $venta;
    private $cliente;
    private $observacion;

    /*
        id_despacho, fecdespacho, direc_desp, estado, id_comuna, id_venta, id_cliente
    */
    //setters
    function setId($id){
        $this->id = $id; 
    }
    function setDireccion($direccion){
        $this->direccion = $this->connection->real_escape_string($direccion);
    }
    function setComuna($comuna){
        $this->comuna = $comuna; 
    }
    function setVenta($venta){
        $this->venta = $venta; 
    }
    function setCliente($cliente){
        $this->cliente = $cliente; 
    }
    function setObservacion($observacion){
        $this->observacion = $this->connection->real_escape_string($observacion);
    }
    //getters
    function getId(){
        return $this->id;
    }
    function getDireccion(){
        return $this->direccion;
    }
    function getComuna(){
        return $this->comuna; 
    }
    function getVenta(){
        return $this->venta; 
    }
    function getCliente(){
        return $this->cliente; 
    }
    function getObservacion(){
        return $this->observacion;
    }

    //ojo estado 1 = Pendiente/emitido, 2 = Realizado/despachado, 0 = Eliminado/descartado
    public function save(){
        $sql = "INSERT INTO despacho (fecdespacho, direc_desp, estado, observacion,id_comuna, id_venta, id_cliente) 
                VALUES(NOW(),'{$this->getDireccion()}',1,'{$this->getObservacion()}','{$this->getComuna()}','{$this->getVenta()}','{$this->getCliente()}')";
        return $this->connection->query($sql);
    }
    public function getAll($param){
        $sql = "SELECT id_despacho, fecdespacho, fecmodificar, estado FROM despacho WHERE estado <> 0 ";
        if(!empty($param)){
            $sql .= " AND id_despacho LIKE '%$param%'";
        }else{
            $sql .= "ORDER BY estado ASC LIMIT 0,100";
        }
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
        d.id_despacho,
        d.id_venta,
        d.fecdespacho,
        d.direc_desp as dir_desp,
        d.estado,
        d.observacion,
        c.comuna_ as comuna_desp,
        cl.run,
        cl.nomcliente,
        cl.fono,
        cl.direcliente as dir_cli,
        co.comuna_ as comuna_cli
        FROM despacho d LEFT OUTER JOIN cliente cl ON(d.id_cliente = cl.id_cliente)
                        LEFT OUTER JOIN comuna c ON(d.id_comuna = c.id_comuna)				
                        LEFT OUTER JOIN comuna co ON(cl.id_comuna = co.id_comuna)
                        WHERE id_despacho = '$id';";        
        $result = $this->connection->query($sql);
        return $result->fetch_object();
    }
    public function verifyClient($run){
        $sql = "SELECT id_cliente, run FROM cliente WHERE run = '$run'";
        $result = $this->connection->query($sql);
        if($result->num_rows == 0){
            return false;
        }else{
            return $result->fetch_object();
        }
    }
    public function update($id){
        $sql = "UPDATE despacho SET estado = 2, fecmodificar = NOW() WHERE id_despacho = '$id'";
        return $this->connection->query($sql);
    }
    public function remove($id){
        $sql = "UPDATE despacho SET estado = 0, fecmodificar = NOW() WHERE id_despacho = '$id'";
        return $this->connection->query($sql);
    }
}