<?php

namespace App\Models;

class TypeUser extends Model
{
    protected $table = 'tipo_usuario';

    public function getAll(){
        $sql = "SELECT * FROM tipo_usuario";
        $objs = $this->connection->query($sql);
        return $objs;
    }    
}