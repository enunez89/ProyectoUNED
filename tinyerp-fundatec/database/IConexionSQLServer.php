<?php

/**
 * Interface para controlar los métodos que deben llevar
 * las clases de conexión para MYsql y otros en caso de que
 * así se requiera
 */
interface IConexionSQLServer {

    public static function open();

    public static function close();

    public static function query($query);
    
    public static function query_params($query,$params);

    public static function get_row_array($resultset);

    public static function execute($query);

    public static function get_connection();
}
