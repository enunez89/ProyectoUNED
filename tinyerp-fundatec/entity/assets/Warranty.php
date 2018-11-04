<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase que contiene las propiedades de una garantia.
 *
 * @author cesaqui89
 */
class Warranty {
  //propiedades
    public $Id;
    public $ExpirationDate;
    public $Conditions;
    
function __construct() {
        
    }
    
     public function getId() {
        return $this->Id;
    }

    public function getExpirationDate() {
        return $this->ExpirationDate;
    }

    public function getConditions() {
        return $this->Conditions;
    }
    
     public function setId($Id) {
        $this->Id = $Id;
    }

    public function setExpirationDate($ExpirationDate) {
        $this->ExpirationDate = $ExpirationDate;
    }

    public function setConditions($Conditions) {
        $this->Conditions = $Conditions;
    }
    
}