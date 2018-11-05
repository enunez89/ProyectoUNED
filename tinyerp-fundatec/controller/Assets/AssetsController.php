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
        $this->loadEntityAssets("Asset");
        //$this->loadModelContract("indexModel");
    }

    public function procesar() {
        $action = $this->getAction();

        switch ($action) {
            case 'nuevo':{
                $this->runView("frmNewAsset", "assets/index");
                break;
            }
            case 'editAsset':{
                $this->runView("frmEditAsset", "assets/index");
                break;
            }
            case 'newRepair':{
                $this->runView("frmNewRepair", "assets/index");
                break;
            }
            case 'requestAssets':{
                $assetsModel = new MActivos();
                $databaseResult = $assetsModel->getAllAssets();
                echo ($databaseResult);
                break;
            }
            case 'getAllCategoryAssest':{
                $assetsModel = new MActivos();
                $getCategoryAssestResp = $assetsModel->getAllCategoryAssest();
                echo ($getCategoryAssestResp);
            break;
            }
             case 'getAllProviders':{
                $assetsModel = new MActivos();
                $getProvidersAssestResp = $assetsModel->getAllProviders();
                echo ($getProvidersAssestResp);
                break;
             }
             case 'createAsset':{
               //obtenemos los datos del activo
                 $assetData = $_POST["asset"];
                 //creamos la entidad
                 $assetEntity = new Asset();
                 //obtenemos los datos
                 $assetEntity->setCode($assetData["Codigo"]);
                 $assetEntity->setCodCategory($assetData["CodCategoria"]);
                 $assetEntity->setBrand($assetData["Marca"]);
                 $assetEntity->setPrice($assetData["PrecioAdquisicion"]);
                 $assetEntity->setIdProvider($assetData["IdProveedor"]);
                 $assetEntity->setSerialNumber($assetData["NumeroSerie"]);
                 $assetEntity->setPlateNumber($assetData["NumeroPlaca"]);
                 $assetEntity->setDescription($assetData["DesActivo"]);
                 $assetEntity->setAcquisitionDate($assetData["FechaAdqusicion"]);
                 //$assetEntity->setAcquisitionDate('2018-11-01');
                 $assetEntity->setIdWarranty(0);
                 $assetEntity->setCodState(1);//estado activo
                 
                                
                 //se envia a guardar
                $assetsModel = new MActivos();
                $respInsertAsset = $assetsModel->insertAsset($assetEntity);
                echo (json_encode($respInsertAsset));
            break;
            }
            default :
                echo $this->showAssetsIndex();
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
