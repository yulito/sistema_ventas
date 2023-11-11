<?php

namespace Lib;

use App\Models\Category;
use App\Models\TypeUser;

trait Utils{

    public function showCategories(){ 
		/*$cat = new Category();
		$cat = $cat->showCat();
		return $cat;*/
    }

    public function showTypeUser(){
        $cat = new TypeUser();
		$cat = $cat->getAll();
		return $cat;
    }
}