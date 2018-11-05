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
                $this->runView("frmEditAsset", "assets/index");
                break;
            }
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
            case 'getAssetById':{
                $id= (int) $_POST["IdAsset"];
                $assetsModel = new MActivos();
                $getCategoryAssestResp = $assetsModel->getAssetById($id);
                echo ($getCategoryAssestResp);
            break;
            }
             case 'getAllProviders':{
                $assetsModel = new MActivos();
                $getProvidersAssestResp = $assetsModel->getAllProviders();
                echo ($getProvidersAssestResp);
                break;
             }
<<<<<<< HEAD
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
=======
            case 'createAsset':{
                $newAsset= $this->convertAssetFromPost($_POST["asset"],TRUE);
                $newAsset->setCodState(1);//agregar
                $assetsModel = new MActivos();
                $getCategoryAssestResp = $assetsModel->insertAsset($newAsset);
                echo($getCategoryAssestResp);
                break;
            }
            case 'editAsset':{
                $existingAsset= $this->convertAssetFromPost($_POST["asset"],FALSE);
                $existingAsset->setCodState(1);//editar
                $assetsModel = new MActivos();
                $getCategoryAssestResp = $assetsModel->editAsset($existingAsset);
                echo($getCategoryAssestResp);
                break;
            }
             case 'deleteAsset':{
                $id= (int) $_POST["IdAsset"];
                $codEstado = 2;//eliminar = 2
                $assetsModel = new MActivos();
                $getCategoryAssestResp = $assetsModel->updateStateAsset($id,$codEstado);
                echo($getCategoryAssestResp);
                break;
            }
            case 'requestRepairs':{
                 $id= (int) $_POST["IdAsset"];
                $assetsModel = new MActivos();
                $databaseResult = $assetsModel->getAllRepairsByAssetId($id);
                echo ($databaseResult);
                break;
            }
            case 'createRepair':{
                $newRepair= $this->convertRepairFromPost($_POST["repair"],TRUE);
                $assetsModel = new MActivos();
                $databaseResult = $assetsModel->insertRepair($newRepair);
                echo ($databaseResult);
                break;
>>>>>>> cab637c90970fbf29203e09b0fdc66c882079bc4
            }
            default :
                echo $this->showAssetsIndex();
                break;
        }
    }

    public function convertAssetFromPost($asset,$isNew){
        $newAsset = new Asset();
        $jsonEncodeAsset = json_encode($asset);
        $assetObject = json_decode($jsonEncodeAsset);
        
        if($isNew === FALSE){
            $newAsset->setId($assetObject->IdActivo);
        }
        $newAsset->setCode($assetObject->Codigo);
        $newAsset->setCodCategory($assetObject->CodCategoria);
        $newAsset->setBrand($assetObject->Marca);
        $newAsset->setPrice($assetObject->PrecioAdquisicion);
        $newAsset->setIdProvider($assetObject->IdProveedor);
        $newAsset->setSerialNumber($assetObject->NumeroSerie);
        $newAsset->setPlateNumber($assetObject->NumeroPlaca);
        $newAsset->setDescription($assetObject->DesActivo);
        $newAsset->setAcquisitionDate($assetObject->FechaAdqusicion);
        $newAsset->setIdWarranty(0);
        return $newAsset;
    }

    public function convertRepairFromPost($repair,$isNew){
        $jsonEncode = json_encode($repair);
        $repairObject = json_decode($jsonEncode);
        
        $newRepair = new Repair();
        if($isNew === FALSE){
            $newRepair->setRepairId($repairObject->RepairId);
        }
        $newRepair->setAssetId($repairObject->AssetId);
        $newRepair->setStudioName($repairObject->StudioName);
        $newRepair->setDevolutionDate($repairObject->DevolutionDate);
        $newRepair->setDescription($repairObject->Description);
        $newRepair->setCoverByWarranty($repairObject->CoverByWarranty);
        $newRepair->setAttachementId(0);
        //echo($newRepair);
        return $newRepair;
    }
    
    protected function showAssetsIndex() {
        //$indexModelAux = new indexModel();
        // $this->CashRegister = $indexModelAux->getCashRegisterByUser();
        $this->runView("gestionActivos");
    }

    public function mostrarFrmActivos() {
        $this->runView("frmActivos");
    }

}
