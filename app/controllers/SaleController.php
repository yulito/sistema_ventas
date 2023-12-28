<?php

namespace App\Controllers;

use App\Models\Sale;
use App\Models\SaleDetails;
use App\Helpers\Msg;

class SaleController extends Controller{

    public function index(){
        if($_SESSION['auth'] && $_SESSION['auth']->id_tipo == 2){
            return $this->view('sysbox');
        }else{
            return $this->redirect('/');
        }         
    }
    public function store(){
        $this->headJson();
        $this->validateToken($_POST['token_']);   
        
                
    }
    public function showEdit($id){
                        
    }
    public function edit(){
        $this->headJson();
        $this->validateToken($_POST['token_']); 
        
        
    }
}