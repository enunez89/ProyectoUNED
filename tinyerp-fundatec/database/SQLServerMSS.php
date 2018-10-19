<?php

/**
 * Description of SQLServer
 *
 * @author Jonathan Obregón Cambronero <jobregon@itcr.ac.cr>
 */
require_once 'IConexion.php';

class SQLServer implements IConexion {

    public static $con=FALSE;

    public static function close() {      
        try {
         mssql_close(self::$con);
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
        return mssql_fetch_array($stmt);

    }

    public static function get_row_assoc($stmt) {
        return mssql_fetch_assoc($stmt);

    }
    public static function open() {

    ini_set('mssql.charset', 'UTF-8');
    self::$con = mssql_connect(MSSQL_SERVER_MATRIFUNDB, MSSQL_USER_MATRIFUNDB, MSSQL_PASS_MATRIFUNDB);
    mssql_select_db(MSSQL_DATABASE_MATRIFUNDB) 
    or die('Could not select a database.');
    if(!self::$con) {
         echo 'Could not connect';
         die('Could not connect: ' . mssql_error());                 
    }
    }

    public static function query($query) {      
        $result = mssql_query($query) 
        or die('A error occured: ' . mysql_error());
         return $result;
    }

    public static function query_params($query,$procedure_params) {
        $contador=0;
        $new_query="";
        for($i=0;$i<strlen($query);$i++){
            if($query[$i]=='?'){
            	if(is_numeric($procedure_params[$contador])) {
            		$new_query.= $procedure_params[$contador];
            	}else{
            		$new_query.= "'".$procedure_params[$contador]."'";            		
            	}
                
                $contador++;
            }else{
                $new_query.=$query[$i] ;
            }   
        } 
        $result = mssql_query($new_query) 
        or die('A error occured222: ' . mysql_error());
        return $result;
    }

}

