<?php

namespace App\Models;

class Category extends Model
{
    protected $table = 'category';

    public function showCat(){
        $sql = "SELECT * FROM category";
        $cat = $this->connection->query($sql);
        return $cat;
    }
    public function showOneCat($id){
        $sql = "SELECT * FROM category WHERE id_cat = '$id'";
        $cat = $this->connection->query($sql);
        return $cat->fetch_assoc();
    }
}