<?php

namespace App\Models;

class Shrinkage extends Model
{
    protected $table = 'merma';

    private $id;
    private $fecha;
    private $cod;
    private $cantidad;
    private $descripcion;

    //---- setters
    function setId($id){
        $this->id = $id;
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setCod($cod){
        $this->cod = $cod;
    }
    function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }
    function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    
    //-----------getters
    function getId(){
        return $this->id;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getCod(){
        return $this->cod;
    }
    function getCantidad(){
        return $this->cantidad;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    

    //------ funciones
    
    public function getOne($id){
        $sql = "SELECT fechaingreso, codprod, cantidad, descripcion, producto_, foto 
                FROM merma LEFT JOIN producto USING(id_prod) 
                WHERE id_merma = '$id'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_assoc();
    }
    public function save(){
        $sql = "INSERT INTO merma (fechaingreso, codprod, cantidad, descripcion, id_prod) 
                VALUES('{$this->getFecha()}','{$this->getCod()}','{$this->getCantidad()}','{$this->getDescripcion()}', 
                (SELECT id_prod FROM producto WHERE cod = '{$this->getCod()}'))";
        $bool = $this->connection->query($sql);
        $result = false;
        if($bool){
            //update stock from producto
            $sql = "UPDATE producto SET stock = stock - '{$this->getCantidad()}',
                    fecactual = NOW()
                    WHERE cod = '{$this->getCod()}'";
            $result = $this->connection->query($sql);
        }
        return $result;
    }
    public function getAll($param){
        $sql = "SELECT * FROM merma";

        if(!empty($param)){
            $sql .= " WHERE codprod LIKE '%$param%' OR fechaingreso LIKE '%$param%'";
        }
        $shrinkage = $this->connection->query($sql);
        if($shrinkage->num_rows > 0){
            while($data = $shrinkage->fetch_assoc()){
                $obj[] = $data;
            }
            return $obj;
        }else{
            return false;
        }
    }

}