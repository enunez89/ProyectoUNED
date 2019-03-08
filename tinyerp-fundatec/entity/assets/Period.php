<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Period {

    //propiedades
    public $IdPeriodo;
    public $StartDate;
    public $EndDate;
    public $StateCode;
    public $Description;

    function __construct() {
        
    }

    public function getIdPeriod() {
        return $this->IdPeriodo;
    }    
    public function getStartDate() {
        return $this->StartDate;
    }
    public function getEndDate() {
        return $this->EndDate;
    }
    public function getStateCode() {
        return $this->StateCode;
    }
    public function getDescription() {
        return $this->Description;
    }
    
     public function setIdPeriod($IdPeriod) {
        $this->IdPeriodo = $IdPeriod;
    }
     public function setStartDate($StartDate) {
        $this->StartDate = $StartDate;
    }
     public function setEndDate($EndDate) {
        $this->EndDate = $EndDate;
    }
     public function setStateCode($StateCode) {
        $this->StateCode = $StateCode;
    }
     public function setDescription($Description) {
        $this->Description = $Description;
    }
}
