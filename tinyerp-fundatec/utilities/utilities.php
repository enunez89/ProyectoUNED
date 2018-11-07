<?php

/**
 * Description of MLogin
 *
 * @author Jonathan Obregón Cambronero <jocambronero@gmail.com>
 */

class Utilities {
    
        function __construct() {
        
    }
    
    function getWSDGTI(){
        return 'http://190.10.13.9/InscribeteCursos_Pruebas/WSCargaFundatec/CargaFUNDATEC.svc?wsdl';
    }
            
    function getWSDLLogIn() {
       return 'http://www.wcfloginft.fundatec.ac.cr/User.svc?wsdl';
      //  return 'http://172.20.26.98:8036/User.svc?wsdl';
    }
    
    function getWSCargaFacturaElectronica(){
        return 'http://pruebas.gticr.com/WSCargaFacturaAsync/Pruebas/GTICargaFactura.asmx?wsdl';
    } 
    
      function getWSDLPr2() {
        return 'http://localhost:13583/User.svc?wsdl';
    }
    
    function getAplicationId() {
        return 'C328C38B-2497-5E3E-A8F1-44725ECEF054';
    }    
    
    function getProfileImageUrl() {
        return "http://www.matricula.fundatec.ac.cr/Content/imagesProfile/";
    }
    
    function getServerHttpPath(){
        return "http://".$_SERVER['HTTP_HOST']."/actas/";
    }
    function getPathFiles(){
        return $_SERVER['HTTP_HOST']."/"."var/www/html/actas/";
    }
    
      function getDBSQL_password(){
        return "carolina08";
    }
    
      function getDBSQL_user(){
        return "cbenavides";
    }
    
    function getDBSQL_dataBase(){
        return "matrifunDB";
    }
    
    function getDBSQL_serverName(){
        return "172.20.26.98";
    }
    
    function getWSDLGestionActivos() {
       return 'http://localhost:8087/Minisif_ft.svc?wsdl';
    }
    
    function convertFileToDBArray($file){
        
        
        
    }
    
}//fin de class