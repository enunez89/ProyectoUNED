<?php

//codificar todas las impresiones desde PHP como UTF-8
header('Content-Type: text/html; charset=UTF-8');

//mostrar los errores en el código fuente PHP
ini_set("display_errors", 1);
error_reporting(-1);

date_default_timezone_set("America/Costa_Rica");

//************************************************************************//
//************************************************************************//
//DIRECTORIO DONDE SE ENCUENTRAN LOS MÓDULOS DEL SISTEMA
define('DIR_MODULOS', 'module');
// SLASH WINDOWS
define('SD', '/');
//SERVIDOR DE BASE DE DATOS
define('MYSQL_SERVER', '190.0.226.98');//190.0.226.98 actas
define('MYSQL_SERVER_INVESTMENT', '190.0.226.98');
define('MSSQL_SERVER', '190.0.226.98');// SQL Server
define('MSSQL_SERVER_CONTROLUSER', '190.0.226.98');// SQL Server
//USUARIO DE CONEXION A BASE DE DATOS
define('MYSQL_USER', 'ftactas');//ftactas
define('MYSQL_USER_INVESTMENT', 'tinyerp');//ftactas
define('MSSQL_USER', 'usrFTMatricula');
define('MSSQL_USER_CONTROL_USER', 'usrFTMatricula');
//CONTRASEÑA DE CONEXION A BASE DE DATOS
define('MYSQL_PASS', 'cell');
define('MYSQL_PASS_INVESTMENT', 'cellFundatec');
define('MSSQL_PASS', 'userFUNDA87');
define('MSSQL_PASS_CONTROL_USER', 'userFUNDA87');
//NOMBRE DE LA BASE DE DATOS
define('MYSQL_DATABASE', 'ft_actas');
define('MYSQL_DATABASE_INVESTMENT', 'db_investment');
define('MSSQL_DATABASE', 'ft_control_users');
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
/**************************************************************************/
//DROPBOX ACTAS
define('TOKEN_DROPBOX', 'CkHZJYe9QBgAAAAAAADN5Z57aLeoqCdfavphLksKEGnySPy3NDvmIEfpTmt4f8i-');
define('APP_NAME_DROPBOX', 'documentacionFundatec1.0');
define('DOCS_PATH_ACTAS', '/Documentación_Sistemas_FUNDATEC/Sistema_Actas/Actas/');

//DROPBOX INVERSIONES
define('TOKEN_DROPBOXINVESMENT', 'BtHvFlQfYVAAAAAAAAAAD1Vv3rSgkDbOLognF03s-aq6GD4jv7bRMU5MtM-lixJ2');
define('APP_NAME_DROPBOXINVESMENT', 'JorgeArtApp');
define('DOCS_PATH_INVESTMENT_CERTIFICATES', '/Documentación_Sistemas_FUNDATEC/Sistema_Inversiones/Certificados/');




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