<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Repair {

    public $RepairId;
    public $Description;
    public $StudioName;
    public $DevolutionDate;
    public $CoverByWarranty;
    public $AttachementId;
    public $AssetId;
    public $FileURL;
    public $FileType;

    function __construct() {
        
    }
    public function getRepairId() {
        return $this->RepairId;
    }

    public function setRepairId($val) {
        $this->RepairId = $val;
    }
    public function getDescription() {
        return $this->Description;
    }

    public function setDescription($val) {
        $this->Description = $val;
    }
    public function getStudioName() {
        return $this->StudioName;
    }

    public function setStudioName($val) {
        $this->StudioName = $val;
    }
    public function getDevolutionDate() {
        return $this->DevolutionDate;
    }

    public function setDevolutionDate($val) {
        $this->DevolutionDate = $val;
    }
    
    public function getAttachementId() {
        return $this->AttachementId;
    }

    public function setAttachementId($val) {
        $this->AttachementId = $val;
    }
    public function getCoverByWarranty() {
        return $this->CoverByWarranty;
    }

    public function setCoverByWarranty($val) {
        $this->CoverByWarranty = $val;
    }
    
    public function getAssetId() {
        return $this->AssetId;
    }

    public function setAssetId($val) {
        $this->AssetId = $val;
    }

    public function getFileURL() {
        return $this->FileURL;
    }

    public function getFileType() {
        return $this->FileType;
    }

    public function setFileURL($FileURL) {
        $this->FileURL = $FileURL;
    }

    public function setFileType($FileType) {
        $this->FileType = $FileType;
    }


}
