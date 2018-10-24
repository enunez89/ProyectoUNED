<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class indexController extends controller{
       
    function __construct() {
        parent::__construct(MODULO_ASSETS);
        Sesion::open();
        $this->verifyActiveSession();
        //$this->loadModelContract("indexModel");
    } 
    
    public function procesar(){
       if (isset($_POST["action"])) {
           switch ($this->getAction("action")) { 
                case 'nuevo':
                    $this->runView("frmActivos");
                break;
                case 'insertAssest':
                    $codigo = $_POST["codigo"];
                    echo json_encode("Guardado con éxito!!");
                    break;
               default :
                   break;
           }
       }else{
          $this->showContractHTML();
       }
    }
    
    protected function showContractHTML(){
        //$indexModelAux = new indexModel();
       // $this->CashRegister = $indexModelAux->getCashRegisterByUser();
        $this->runView("gestionActivos");
    }
    
    public  function mostrarFrmActivos(){
        $this->runView("frmActivos");
    }
    
    

}


