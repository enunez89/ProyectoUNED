<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ControllerIndex extends Controller {
    
        function __construct() {
        parent::__construct(MODULO_INICIAL);
        Sesion::open();
        $this->verificarSesionActiva();
        $this->model("MIndex");
    }

    
    public function procesar() {
        if (isset($_POST["action"])) {
            switch ($this->getAction("action")) {
                case 'getAplication':
                    echo $this->setApplicationIdGlobal($_POST["applicationId"]);
                    break;
                default:
                    echo $this->viewModules();
                    break;
            }
        } else {
            $this->viewModules();
        }
    }

    public function viewModules(){
    $aAux = new MIndex();  
    $userId = Sesion::getAttr("idUsuarioGlobal");
    $this->applications = $aAux->getApplicationsUsers($userId); 
    $this->view("indexModules","index");
    }
    
    public function getApplicationsUsers($userId) {
        $aAux = new MIndex();     
         return $aAux->getApplicationsUsers($userId);         
    }
    
    public function setApplicationIdGlobal($application){
        $_SESSION['applicationGlobal'] = $application;
        return true;
    }
}