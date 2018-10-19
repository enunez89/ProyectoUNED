<?php

/**
 * Description of SQLServer
 *
 * @author Jonathan Obregón Cambronero <jobregon.ac.cr>
 */
require_once 'IConexionSQLServer.php';

class SQLServer implements IConexionSQLServer {

    private static $con = FALSE;

    public static function close() {
        try {
            sqlsrv_close(self::$con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function execute($query) {
        try {
            sqlsrv_execute($query);
            return TRUE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return FALSE;
    }

    public static function get_connection() {
        return self::$con;
    }

    public static function get_row_array($stmt) {
        return sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
    }

    public static function get_row_assoc($stmt) {
        return sqlsrv_fetch_array( $stmt,SQLSRV_FETCH_ASSOC);
    }
    public static function open() {        
        $connectionInfo = array("Database" => MSSQL_DATABASE_MATRIFUNDB, "UID" =>MSSQL_USER_MATRIFUNDB, "PWD" => MSSQL_PASS_MATRIFUNDB,"CharacterSet" => "UTF-8");
        self::$con = sqlsrv_connect(MSSQL_SERVER_MATRIFUNDB, $connectionInfo); 
    }

    public static function query($query) {
        return sqlsrv_query(self::$con, $query);
    }
    public static function query_params($query,$procedure_params) {
        return sqlsrv_query(self::$con, $query,$procedure_params);
    }
}
