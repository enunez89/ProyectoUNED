<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase que contiene las propiedades de un activo.
 *
 * @author cesar
 */
class Assignment {
    
     //propiedades
    public $Id;
    public $IdResponsable;
    public $AssignmentDate;
    public $DevolutionDate;
    public $StateCode;
    public $Assets;

    function __construct() {
        
    }

    public function getId() {
        return $this->Id;
    }
    
    public function getIdResponsable() {
        return $this->IdResponsable;
    }
    
    public function getAssignmentDate() {
        return $this->AssignmentDate;
    }
    
    public function getDevolutionDate() {
        return $this->DevolutionDate;
    }
    
    public function getStateCode() {
        return $this->StateCode;
    }
    
    public function getAssets() {
        return $this->Assets;
    }
    
    public function setId($Id) {
        $this->Id = $Id;
    }
    
    public function setIdResponsable($IdResponsable) {
        $this->IdResponsable = $IdResponsable;
    }
    
    public function setAssignmentDate($AssignmentDate) {
        $this->AssignmentDate = $AssignmentDate;
    }
    
    public function setDevolutionDate($DevolutionDate) {
        $this->DevolutionDate = $DevolutionDate;
    }
    
    public function setStateCode($StateCode) {
        $this->StateCode = $StateCode;
    }
    
    public function setAssets($Assets) {
        $this->Assets = $Assets;
    }
    
}