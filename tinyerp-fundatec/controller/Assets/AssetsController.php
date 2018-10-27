<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AssetsController extends controller {

    function __construct() {
        parent::__construct(MODULO_ASSETS);
        Sesion::open();
        $this->verifyActiveSession();
        $this->loadModelAssets("MActivos");
        //$this->loadModelContract("indexModel");
    }

    public function procesar() {
        $action = $this->getAction();

        switch ($action) {
            case 'nuevo':
                $this->runView("frmNewAsset", "assets/index");
                break;
            case 'editAsset':
                $this->runView("frmEditAsset", "assets/index");
                break;
            case 'newRepair':
                $this->runView("frmNewRepair", "assets/index");
                break;
            case 'requestAssets':
                $assetsModel = new MActivos();
                $databaseResult = $assetsModel->getAllAssets();
                echo ($databaseResult);
                break;
            case 'getAllCategoryAssest':
                $assetsModel = new MActivos();
                $getCategoryAssestResp = $assetsModel->getAllCategoryAssest();
                echo ($getCategoryAssestResp);
            default :
                $this->showAssetsIndex();
                break;
        }
    }

//    public function procesar(){
//       if (isset($_POST["action"])) {        
//           switch ($this->getAction("action")) { 
//                case 'nuevo':
//                   $this->runView("frmActivos", "assets/index");
//                break;
//                case 'insertAssest':
//                    $codigo = $_POST["codigo"];
//                    echo (json_encode($codigo) );
//                    break;
//                case 'requestAssets':
//                    $assetsModel = new MActivos();    
//                    $databaseResult = $assetsModel->getAllAssets();
//                    echo ($databaseResult);                    
//                    break;
//               default :
//                   break;
//           }
//       }else{
//          $this->showAssetsIndex();
//       }
//    }

    protected function showAssetsIndex() {
        //$indexModelAux = new indexModel();
        // $this->CashRegister = $indexModelAux->getCashRegisterByUser();
        $this->runView("gestionActivos");
    }

    public function mostrarFrmActivos() {
        $this->runView("frmActivos");
    }

}
