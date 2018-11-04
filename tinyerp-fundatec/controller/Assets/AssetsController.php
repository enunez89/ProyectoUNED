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
            case 'newAssetForm':{
                $this->runView("frmNewAsset", "assets/index");
                break;
            }
            case 'editAssetForm':{
                $this->runView("frmEditAsset", "assets/index");
                break;
            }
            case 'consultRepairForm':{
                $this->runView("frmConsultRepair", "assets/index");
                break;
            }
            case 'newRepairForm':{
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

    protected function showAssetsIndex() {
        //$indexModelAux = new indexModel();
        // $this->CashRegister = $indexModelAux->getCashRegisterByUser();
        $this->runView("gestionActivos");
    }

    public function mostrarFrmActivos() {
        $this->runView("frmActivos");
    }

}
