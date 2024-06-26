<?php

namespace App\Models;

class Batch extends Model
{
    protected $table = 'lote';

    private $batch;
    private $quantity;
    private $weight;
    private $elaborated;
    private $expiration;
    private $prod;

    function setBatch($batch){
        $this->batch = $this->connection->real_escape_string($batch);
    }
    function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    function setWeight($weight){
        $this->weight = $weight;
    }
    function setElaborated($elaborated){
        $this->elaborated = $elaborated;
    }
    function setExpiration($expiration){
        $this->expiration = $expiration;
    }
    function setProd($prod){
        $this->prod = $this->connection->real_escape_string($prod);
    }

    function getBatch(){
        return $this->batch;
    } 
    function getQuantity(){
        return $this->quantity;
    } 
    function getWeight(){
        return $this->weight;
    } 
    function getElaborated(){      
        return $this->elaborated;        
    } 
    function getExpiration(){     
        return $this->expiration;
    } 
    function getProd(){
        return $this->prod;
    } 

    //functions
    public function save(){
        
        $sql = "INSERT INTO lote (lote_cod,cantidad,pesaje,feceingreso,fecproduccion,vencimiento,id_prod) 
                VALUES ('{$this->getBatch()}','{$this->getQuantity()}','{$this->getWeight()}',NOW(), ";
        //valor fecha elaboraion
        if( $this->getElaborated() == "false" || $this->getElaborated() == false){
            $sql .= " NULL, ";
        }else{
            $sql .= " '{$this->getElaborated()}', ";
        }
        //valor fecha vencimiento
        if( $this->getExpiration() == "false" || $this->getExpiration() == false){
            $sql .= " NULL, ";
        }else{
            $sql .= " '{$this->getExpiration()}', ";
        }
        //subconsulta para obtener id_prod
        $sql .= "(select id_prod from producto where cod = '{$this->getProd()}'))";

        //resultado
        $bool = $this->connection->query($sql);
        $result = false;
        if($bool){
            //update stock from producto
            $sql = "UPDATE producto SET stock = stock + '{$this->getQuantity()}',
                    fecactual = NOW()
                    WHERE cod = '{$this->getProd()}'";
            $result = $this->connection->query($sql);
        }
        return $result;
    }
    public function getAll($d1,$d2){ 
        $sql = "SELECT l.id_lote, l.lote_cod, l.feceingreso, l.cantidad, p.producto_ FROM lote l LEFT JOIN producto p USING(id_prod)
                WHERE date_format(feceingreso,'%Y-%m-%d')
                BETWEEN date_format('$d1','%Y-%m-%d') AND date_format('$d2','%Y-%m-%d')";
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
        $sql = "SELECT l.*,p.cod, p.producto_, p.umedida FROM lote l LEFT JOIN producto p USING(id_prod)
                WHERE id_lote = '$id'";
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }
    public function remove($id){
        $sql = "DELETE FROM lote WHERE id_lote = '$id'";
        $bool = $this->connection->query($sql);

        $result = false;        
        if($bool){            
            $sql = "UPDATE producto SET stock = stock - '{$this->getQuantity()}',
                    fecactual = NOW()
                    WHERE cod = '{$this->getProd()}'";
            $result = $this->connection->query($sql);
        }
        return $result;
    }
}