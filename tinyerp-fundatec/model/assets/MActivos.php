<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Esta clase se encarga de obtener y enviar datos a los servicios o base de datos
 * respectiva.
 *
 * @author enunezs89
 */
require_once '../../../utilities/utilities.php';

class MActivos {

    public function obtenerActivosERP() {
        $utilitiesAux = new Utilities();

        try {
            //creamos el cliente soap
            $client = new SoapClient($utilitiesAux->getWSDLGestionActivos());
            //$parametros = array('pApplicationID' => $utilitiesAux->getAplicationId(), 'pUserName' => $username, 'pPassword' => $clave);
            //se realiza el llamado al metodo del wcf
            $result = $client->ListarActivos();
            if ($result == null) {
                return false;
            } else {
                Sesion::setAttr("firstname", $result->validateUserResult->FirstName);
                Sesion::setAttr("lastname", $result->validateUserResult->LastName);
                Sesion::setAttr("globalUserId", $result->validateUserResult->UserID);
                Sesion::setAttr("username", $result->validateUserResult->Username);
                Sesion::setAttr("identification", $result->validateUserResult->Identification);
                Sesion::setAttr("imageProfile", $utilitiesAux->getProfileImageUrl() . "/" . $result->validateUserResult->ImageProfile);
                Sesion::setAttr("idUsuarioLocal", $result->validateUserResult->UserID);
                Sesion::setAttr("idUsuarioGlobal", $result->validateUserResult->UserID);
                return true;}
        } catch (Exception $e) {
            print "Caught exception: " . $e->getMessage() . "\n";
            return false;
        }
    }

    public function getAllAssets() {
        Mysql::open();
        $query = "CALL pr_GetAllAssets();";
        $assets = array();
        $result = Mysql::query($query);
        while ($row = Mysql::get_row_array($result)) {
            array_push($assets, $row);
        }
        Mysql::close();
        return json_encode($assets);
    }
    
     public function getAssetById($id) {
        Mysql::open();

        $query = "CALL pr_GetAssetById(@searchedAsset);";
        $queryConParametro = str_replace("@searchedAsset",$id,$query);
        $result = Mysql::query($queryConParametro);
        $asset = array();
        while ($row = Mysql::get_row_array($result)) {
            array_push($asset, $row);
        }
        Mysql::close();
        return json_encode($asset);
    }
    
    public function getAllCategoryAssest(){
        /**
         * Método que obtiene de base de datos el catalogo de categorias de activos
         */
        Mysql::open();
        $query = "CALL pr_GetAllCategoryAssest();";
        $categories = array();
        $result = Mysql::query($query);
        while ($row = Mysql::get_row_array($result)) {
            array_push($categories, $row);
        }
        Mysql::close();
        return json_encode($categories);
        
    }
    
    public function getAllProviders(){
        /**
         * Método que obtiene de base de datos el catalogo de proveedores de activos
         */
        Mysql::open();
        $query = "CALL pr_getAllProviders();";
        $providers = array();
        $result = Mysql::query($query);
        while ($row = Mysql::get_row_array($result)) {
            array_push($providers, $row);
        }
        Mysql::close();
        return json_encode($providers);
        
    }
    
    public function insertAsset(Asset $asset) {
        /**
         * Método que guarda la información de un activo en base de datos.
         */ 
       $utilitiesAux = new Utilities();
        try {
            //obtenemos los parametros del sp
            $codigo = $asset->getCode();
            $codCategoria = $asset->getCodCategory();
            $marca = $asset->getBrand();
            $precio =  $asset->getPrice();
            $idProveedor = $asset->getIdProvider();
            $codEstado = $asset->getCodState();
            $numSerie = $asset->getSerialNumber();
            $numPlaca = $asset->getPlateNumber();
            $descripcion = $asset->getDescription();
            $fechaAdquisicion = $asset->getAcquisitionDate();
            $idGarantia = $asset->getIdWarranty();

            Mysql::open();
            $sql = "CALL pr_InsertAssest('$codigo', $codCategoria, '$marca', "
                    . "$precio, $idProveedor, $codEstado, '$numSerie', '$numPlaca', "
                    . "'$descripcion', '$fechaAdquisicion', $idGarantia); ";
            Mysql::execute($sql);
            Mysql::close();
            return 1;
        } catch (Exception $exc) {
            return -1;
        }
    }
    
     public function editAsset(Asset $asset) {
        /**
         * Método que guarda la información de un activo en base de datos.
         */ 
        
        try {
            //obtenemos los parametros del sp
            $idActivo = $asset->getId();
            $codigo = $asset->getCode();
            $codCategoria = $asset->getCodCategory();
            $marca = $asset->getBrand();
            $precio =  $asset->getPrice();
            $idProveedor = $asset->getIdProvider();
            $codEstado = $asset->getCodState();
            $numSerie = $asset->getSerialNumber();
            $numPlaca = $asset->getPlateNumber();
            $descripcion = $asset->getDescription();
            $fechaAdquisicion = $asset->getAcquisitionDate();
            $idGarantia = $asset->getIdWarranty();

            Mysql::open();
            $sql = "CALL pr_EditAssest($idActivo,'$codigo', $codCategoria, '$marca', "
                    . "$precio, $idProveedor, $codEstado, '$numSerie', '$numPlaca', "
                    . "'$descripcion', '$fechaAdquisicion', $idGarantia); ";
            Mysql::execute($sql);
            Mysql::close();
            return 1;
        } catch (Exception $exc) {
            return -1;
        }
    }
    
     public function updateStateAsset($idActivo, $codEstado) {
        /**
         * Método que guarda la información de un activo en base de datos.
         */ 
        
        try {
            Mysql::open();
            $sql = "CALL pr_ChangeStateAsset($idActivo,$codEstado); ";
            Mysql::execute($sql);
            Mysql::close();
            return 1;
        } catch (Exception $exc) {
            return -1;
        }
    }
    
     public function getAllRepairsByAssetId($idAsset) {
        Mysql::open();
        $query = "CALL pr_GetAllRepairsByAssetId($idAsset);";
        $assets = array();
        $result = Mysql::query($query);
        while ($row = Mysql::get_row_array($result)) {
            array_push($assets, $row);
        }
        Mysql::close();
        return json_encode($assets);
    }
    
    public function insertRepair(Repair $repair) {
        /**
         * Método que guarda la información de un activo en base de datos.
         */ 
        
        try {
            //obtenemos los parametros del sp
            $assetId = $repair->getAssetId();
            $description = $repair->getDescription();
            $studioName = $repair->getStudioName();
            $devolutionDate = $repair->getDevolutionDate();
            $coverByWarranty = $repair->getCoverByWarranty();
            $attachementId = $repair->getAttachementId();

            Mysql::open();          
            $sql = "CALL pr_InsertRepair($assetId, '$description', '$studioName'"
                    . ", '$devolutionDate', $coverByWarranty, $attachementId);";
            Mysql::execute($sql);
            Mysql::close();
            return 1;
        } catch (Exception $exc) {
            return -1;
        }
    }
    
    public function editRepair(Repair $repair) {
        /**
         * Método que guarda la información de un activo en base de datos.
         */ 
        
        try {
            $repairId = $repair->getRepairId();
            $assetId = $repair->getAssetId();
            $description = $repair->getDescription();
            $studioName = $repair->getStudioName();
            $devolutionDate = $repair->getDevolutionDate();
            $coverByWarranty = $repair->getCoverByWarranty();
            $attachementId = $repair->getAttachementId();

            Mysql::open();
            $sql = "CALL pr_InsertRepair($assetId, '$description', '$studioName'"
                    . ", '$devolutionDate', $coverByWarranty, $attachementId);";
            Mysql::execute($sql);
            Mysql::close();
            return 1;
        } catch (Exception $exc) {
            return -1;
        }
    }
}
