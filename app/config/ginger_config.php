<?php 
    $pathLocal = '/ginger2/';
    $urlLocal ='http://localhost:';
    $pathRemote = '/ginger';
    $urlRemote = 'https://hektor.mx/ginger/';


require_once 'site_var.php';

//Verificar si estamos trabajando de forma local o remota
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1','::1']));

//Definir el uso de horario 
date_default_timezone_set('America/Mexico_city');

//Lenguaje
define('LANG', 'es');

//Ruta base del proyecto
define('BASEPATH',IS_LOCAL ? $pathLocal : $pathRemote);

//sal del sistema
define('AUTH_SALT','GingerXD');

//Puerto
define('PORT','8888');

//Url
define('URL', IS_LOCAL ? $urlLocal.PORT.BASEPATH : $urlRemote);

//Ruta de directorios y archivos
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', getcwd().DS);

define('APP',ROOT.'app'.DS);
define('CLASSES',APP.'classes'.DS);
define('CONFIG',APP.'config'.DS);
define('CONTROLLERS',APP.'controllers'.DS);
define('FUNCTIONS',APP.'functions'.DS);
define('MODELS',APP.'models'.DS);

define('TEMPLATES',ROOT.'templates'.DS);
define('INCLUDES',TEMPLATES.'includes'.DS);
define('MODULES',TEMPLATES.'modules'.DS);
define('VIEWS',TEMPLATES.'views'.DS);

define('ASSETS',URL.'assets/');
define('CSS',ASSETS.'css/');
define('JS',ASSETS.'js/');
define('IMG',ASSETS.'images/');
define('FONTS',ASSETS.'fonts/');
define('PLUGINS',ASSETS.'plugins/');
define('UPLOADS',ASSETS.'uploads/');

//Credenciales de la DB
//Set para conexion local o dev
define('LDB_ENGINE','mysql');
define('LDB_HOST','localhost');
define('LDB_NAME','ginger');
define('LDB_USER','root');
define('LDB_PASS','root');
define('LDB_CHARSET','utf8');

//Set para conexion produccion
define('DB_ENGINE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','');
define('DB_USER','');
define('DB_PASS','');
define('DB_CHARSET','utf8');

//El controlador por defecto / Metodo por defecto / Controlador de errores por defecto
define('DEFAULT_CONTROLLER','home');
define('DEFAULT_ERROR_CONTROLLER','error');
define('DEFAULT_METHOD','index');


ini_set('memory_limit', '512M');
error_reporting(E_ALL & ~E_NOTICE);