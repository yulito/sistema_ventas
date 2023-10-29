<?php

namespace App\Models;

use mysqli;

class Model{
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;
    protected $query;
    protected $table;

    public function __construct(){
        $this->connection();
    }

    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if($this->connection->connect_error)
        {
            die('Error de conexión: '.$this->connection->connect_error);
        }
    }

    //las funciones CRUD de aca abajo van bien con el uso de api
    public function query($sql, $data = [], $params = null)
    {
        if($data)
        {
            if($params == null){
                $params = str_repeat('s', count($data));
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param($params, ...$data);
            $stmt->execute();

            $this->query = $stmt->get_result();
        }else{
            $this->query = $this->connection->query($sql);
        }
        
        return $this;
    }

    public function first()
    {
        return $this->query->fetch_assoc();        
    }

    public function get()
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

}