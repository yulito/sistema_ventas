<?php

namespace Lib;

use App\Models\TypeUser;
use App\Models\Area;
use App\Models\Category;
use App\Models\SubCategory;

trait Utils{

  public function showTypeUser(){
  $obj= new TypeUser();
  $obj= $obj->getAll();
  return $obj;
  }

  public function showArea(){
    $obj = new Area();
    $obj = $obj->getAll();
    return $obj;
  }
  
  public function showCategories(){ 
    $obj = new Category();
    $obj = $obj->getAll();
    return $obj;
  }

  
    
}