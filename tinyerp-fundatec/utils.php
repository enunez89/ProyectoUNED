<?php

//Este archivo contiene funciones libres que pueden ser usadas en los módulos
//del sistema, no requiren estar dentro de una clase para ser fáciles de invocar

/**
 * Funcion para incluir (require_once) un controlador en el archivo
 * index.php de cada módulo
 */
function requireController($controller) {
    $PATH = ".." . SD . ".." . SD . Controller::CAPA_CONTROLLER . SD . $controller;
    require_once $PATH;
}

function requireTemplate($filename) {
    require_once 'html/' . $filename;
}

function limpiarString($cadena) {
    $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹", " ");
    $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "_");
    $texto = str_replace($no_permitidas, $permitidas, $cadena);
    return $texto;
}
