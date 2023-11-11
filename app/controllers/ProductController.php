<?php

namespace App\Controllers;

use App\Models\Product;
use App\Helpers\Msg;

class ProductController extends Controller{

    public function index(){
        
    }

    public function adminProduct(){
        return $this->view('productAdmin');
    }
}