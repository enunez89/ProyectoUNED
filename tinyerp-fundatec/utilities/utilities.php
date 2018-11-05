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
    
    function  getDateFormatToDB($date){
        /*
         * Función que convierte una fecha en formato dd-mm-yyyy en formato yyyy-mm-dd
         * para poderla enviar a base de datos
         */
        
        //separamos la fecha 
        //posición 0 = día
        //posición 1 = mes
        //posición 2 = año
        $arrStrDate = explode("-", $date);
        
        //obtenemos un string con el formato para base de datos yyyy-mm-dd
        $dateFormatDB = $arrStrDate[2] + "-" + $arrStrDate[1] + "-" + $arrStrDate[0];
        
        return $dateFormatDB;
    }
    
}//fin de class