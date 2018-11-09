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
            case 'newAssetForm': {
                    $this->runView("frmNewAsset", "assets/index");
                    break;
                }
            case 'editAssetForm': {
                    $this->runView("frmEditAsset", "assets/index");
                    break;
                }
            case 'consultRepairForm': {
                    $this->runView("frmConsultRepair", "assets/index");
                    break;
                }
            case 'newRepairForm': {
                    $this->runView("frmNewRepair", "assets/index");
                    break;
                }
            case 'newQuotationForm': {
                    $this->runView("frmConsultQuotation", "assets/index");
                    break;
                }
            case 'requestAssets': {
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->getAllAssets();
                    echo ($databaseResult);
                    break;
                }
            case 'getAllCategoryAssest': {
                    $assetsModel = new MActivos();
                    $getCategoryAssestResp = $assetsModel->getAllCategoryAssest();
                    echo ($getCategoryAssestResp);
                    break;
                }
            case 'getAssetById': {
                    $id = (int) $_POST["IdAsset"];
                    $assetsModel = new MActivos();
                    $getCategoryAssestResp = $assetsModel->getAssetById($id);
                    echo ($getCategoryAssestResp);
                    break;
                }
            case 'getAllProviders': {
                    $assetsModel = new MActivos();
                    $getProvidersAssestResp = $assetsModel->getAllProviders();
                    echo ($getProvidersAssestResp);
                    break;
                }
            case 'createAsset': {
                    //obtenemos el objeto Asset con los datos recibidos de la vista
                    $newAsset = $this->convertAssetFromPost($_POST["asset"], TRUE);
                    //seteamos el estado de activo
                    $newAsset->setCodState(1); //agregar
                    //enviamos a guardar
                    $assetsModel = new MActivos();
                    $insertAssestResp = $assetsModel->insertAsset($newAsset);
                    echo($insertAssestResp);
                    break;
                }
            case 'editAsset': {
                    $existingAsset = $this->convertAssetFromPost($_POST["asset"], FALSE);
                    $existingAsset->setCodState(1); //editar
                    $assetsModel = new MActivos();
                    $getCategoryAssestResp = $assetsModel->editAsset($existingAsset);
                    echo($getCategoryAssestResp);
                    break;
                }
            case 'deleteAsset': {
                    $id = (int) $_POST["IdAsset"];
                    $codEstado = 2; //eliminar = 2
                    $assetsModel = new MActivos();
                    $getCategoryAssestResp = $assetsModel->updateStateAsset($id, $codEstado);
                    echo($getCategoryAssestResp);
                    break;
                }
            case 'requestRepairs': {
                    $id = (int) $_POST["IdAsset"];
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->getAllRepairsByAssetId($id);
                    echo ($databaseResult);
                    break;
                }
            case 'createRepair': {
                    $newRepair = $this->convertRepairFromPost($_POST["repair"], TRUE);
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->insertRepair($newRepair);
                    echo ($databaseResult);
                    break;
                }
            case 'editRepair': {
                    $existingRepair = $this->convertRepairFromPost($_POST["repair"], FALSE);
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->editRepair($existingRepair);
                    echo ($databaseResult);
                    break;
                }
            case 'editRepairForm': {
                    $this->runView("frmEditRepair", "assets/index");
                    break;
                }
            case 'getRepairById': {
                    $id = (int) $_POST["IdRepair"];
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->getRepairById($id);
                    echo ($databaseResult);
                    break;
                }
            case 'deleteRepair': {
                    $id = (int) $_POST["IdRepair"];
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->deleteRepairById($id);
                    echo ($databaseResult);
                    break;
                }
            case 'newAssignmentForm': {
                    $this->runView("frmNewAssignment", "assets/index");
                    break;
                }
            case 'listAssignment': {
                    $this->runView("frmListAssignment", "assets/index");
                    break;
                }
            default :
                echo $this->showAssetsIndex();
                break;
        }
    }

    public function convertAssetFromPost($asset, $isNew) {
        $newAsset = new Asset();
        $jsonEncodeAsset = json_encode($asset);
        $assetObject = json_decode($jsonEncodeAsset);

        if ($isNew === FALSE) {
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

    public function convertRepairFromPost($repair, $isNew) {
        $jsonEncode = json_encode($repair);
        $repairObject = json_decode($jsonEncode);

        $newRepair = new Repair();
        if ($isNew === FALSE) {
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

}
