<?php

require_once 'IConexion.php';

class Mysql implements IConexion {

    //variable que contiene la instancia de la conexion a Mysql
    private static $con = FALSE;

    /**
     * Funcion para obtener la información de la conexión,
     * en caso de que la conexión no exista, devuelve null
     * @return mysqli_connection
     */
    public static function get_connection() {
        return self::$con;
    }

    /**
     * Funcion para abrir una nueva conexión a Mysql.
     * En caso de que no se contecte muestra un error en pantalla
     */
    public static function open() {
        self::$con = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASS, MYSQL_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Error de conexión a MySQL: " . mysqli_connect_error();
        }
    }

     /**
     * Funcion para abrir una nueva conexión a Mysql para el modulo de inversiones.
     * En caso de que no se contecte muestra un error en pantalla
     */
    public static function openInvestment() {
        self::$con = mysqli_connect(MYSQL_SERVER_INVESTMENT, MYSQL_USER_INVESTMENT, MYSQL_PASS_INVESTMENT, MYSQL_DATABASE_INVESTMENT);
        self::$con->set_charset("utf8");
        if (mysqli_connect_errno()) {
            echo "Error de conexión a MySQL: " . mysqli_connect_error();
        }
    }
    
    /**
     * Funcion para cerrar una conexión a mysql
     */
    public static function close() {
        if (self::$con <> FALSE) {
            mysqli_close(self::$con);
            self::$con = FALSE;
        }
    }

    /**
     * Funcion para obtener un resultset de una consulta SQL
     * hecha a mysql
     * @param string $query
     * @return resultset
     */
    public static function query($query) {
        $result = mysqli_query(self::$con, $query);
        if($result === false){
            echo mysqli_error(self::$con);
        }
        else{
        return $result;
        }
    }

    public static function query_params($query,$procedure_params) {
        return mysqli_query(self::$con, $query,$procedure_params);
    }
    
    /**
     * Funcion para obtener una fila con los resultados de una consulta
     * resultset sql
     * @param resultset $resultset
     * @return array
     */
    public static function get_row_array($resultset) {
        return mysqli_fetch_assoc($resultset);
    }

    /**
     * Funcion para ejecutar una consulta en SQL y conocer
     * si se ejecutó correctamente
     * @param string $query
     * @return bool
     */
    public static function execute($query) {
        return (self::query($query) !== FALSE) ? TRUE : FALSE;
    }
    
    public static function prepare($procedureCall,$types,$value) {
        return mysqli_prepare(self::$con, $procedureCall);
    }
    

}
