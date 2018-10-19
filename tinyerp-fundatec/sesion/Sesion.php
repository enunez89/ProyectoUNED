<?php

class Sesion {

    const USERNAME = 'username';
    const PHPSESSID = 'PHPSESSID';

    /**
     * Esta funcion da a conocer si existe una sesión iniciada
     * mediante la constante USERNAME. Si este atributo de sesión
     * no existe, el sistema asume que no se ha iniciado sesión
     * @return type
     */
    public static function active() {
        return (self::getAttr(self::USERNAME) <> FALSE) ? TRUE : FALSE;
    }

    /**
     * Funcion para iniciar una sesion
     */
    public static function open() {       
        @session_start();
        Sesion::setAttr(self::PHPSESSID, $_COOKIE[self::PHPSESSID]);
        session_id(Sesion::getAttr(self::PHPSESSID));
    }

    public static function session_id() {
        return Sesion::getAttr(self::PHPSESSID);
    }

    /**
     * Funcion para destriur una sesión y todas las variables
     * relacionadas con la misma
     */
    public static function close() {
        if (isset($_SESSION)) {
            unset($_SESSION);
            session_destroy();
        }
    }

    /**
     * Funcion para asignar una variable de sesión
     * @param string $name
     * @param string $value
     */
    public static function setAttr($name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * Funcion para obtener un atributo de la sesión
     * @param string $name
     * @return string
     */
    public static function getAttr($name) {
        return (isset($_SESSION[$name])) ? $_SESSION[$name] : FALSE;
    }

    /**
     * Funcion para eliminar un atributo de la sesión
     * @param string $name
     */
    public static function deleteAttr($name) {
        if (self::getAttr($name) <> FALSE) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Funcion para obtener un arreglo con todos los atributos
     * de la sesión
     * @return array
     */
    public static function getAttrs() {
        return $_SESSION;
    }

}
