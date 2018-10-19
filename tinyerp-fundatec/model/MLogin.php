<?php

/**
 * Description of MLogin
 *
 */
require_once '../../utilities/utilities.php';
//require_once '../../entity/inversiones/MenuInversiones.php';

class MLogin {

    public function existeUsuario($username, $clave) {
        $utilitiesAux = new Utilities();
        try {
            $client = new SoapClient($utilitiesAux->getWSDLLogIn());
            $parametros = array('pApplicationID' => $utilitiesAux->getAplicationId(), 'pUserName' => $username, 'pPassword' => $clave);
          
            $result = $client->validateUser($parametros);
            if ($result->validateUserResult == null) {               
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

    private function getRolUsuario($id_usuario_local) {
        $query = "select id_rol from tbl_persona_datos where id in(select id_persona_datos from tbl_usuario_local where id = $id_usuario_local)";
        Mysql::open();
        $result = Mysql::query($query);
        $row = Mysql::get_row_array($result);
        Mysql::close();
        return (isset($row["id_rol"])) ? $row["id_rol"] : 0;
    }
}

//fin del class
