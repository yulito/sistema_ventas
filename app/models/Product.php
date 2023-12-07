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
    public function getAll($param){
        $sql = "SELECT p.id_prod,p.cod, p.feccreacion, p.fecactual, p.producto_, p.proddescrip, p.foto, p.umedida,
                p.stock, p.valor, p.desc_x_prod, m.marca_, s.subcat, a.area_,c.cat
                FROM producto p LEFT OUTER JOIN marca m USING(id_marca)
                            LEFT OUTER JOIN subcategoria s USING(id_sub)
                            LEFT OUTER JOIN area a USING(id_area)
                            LEFT OUTER JOIN categoria c USING(id_cat)";
        if(!empty($param)){
            $sql .= " WHERE cod LIKE '%$param%' OR producto_ LIKE '%$param%' OR subcat LIKE '%$param%' OR marca_ LIKE '%$param%' OR area_ LIKE '%$param%'";
        }else{
            $sql .= "ORDER BY fecactual DESC LIMIT 0,100";
        }
        $user = $this->connection->query($sql);
        if($user->num_rows > 0){
            while($data = $user->fetch_assoc()){
                $obj[] = $data;
            }
            return $obj;
        }else{
            return false;
        }
    }
    public function getOne($id){
        $sql = "SELECT p.id_prod,p.cod, p.feccreacion, p.fecactual, p.producto_, p.proddescrip, p.foto, p.umedida,
                p.stock, p.valor, p.desc_x_prod, m.marca_, s.subcat, a.area_,c.cat, p.id_sub, p.id_marca, p.id_area
                FROM producto p LEFT OUTER JOIN marca m USING(id_marca)
                            LEFT OUTER JOIN subcategoria s USING(id_sub)
                            LEFT OUTER JOIN area a USING(id_area)
                            LEFT OUTER JOIN categoria c USING(id_cat)
                            WHERE id_prod = '$id'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_assoc();
    }
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
    public function update($id){
        $sql = "UPDATE producto SET 
                cod = '{$this->getCod()}',
                fecactual = NOW(),
                producto_ = '{$this->getProd()}',
                proddescrip = '{$this->getDescription()}', ";
        if(!empty($this->getPhoto())){
            $sql .= "foto = '{$this->getPhoto()}', ";
        }
        $sql .= "umedida = '{$this->getMeasure()}',
                 stock = '{$this->getStock()}',
                 valor = '{$this->getPrice()}',
                 desc_x_prod = '{$this->getDiscount()}',
                 id_marca = '{$this->getBrand()}',
                 id_sub = '{$this->getSubcategory()}',
                 id_area = '{$this->getArea()}'
                 WHERE id_prod = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }
}