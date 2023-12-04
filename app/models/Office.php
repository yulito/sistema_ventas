<?php

namespace App\Models;

class Office extends Model
{
    protected $table = 'sucursal';

    private $office;
    private $address;
    private $idLocation;

    //setters
    function setOffice($office){
        $this->office = $this->connection->real_escape_string($office);
    }
    function setAddress($address){
        $this->address = $this->connection->real_escape_string($address);
    }
    function setIdLocation($idLocation){
        $this->idLocation = $idLocation;
    }
    //getters    
    function getOffice(){
        return $this->office;
    }
    function getAddress(){
        return $this->address;
    }
    function getIdLocation(){
        return $this->idLocation;
    }

    //----
    public function verify(){
        $sql = "SELECT sucursal_, direccion_sucursal, id_comuna, comuna_ 
        FROM sucursal LEFT JOIN comuna USING(id_comuna)";

        $obj = $this->connection->query($sql);        
        return $obj->fetch_object();
    }     
    public function save(){
        $sql = "INSERT INTO sucursal (sucursal_, direccion_sucursal, id_comuna) 
                VALUES('{$this->getOffice()}', '{$this->getAddress()}', '{$this->getIdLocation()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function update(){
        $sql = "UPDATE sucursal SET 
                sucursal_ = '{$this->getOffice()}',
                direccion_sucursal = '{$this->getAddress()}',
                id_comuna = '{$this->getIdLocation()}'";
        $result = $this->connection->query($sql);
        return $result;
    }    

}