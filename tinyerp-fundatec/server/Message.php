<?php

/**
 * Description of Mensaje
 *
 * @author Armando Joaquin C <armand17.10@gmail.com>
 */
class Message {

    const MSJ_INFORMATION = 'alert-info';
    const MSJ_WARNING = 'alert-warning';
    const MSJ_ERROR = 'alert-danger';
    const MSJ_SUCCESS = 'alert-success';

    /**
     * 
     * @return type
     */
    public static function getMsjSesion() {
        
        $types = array(
            self::MSJ_INFORMATION,
            self::MSJ_WARNING,
            self::MSJ_SUCCESS,
            self::MSJ_ERROR
        );

        $msj = null;
        $type = null;

        foreach ($types as $_type) {
            if (Sesion::getAttr($_type) !== FALSE) {
                $msj = Sesion::getAttr($_type);
                $type = $_type;
                Sesion::deleteAttr($_type);
                break;
            }
        }
        return array('type' => $type, 'msj' => $msj);
    }

    public static function msjInformation($msj) {
        return self::setAlert(self::MSJ_INFORMATION, $msj);
    }

    public static function msjWarning($msj) {
        return self::setAlert(self::MSJ_WARNING, $msj);
    }

    public static function msjError($msj) {
        return self::setAlert(self::MSJ_ERROR, $msj);
    }

    public static function msjSuccess($msj) {
        return self::setAlert(self::MSJ_SUCCESS, $msj);
    }

    private static function setAlert($TYPE, $msj) {
        Sesion::setAttr($TYPE, $msj);
    }
    
}
