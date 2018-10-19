<?php

/**
 * Description of SQLServer_ft_control_users
 *
 * @author Jorge Castillo Vindas <jcastillo@itcr.ac.cr>
 */
require_once 'IConexion.php';

class SQLServer_ft_control_users implements IConexion {

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
            mssql_query($query);
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
        return sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
    }

    public static function open() {
        $connectionInfo = array('Database' => MSSQL_DATABASE_CONTROL_USER, 'UID' => MSSQL_USER_CONTROL_USER, 'PWD' => MSSQL_PASS_CONTROL_USER, "CharacterSet" => "UTF-8");
        self::$con = sqlsrv_connect(MSSQL_SERVER_CONTROLUSER, $connectionInfo);
    }

    public static function query($query) {
        return sqlsrv_query(self::$con, $query);
    }

}
