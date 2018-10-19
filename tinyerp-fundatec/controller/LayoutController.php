<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LayoutController
 *
 * @author FUNDATEC
 */

class LayoutController extends controller{
       
     function __construct() {
        Sesion::open();
        $this->loadModelLyout("MLayout");
        $this->verificarSesionActiva();
      } 
    
    public function init(){
        $this-> MENU = "";        
        $aAux = new MLayout(); 
        $aAux->getMenu();         
        return $this-> MENU;
    }
    
    protected function show(){
        
    }
}