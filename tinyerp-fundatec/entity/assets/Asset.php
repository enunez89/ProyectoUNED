<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase que contiene las propiedades de un activo.
 *
 * @author enunezs89
 */
class Asset {

    //propiedades
    public $Id;
    public $Code;
    public $CodCategory;
    public $Brand;
    public $Price;
    public $IdProvider;
    public $CodState;
    public $SerialNumber;
    public $PlateNumber;
    public $Description;
    public $AcquisitionDate;
    public $IdWarranty;
    public $Warranty;

    function __construct() {
        
    }


    public function getId() {
        return $this->Id;
    }

    public function getCode() {
        return $this->Code;
    }

    public function getCodCategory() {
        return $this->CodCategory;
    }

    public function getBrand() {
        return $this->Brand;
    }

    public function getPrice() {
        return $this->Price;
    }

    public function getIdProvider() {
        return $this->IdProvider;
    }

    public function getCodState() {
        return $this->CodState;
    }

    public function getSerialNumber() {
        return $this->SerialNumber;
    }

    public function getPlateNumber() {
        return $this->PlateNumber;
    }

    public function getDescription() {
        return $this->Description;
    }

    public function getAcquisitionDate() {
        return $this->AcquisitionDate;
    }

    public function getIdWarranty() {
        return $this->IdWarranty;
    }
    
       public function getWarranty() {
        return $this->Warranty;
    }

    public function setId($Id) {
        $this->Id = $Id;
    }

    public function setCode($Code) {
        $this->Code = $Code;
    }

    public function setCodCategory($CodCategory) {
        $this->CodCategory = $CodCategory;
    }

    public function setBrand($Brand) {
        $this->Brand = $Brand;
    }

    public function setPrice($Price) {
        $this->Price = $Price;
    }

    public function setIdProvider($IdProvider) {
        $this->IdProvider = $IdProvider;
    }

    public function setCodState($CodState) {
        $this->CodState = $CodState;
    }

    public function setSerialNumber($SerialNumber) {
        $this->SerialNumber = $SerialNumber;
    }

    public function setPlateNumber($PlateNumber) {
        $this->PlateNumber = $PlateNumber;
    }

    public function setDescription($Description) {
        $this->Description = $Description;
    }

    public function setAcquisitionDate($AcquisitionDate) {
        $this->AcquisitionDate = $AcquisitionDate;
    }

    public function setIdWarranty($IdWarranty) {
        $this->IdWarranty = $IdWarranty;
    }
    
    public function setWarranty($Warranty) {
        $this->Warranty = $Warranty;
    }


}
