<?php

namespace App\Models;

class Category extends Model
{
    protected $table = 'categoria';

    private $category;

    function setCat($category){
        $this->category = $this->connection->real_escape_string($category);
    }
    function getCat(){
        return $this->category;
    }

    //---------------------
    public function getAll(){
        $sql = "SELECT * FROM categoria";
        $obj = $this->connection->query($sql);
        return $obj;
    }
    public function getOne($id){
        $sql = "SELECT * FROM categoria WHERE id_cat = '$id'";
        $cat = $this->connection->query($sql);
        return $cat->fetch_object();
    }
    public function save(){
        $sql = "INSERT INTO categoria (cat) VALUES('{$this->getCat()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function update($id){
        $sql = "UPDATE categoria SET 
                cat = '{$this->getCat()}'
                WHERE id_cat = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function verify($name){
        $sql = "SELECT * FROM categoria WHERE cat = '$name'";
        $obj = $this->connection->query($sql);        
        return $obj->fetch_object();
    } 
}