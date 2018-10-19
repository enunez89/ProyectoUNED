<?php

class Request {

    /**
     * Retorna un atributo ya sea de $_POST, $_GET o $_REQUEST
     * @param string $name
     * @return string (si no lo encuentra devuelve null)
     * @author Armando Joaquin C <armand17.10@gmail.com>
     */
    public static function getAttr($name) {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;
    }

    /**
     * Funcion para retornar todos los elementos del arreglo
     * $_REQUEST, este arreglo incluye atributos de $_POST, $_GET
     * @return array
     */
    public static function getAttrs() {
        return $_REQUEST;
    }

    public static function getArray($name){
        return filter_input(INPUT_POST, $name, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    }
    
}
