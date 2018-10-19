<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application
 *
 * @author FUNDATEC
 */
class ApplicationUser {
    public $ApplicationName;
    public $ApplicationId;
    public $Description;
    public $URL;
    public $UserID;
    public $NameIcon;
    
    function __construct() {}
    
    function getApplicationName() {
        return $this->ApplicationName;
    }
    
    function getApplicationId() {
        return $this->ApplicationId;
    }
    
    function getDescription() {
        return $this->Description;
    }
    
    function getURL() {
        return $this->URL;
    }
    
    function getUserID() {
        return $this->UserID;
    }    
    
    function getNameIcon(){
        return $this->NameIcon;
    }
    
    function setApplicationName($ApplicationName) {
        $this->ApplicationName = $ApplicationName;
    }
    
    function setApplicationId($ApplicationId) {
        $this->ApplicationId = $ApplicationId;
    }
    
    function setDescription($Description) {
        $this->Description = $Description;
    }
    
    function setURL($URL) {
        $this->URL = $URL;
    }
    
    function setUserID($UserID) {
        $this->UserID = $UserID;
    }
    
    function setNameIcon($NameIcon) {
        $this->NameIcon = $NameIcon;
    }
}

  
