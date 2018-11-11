<?php

/**
 * Interface para controlar los métodos que deben llevar
 * las clases de conexión para MYsql y otros en caso de que
 * así se requiera
 */
interface IConexion {

    public static function open();

    public static function close();

    public static function query($query);
    
    public static function query_params($query,$procedure_params);

    public static function get_row_array($resultset);

    public static function execute($query);

    public static function get_connection();
    
    public static function prepare($procedureCall,$types,$value);
  
    public static  function last_id();
    
}
