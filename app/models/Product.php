<?php

namespace App\Models;

class Product extends Model
{
    protected $table = 'producto';
        
    private $cod;
    private $prod;
    private $description;
    private $photo;
    private $measure;
    private $stock;
    private $price;
    private $discount;
    private $brand;
    private $subcategory;
    private $area;
    
    //SETTERS
    function setCod($cod){
        $this->cod = $this->connection->real_escape_string($cod);
    } 
    function setProd($prod){
        $this->prod = $this->connection->real_escape_string($prod);
    }
    function setDescription($description){
        $this->description = $this->connection->real_escape_string($description);
    }
    function setPhoto($photo){
        $this->photo = $this->connection->real_escape_string($photo);
    }
    function setMeasure($measure){
        $this->measure = $this->connection->real_escape_string($measure);
    }
    function setStock($stock){
        $this->stock = $stock;
    }
    function setPrice($price){
        $this->price = $price;
    }
    function setDiscount($discount){
        $this->discount = $discount;
    }
    function setBrand($brand){
        $this->brand = $brand;
    }
    function setSubcategory($subcategory){
        $this->subcategory = $subcategory;
    }
    function setArea($area){
        $this->area = $area;
    }

    //GETTERS
    function getCod(){
        return $this->cod;
    }
    function getProd(){
        return $this->prod;
    }
    function getDescription(){
        return $this->description;
    }
    function getPhoto(){
        return $this->photo;
    }
    function getMeasure(){
        return $this->measure;
    }
    function getStock(){
        return $this->stock;
    }
    function getPrice(){
        return $this->price;
    }
    function getDiscount(){
        return $this->discount;
    }
    function getBrand(){
        return $this->brand;
    }
    function getSubcategory(){
        return $this->subcategory;
    }
    function getArea(){
        return $this->area;
    }

    //Public functions
    public function save(){
        $sql = "INSERT INTO producto (cod, producto_, proddescrip, foto, umedida, stock, valor, desc_x_prod, id_marca, id_sub, id_area) 
                VALUES ('{$this->getCod()}','{$this->getProd()}','{$this->getDescription()}','{$this->getPhoto()}','{$this->getMeasure()}','{$this->getStock()}','{$this->getPrice()}','{$this->getDiscount()}','{$this->getBrand()}','{$this->getSubcategory()}','{$this->getArea()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function verifyCod($cod){
        $sql = "SELECT cod FROM producto where cod = '$cod'";
        $result = $this->connection->query($sql);
        return $result->fetch_object();
    }
    public function verifyProd($prod){
        $sql = "SELECT producto_ FROM producto where producto_ = '$prod'";
        $result = $this->connection->query($sql);
        return $result->fetch_object();
    }

}