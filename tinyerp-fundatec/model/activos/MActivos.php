<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Esta clase se encarga de obtener y enviar datos a los servicios o base de datos
 * respectiva.
 *
 * @author enunezs89
 */
require_once '../../utilities/utilities.php';
class MActivos {
    
    public  function obtenerActivosERP(){
        $utilitiesAux = new Utilities();
        
        try {
            //creamos el cliente soap
            $client = new SoapClient($utilitiesAux->getWSDLGestionActivos());
            //$parametros = array('pApplicationID' => $utilitiesAux->getAplicationId(), 'pUserName' => $username, 'pPassword' => $clave);
          
            //se realiza el llamado al metodo del wcf
            $result = $client->ListarActivos();
            if ($result == null) {               
                return false;
            } else {
                Sesion::setAttr("firstname", $result->validateUserResult->FirstName);
                Sesion::setAttr("lastname", $result->validateUserResult->LastName);
                Sesion::setAttr("globalUserId", $result->validateUserResult->UserID);
                Sesion::setAttr("username", $result->validateUserResult->Username);
                Sesion::setAttr("identification", $result->validateUserResult->Identification);
                Sesion::setAttr("imageProfile", $utilitiesAux->getProfileImageUrl() . "/" . $result->validateUserResult->ImageProfile);
                Sesion::setAttr("idUsuarioLocal", $result->validateUserResult->UserID);
                Sesion::setAttr("idUsuarioGlobal", $result->validateUserResult->UserID);
                return true;
            }
        } catch (Exception $e) {
            print "Caught exception: " . $e->getMessage() . "\n";
            return false;
        }
    }
}
