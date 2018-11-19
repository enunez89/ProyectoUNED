<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Quotation
 *
 * @author cesaq
 */
class Quotation {
    public $IdQuotation;
    public $ProviderId;
    public $FileURL;
    public $Amount;
    public $Assets;
    public $DueDate;
    
     function __construct() {
        
    }
    
    public function setIdQuotation($value) {
        $this->IdQuotation = $value;
    }
    
    public function setProviderId($value) {
        $this->ProviderId = $value;
    }
    
    public function setFileURL($value) {
        $this->FileURL = $value;
    }
    
    public function setAmount($value) {
        $this->Amount = $value;
    }
    
    public function setAssets($value) {
        $this->Assets = $value;
    }
    
    public function setDueDate($value) {
        $this->DueDate = $value;
    }
    
    public function getIdQuotation() {
        return $this->IdQuotation;
    }
    
     public function getDueDate() {
        return $this->DueDate;
    }
    
     public function getProviderId() {
        return $this->ProviderId;
    }
    
     public function getFileURL() {
        return $this->FileURL;
    }
    
    public function getAmount() {
        return $this->Amount;
    }
    
    public function getAssets() {
        return $this->Assets;
    }
    
}
