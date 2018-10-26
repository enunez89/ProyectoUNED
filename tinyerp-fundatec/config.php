<?php

//codificar todas las impresiones desde PHP como UTF-8
header('Content-Type: text/html; charset=UTF-8');

//mostrar los errores en el código fuente PHP
ini_set("display_errors", 1);
error_reporting(-1);


date_default_timezone_set("America/Costa_Rica");

//************************************************************************//
//************************************************************************//
//
//
////DIRECTORIO DONDE SE ENCUENTRAN LOS MÓDULOS DEL SISTEMA
//define('DIR_MODULOS', 'module');
//// SLASH WINDOWS
//define('SD', '/');
////SERVIDOR DE BASE DE DATOS
//define('MYSQL_SERVER', '190.0.226.98');//190.0.226.98 actas
//define('MYSQL_SERVER_INVESTMENT', '190.0.226.98');
//define('MSSQL_SERVER', '190.0.226.98');// SQL Server
//define('MSSQL_SERVER_CONTROLUSER', '190.0.226.98');// SQL Server
////USUARIO DE CONEXION A BASE DE DATOS
//define('MYSQL_USER', 'ftactas');//ftactas
//define('MYSQL_USER_INVESTMENT', 'tinyerp');//ftactas
//define('MSSQL_USER', 'usrFTMatricula');
//define('MSSQL_USER_CONTROL_USER', 'usrFTMatricula');
////CONTRASEÑA DE CONEXION A BASE DE DATOS
//define('MYSQL_PASS', 'cell');
//define('MYSQL_PASS_INVESTMENT', 'cellFundatec');
//define('MSSQL_PASS', 'userFUNDA87');
//define('MSSQL_PASS_CONTROL_USER', 'userFUNDA87');
////NOMBRE DE LA BASE DE DATOS
//define('MYSQL_DATABASE', 'ft_actas');
//define('MYSQL_DATABASE_INVESTMENT', 'db_investment');
//define('MSSQL_DATABASE', 'ft_control_users');
//define('MSSQL_DATABASE_CONTROL_USER', 'ft_control_users');
//
//
//
//DIRECTORIO DONDE SE ENCUENTRAN LOS MÓDULOS DEL SISTEMA
define('DIR_MODULOS', 'module');
// SLASH WINDOWS
define('SD', '/');
//SERVIDOR DE BASE DE DATOS
define('MYSQL_SERVER', 'proyectouned.c7skqyi8esw9.us-east-2.rds.amazonaws.com:3306');//190.0.226.98 actas
define('MYSQL_SERVER_INVESTMENT', '172.20.26.98');
define('MSSQL_SERVER', '172.20.16.60');// SQL Server
define('MSSQL_SERVER_CONTROLUSER', '172.20.26.98');// SQL Server
//define('MSSQL_SERVER_MATRIFUNDB', '40.90.244.6');// SQL Server Producción
define('MSSQL_SERVER_MATRIFUNDB', '172.20.26.98');// SQL Server Pruebas
//USUARIO DE CONEXION A BASE DE DATOS
define('MYSQL_USER', 'uned');//ftactas
define('MYSQL_USER_INVESTMENT', 'root');//ftactas
define('MSSQL_USER', 'cfusionft1');
//define('MSSQL_USER_MATRIFUNDB', 'jobregon');//Producción
define('MSSQL_USER_MATRIFUNDB', 'cbenavides');// Pruebas
define('MSSQL_USER_CONTROL_USER', 'cbenavides');
//CONTRASEÑA DE CONEXION A BASE DE DATOS
define('MYSQL_PASS', 'uned123.');
define('MYSQL_PASS_INVESTMENT', 'cell');
define('MSSQL_PASS', 'cfusionft');
define('MSSQL_PASS_CONTROL_USER', 'carolina08');
//define('MSSQL_PASS_MATRIFUNDB', 'jon198812');//Producción
define('MSSQL_PASS_MATRIFUNDB', 'carolina08');//Pruebas

//NOMBRE DE LA BASE DE DATOS
define('MYSQL_DATABASE', 'gestionactivos');
define('MYSQL_DATABASE_INVESTMENT', 'db_investment');
define('MSSQL_DATABASE', 'minisif_ft');
define('MSSQL_DATABASE_MATRIFUNDB', 'matrifunDB');
define('MSSQL_DATABASE_CONTROL_USER', 'ft_control_users');

//************************************************************************//
//************************************************************************//
//DEFINIR EL NOMBRE DE LOS MODULOS DEL SISTEMA
define("MODULO_LOGIN", "login");
define("MODULO_INICIAL", "index");
define("MODULO_CLOSE", "sesion");
define("MODULO_BUSCAR", "buscar");
define("MODULO_SESIONES", "sesiones");
define("MODULO_PERSONAS", "persona");
define("MODULO_ARCHIVOS", "archivos");
define("MODULO_ACUERDO", "acuerdo");
define("MODULO_AGENDA", "agenda");
define("MODULO_JUNTADIRECTIVA", "juntaDirectiva");
define("MODULO_PDF", "sesionPDF");

define("MODULO_CERTIFICATE", "certificate");
define("MODULO_CERTIFICATE_VIEWINV", "certificateViewInv");
define("MODULO_COMPANY", "company");
define("MODULO_FINANCIAL_ENTITY", "financialEntity");
define("MODULO_INVESTMENT", "investment");
define("MODULO_HOME", "home");
define("MODULO_CERTIFICATE_TYPE", "certificateType");
define("MODULO_EXCHANGE_RATE", "exchangeRate");

define("MODULO_POINTOFSALE", "index");
define("MODULO_CONTRACT", "contract/index");
define("MODULO_ASSETS", "assets/index");
/**************************************************************************/
//DROPBOX ACTAS
define('TOKEN_DROPBOX', 'CkHZJYe9QBgAAAAAAADN5Z57aLeoqCdfavphLksKEGnySPy3NDvmIEfpTmt4f8i-');
define('APP_NAME_DROPBOX', 'documentacionFundatec1.0');
define('DOCS_PATH_ACTAS', '/Documentación_Sistemas_FUNDATEC/Sistema_Actas/Actas/');

//DROPBOX INVERSIONES
define('TOKEN_DROPBOXINVESMENT', 'BtHvFlQfYVAAAAAAAAAAD1Vv3rSgkDbOLognF03s-aq6GD4jv7bRMU5MtM-lixJ2');
define('APP_NAME_DROPBOXINVESMENT', 'JorgeArtApp');
define('DOCS_PATH_INVESTMENT_CERTIFICATES', '/Documentación_Sistemas_FUNDATEC/Sistema_Inversiones/Certificados/');

/**************************************************************************/

define('ROLE_CASHIER_POINT_OF_SALE', 'ROLE_CASHIER_POINT_OF_SALE');
define('APLICATION_ID_POINT_OF_SALE', 'F92FEBA5-7744-4F80-A34B-7EB2F31E29A5');

/*************************************************************************/
/*************************FACTURA ELECTRONICA*****************************/
define('WSCARGAFACTURA_IDDEMPRESA', 3074);
define('WSCARGAFACTURA_CLAVEUSUARIO', 'PaSs@123');
define('WSCARGAFACTURA_CORREOUSUARIO', '3006087315');
define('SALECONDITIONCREDITO', '02');
define('IDCOMPANYFUNDATEC', 1);
//************************************************************************//
define("FOLDER_ADJUNTOS_SESION", "adjuntosSesion/");
//************************************************************************//
//clase para control de sesion
require_once 'sesion/Sesion.php';
require_once 'server/Message.php';
//clase para control de variables post, get y request
require_once 'server/Request.php';
require_once 'server/Server.php';
require_once 'utilities/Date.php';
//clase view
require_once 'view/View.php';
//clase controler que heredan los controladores
require_once 'controller/Controller.php';
//clase conexion a Mysql
require_once 'database/Mysql.php';
require_once 'database/SQLServer.php';
//archivo con funciones globales del sistema
require_once 'utils.php';

//clase para conocer el rol del usuario en sesion
require_once 'utilities/Rol.php';
//clase para sftp
require_once 'utilities/SFTPConnection.php';

//DROPBOX
require_once 'Content/Dropbox_Api/app/start.php';
require_once 'utilities/dropboxUtil.php';