<?php

namespace Lib;

use App\Models\TypeUser;
use App\Models\Area;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Location;
use App\Models\Office;


trait Utils{

  public function showTypeUser(){
  $obj= new TypeUser();
  $obj= $obj->getAll();
  return $obj;
  }

  public function showLocation(){ 
    $obj = new Location();
    $obj = $obj->getAll();
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

  public function showSubCat(){ 
    $obj = new SubCategory();
    $obj = $obj->getAll(false);
    return $obj;
  }

  public function showBrand(){ 
    $obj = new Brand();
    $obj = $obj->getAll();
    return $obj;
  }
    
  public function showOffice(){
    $obj = new Office();
    $obj = $obj->verify();
    return $obj;
  }
}