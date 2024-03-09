<?php

namespace App\Models;

class Client extends Model
{
    protected $table = 'cliente';

    private $id;
    private $run;
    private $nombre;
    private $fono;
    private $direccion;
    private $idcomuna;

    //---- setters
    function setId($id){
        $this->id = $id;
    }
    function setRun($run){
        $this->run = $this->connection->real_escape_string($run);
    }
    function setNombre($nombre){
        $this->nombre = $this->connection->real_escape_string($nombre);
    }
    function setFono($fono){
        $this->fono = $this->connection->real_escape_string($fono);
    }
    function setDireccion($direccion){
        $this->direccion = $this->connection->real_escape_string($direccion);
    }
    function setIdComuna($idcomuna){
        $this->idcomuna = $idcomuna;
    }
    
    //-----------getters
    function getId(){
        return $this->id;
    }
    function getRun(){
        return $this->run;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getFono(){
        return $this->fono;
    }
    function getDireccion(){
        return $this->direccion;
    }
    function getIdComuna(){
        return $this->idcomuna;
    }

    //------ funciones
    public function getAll($param){
        $sql = "SELECT 
            id_cliente, run, nomcliente, fono, direcliente, comuna_
            FROM cliente LEFT OUTER JOIN comuna USING(id_comuna) ";
        if(!empty($param)){
            $sql .= " WHERE run LIKE '%$param%' OR nomcliente LIKE '%$param%' OR fono LIKE '%$param%' OR direcliente LIKE '%$param%' OR comuna_ LIKE '%$param%'";
        }else{
            $sql .= "ORDER BY id_cliente DESC LIMIT 0,100";
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
        $sql = "SELECT *, comuna_ FROM cliente LEFT OUTER JOIN comuna USING(id_comuna) WHERE id_cliente = '$id'";
        $obj = $this->connection->query($sql);
        return $obj->fetch_object();
    }
    public function save(){
        $sql = "INSERT INTO cliente (run, nomcliente, fono, direcliente, id_comuna) 
                VALUES('{$this->getRun()}','{$this->getNombre()}','{$this->getFono()}','{$this->getDireccion()}','{$this->getIdComuna()}')";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function update(){
        $sql = "UPDATE cliente SET 
        run = '{$this->getRun()}',
        nomcliente = '{$this->getNombre()}',
        fono = '{$this->getFono()}',
        direcliente = '{$this->getDireccion()}',
        id_comuna = '{$this->getIdComuna()}'
        WHERE id_cliente = '{$this->getId()}'";
        $result = $this->connection->query($sql);
        return $result;
    }

}