<?php

namespace App\Models;

use Exception;

class User extends Model
{
    protected $table = 'usuario';
    
    private $name; //nomusuario 
    private $password; //clave
    private $type; //id_tipo

    
    function setName($name){
        $this->name = $this->connection->real_escape_string($name);
    }   
    function setPassword($password){
        $this->password = password_hash($this->connection->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    function setType($type){
        $this->type = $type;
    }

    function getName(){
        return $this->name;
    }
    function getPass(){
        return $this->password;
    }
    function getType(){
        return $this->type;
    }

    public function save(){
        $sql = "INSERT INTO usuario (nomusuario, clave, id_tipo) 
        VALUES('{$this->getName()}','{$this->getPass()}','{$this->getType()}')";
        $this->connection->query($sql);

        $result = match(true){
            $this->getType() == 1 => "ADMINISTRADOR",
            $this->getType() == 2 => "VENDEDOR",
            $this->getType() == 3 => "DESHABILITADO"
        };
        $arr = ["name"=>$this->getName(),"type"=>$result];
        return $arr;
    }

    public function getAll(){
        $sql = "SELECT id_usuario, nomusuario, id_tipo, nomtipo FROM usuario INNER JOIN tipo_usuario USING(id_tipo)" ;
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
  
    public function validateName($name){
        $sql = "SELECT * FROM usuario WHERE nomusuario = '$name'";
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }
}