<?php

namespace App\Models;

class SubCategory extends Model
{
    protected $table = 'subcategoria';

    private $subcat;
    private $idcat;

    function setSub($subcat){
        $this->subcat = $this->connection->real_escape_string($subcat);
    }
    function setIdcat($idcat){
        $this->idcat = $idcat;
    }
    function getSub(){
        return $this->subcat;
    }    
    function getIdcat(){
        return $this->idcat;
    }

    //---------------------
    public function getAll($id){
        $sql = "SELECT id_sub, subcat, id_cat, cat 
                FROM subcategoria INNER JOIN categoria USING(id_cat)";
        if($id){
            $sql .= " WHERE id_cat = '$id'";
        }
        $obj = $this->connection->query($sql);
        return $obj;
    }
    public function getOne($id){
        $sql = "SELECT id_sub, subcat, id_cat, cat 
                FROM subcategoria INNER JOIN categoria USING(id_cat) WHERE id_sub = '$id'";
        $cat = $this->connection->query($sql);
        return $cat->fetch_object();
    }
    public function save(){
        $sql = "INSERT INTO subcategoria (subcat, id_cat) VALUES('{$this->getSub()}','{$this->getIdcat()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function update($id){
        $sql = "UPDATE subcategoria SET 
                subcat = '{$this->getSub()}',
                id_cat = '{$this->getIdcat()}'
                WHERE id_sub = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function verify($name){
        $sql = "SELECT * FROM subcategoria WHERE subcat = '$name'";
        $obj = $this->connection->query($sql);        
        return $obj->fetch_object();
    } 
}