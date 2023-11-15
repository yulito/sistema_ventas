<?php

namespace App\Models;

class Brand extends Model
{
    protected $table = 'marca';

    private $brand;

    function setBrand($brand){
        $this->brand = $this->connection->real_escape_string($brand);
    }
    function getBrand(){
        return $this->brand;
    }

    //------
    public function getAll(){
        $sql = "SELECT * FROM marca";
        $obj = $this->connection->query($sql);
        return $obj;
    }
    public function getOne($id){
        $sql = "SELECT * FROM marca WHERE id_marca = '$id'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_object();
    }
    public function save(){
        $sql = "INSERT INTO marca (marca_) VALUES('{$this->getBrand()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function update($id){
        $sql = "UPDATE marca SET 
                marca_ = '{$this->getBrand()}'
                WHERE id_marca = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function verify($name){
        $sql = "SELECT * FROM marca WHERE marca_ = '$name'";
        $obj = $this->connection->query($sql);        
        return $obj->fetch_object();
    }
}