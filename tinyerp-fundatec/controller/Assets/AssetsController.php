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
            case 'consultQuotationForm': {
                    $this->runView("frmConsultQuotation", "assets/index");
                    break;
                }
            case 'newQuotationForm': {
                    $this->runView("frmNewQuotation", "assets/index");
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
            case 'requestQuotations': {
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->getAllQuotations();
                    echo ($databaseResult);
                    break;
                }
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
            case 'newPhysicalInventoryForm': {
                    $this->runView("frmListPeriod", "assets/index");
                    break;
                }
            case 'newPeriodForm': {
                    $this->runView("frmNewPeriod", "assets/index");
                    break;
                }
            case 'editPeriodForm': {
                    $this->runView("frmEditPeriod", "assets/index");
                    break;
                }
            case 'getAssetsToAssign': {
                    $valuetosearch = $_POST["valuetosearch"];
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->getAllAssetsByCodePlateDescription($valuetosearch);
                    echo ($databaseResult);
                    break;
                }
            case 'createQuotation': {
                    $newQuotation = $this->convertQuotationFromPost($_POST["quotation"], TRUE);
                    $assetsModel = new MActivos();
                    $lastIdInserted = $assetsModel->insertQuotation($newQuotation);
                    if($lastIdInserted != -1){
                        $newQuotation->setIdQuotation($lastIdInserted);
                        $databaseResult = $assetsModel->insertMultipleAssetsOnQuotation($newQuotation);
                        echo ($databaseResult);
                    }else{
                        echo ($lastIdInserted); 
                    }
                    break;
                }
                 case 'editQuotationForm': {
                    $this->runView("frmEditQuotation", "assets/index");
                    break;
                }
                case 'getQuotationById': {
                    $id = (int) $_POST["IdCotizacion"];
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->getQuotationById($id);
                    echo ($databaseResult);
                    break;
                }
                 case 'editQuotation': {
                    $existingQuotation = $this->convertQuotationFromPost($_POST["quotation"], FALSE);
                    $assetsModel = new MActivos();
                     $databaseResult = $assetsModel->editQuotation($existingQuotation);
                     if($databaseResult == 1){
                        $databaseResult = $assetsModel->insertMultipleAssetsOnQuotation($existingQuotation);     
                        echo($databaseResult);
                     }else{
                         echo(-1);//caso error al actualizar el encabezado
                     }
                    
                    break;
                }
                case 'deleteQuotation': {
                    $id = (int) $_POST["IdCotizacion"];
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->deleteQuotationById($id);
                    echo ($databaseResult);
                    break;
                }
                
                case 'getAllPeriods': {
                    $assetsModel = new MActivos();
                    $getPeriodsResp = $assetsModel->getAllPeriods();
                    echo ($getPeriodsResp);
                    break;
                }
                
                case 'getAllPeriodStates': {
                    $assetsModel = new MActivos();
                    $getPeriodsResp = $assetsModel->getAllPeriodStates();
                    echo ($getPeriodsResp);
                    break;
                }
                case 'createPeriod': {
                    $newPeriod = $this->convertPeriodFromPost($_POST["period"], TRUE);
                    //enviamos a guardar
                    $assetsModel = new MActivos();
                    $insertPeriodResponse = $assetsModel->insertPeriod($newPeriod);
                    echo($insertPeriodResponse);
                    break;
                }
                case 'frmListPeriod': {
                    $this->runView("frmListPeriod", "assets/index");
                    break;
                }
                 case 'getPeriodById': {
                    $id = (int) $_POST["IdPeriodo"];
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->getPeriodById($id);
                    echo ($databaseResult);
                    break;
                }
                case 'editPeriod': {
                    $existingPeriod = $this->convertPeriodFromPost($_POST["period"], FALSE);
                    $assetsModel = new MActivos();
                    $databaseResult = $assetsModel->editPeriod($existingPeriod);                    
                     echo ($databaseResult);
                    break;
                }
            default :
                echo $this->showAssetsIndex();
                break;
        }
    }
    
    public function convertQuotationFromPost($quotation, $isNew) {
        $newQuotation = new Quotation();
        $jsonEncodeQuotation = json_encode($quotation);
        $quotationObject = json_decode($jsonEncodeQuotation);

        if ($isNew === FALSE) {
            $newQuotation->setIdQuotation($quotationObject->Id);
        }
        $newQuotation->setAmount($quotationObject->Monto);
        $newQuotation->setFileURL($quotationObject->IdArchivoAdjunto);
        $newQuotation->setProviderId($quotationObject->IdProveedor);
        $newQuotation->setAssets($quotationObject->Assets);       
        $newQuotation->setDueDate($quotationObject->FechaVencimiento);  
        return $newQuotation;
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
        if ($assetObject->IdGarantia != '') {
            $newAsset->setIdWarranty($assetObject->IdGarantia);
        } else {
            $newAsset->setIdWarranty(0);
        }
        $newAsset->setExpirationDateWarranty($assetObject->FechaVencimientoGarantia);
        $newAsset->setTermsWarranty($assetObject->CondicionesGarantia);
        $newAsset->setFileTypeWarranty($assetObject->TipoArchivoGarantia);
        $newAsset->setFileURLWarranty($assetObject->NomArchivoGarantia);
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
        $newRepair->setFileURL($repairObject->FileName);
        $newRepair->setFileType($repairObject->FileType);
        //echo($newRepair);
        return $newRepair;
    }

    public function convertPeriodFromPost($period, $isNew) {
        $jsonEncode = json_encode($period);
        $periodObject = json_decode($jsonEncode);

        $newPeriod = new Period();
        if ($isNew === FALSE) {
            $newPeriod->setIdPeriod($periodObject->IdPeriod);
        }
        $newPeriod->setDescription($periodObject->Description);
        $newPeriod->setEndDate($periodObject->EndDate);
        $newPeriod->setStartDate($periodObject->StartDate);
        $newPeriod->setStateCode($periodObject->StateCode);
        return $newPeriod;
    }
    protected function showAssetsIndex() {
        //$indexModelAux = new indexModel();
        // $this->CashRegister = $indexModelAux->getCashRegisterByUser();
        $this->runView("gestionActivos");
    }

}
