<?php

namespace App\Models;

class Location extends Model
{
    protected $table = 'comuna';

    private $location;

    function setLocation($location){
        $this->location = $this->connection->real_escape_string($location);
    }
    function getLocation(){
        return $this->location;
    }

    
    //---------------------
    public function getAll(){
        $sql = "SELECT * FROM comuna";
        $obj = $this->connection->query($sql);
        return $obj;
    }
    public function getOne($id){
        $sql = "SELECT * FROM comuna WHERE id_comuna = '$id'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_object();
    }
    public function save(){
        $sql = "INSERT INTO comuna (comuna_) VALUES('{$this->getLocation()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function update($id){
        $sql = "UPDATE comuna SET 
                comuna_ = '{$this->getLocation()}'
                WHERE id_comuna = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function verify($name){
        $sql = "SELECT * FROM comuna WHERE comuna_ = '$name'";
        $obj = $this->connection->query($sql);        
        return $obj->fetch_object();
    } 
   
}