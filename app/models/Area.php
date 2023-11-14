<?php

namespace App\Models;

class Area extends Model
{
    protected $table = 'area';

    private $area;

    function setArea($area){
        $this->area = $this->connection->real_escape_string($area);
    }
    function getArea(){
        return $this->area;
    }

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
    }
}