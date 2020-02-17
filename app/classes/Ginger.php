<?php

class Ginger{
//propiedades del framework
    private $framework = 'Ginger Framework';
    private $version = '1.0.0';
    private $uri = [];

//La funcion principal que se ejecuta al instanciar nuestra clase
    function __construct(){
        $this->init();
    }

/**
 * Metodo inicial que ejecuta cada metodo de forma subsecuente 
 * @return void 
 */

    private function init(){
        //Todos los metodos a ejecutar consecutivamente
        $this->init_session();
        $this->init_load_config();
        $this->init_load_functions();
        $this->init_autoload();
        $this->init_csrf();
        $this->dispatch();
    }
/**
 * Metodo para iniciar la sesión en el sistema
 * @return void 
 */

    private function init_session(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        return;
    }
/**
 * Metodo para cargar la configuracion del sistema
 * @return void
 */
    private function init_load_config(){
        $file = 'ginger_config.php';
        
        if(!is_file('app/config/'.$file)){
            die(sprintf('🙀 No se encontro el archivo %s el cual es necesario para que %s funcione 😿',$file,$this->framework) );
        }
        //Carga del archivo de configuracion  
        require_once 'app/config/'.$file;
        return; 
    }
/**
 * Metodo para cargar las funciones Core de Ginger FW Y del proyecto en curso
 * @return void
 */

    private function init_load_functions(){
        $file  = 'ginger_core_functions.php';
        
        if(!is_file(FUNCTIONS.$file)){
            die(sprintf('🙀 No se encontro el archivo %s el cual es necesario para que %s funcione 😿',$file,$this->framework) );
        }
        //Carga del archivo de funciones core 
        require_once FUNCTIONS.$file;
        
        
        $file  = 'ginger_custom_functions.php';
        
        if(!is_file(FUNCTIONS.$file)){
            die(sprintf('🙀 No se encontro el archivo %s el cual es necesario para que %s funcione 😿',$file,$this->framework) );
        }
        //Carga del archivo de funciones core 
        require_once FUNCTIONS.$file;
        return; 
    }
/**
 * Metodo para cargar todos los archivos de forma automatica
 * @return void
 */

    private function init_autoload(){
        require_once CLASSES.'Autoloader.php';
        Autoloader::init();
        // require_once CLASSES.'Db.php';
        // require_once CLASSES.'Model.php';
        // require_once CLASSES.'View.php';
        // require_once CLASSES.'Controller.php';
        return; 
    }


/**
 * Método para crear un nuevo token de la sesión del usuario
 *
 * @return void
 */
    private function init_csrf() {
        $csrf = new Csrf();
    }


/**
 * Metodo para filtrar y descomponer los elementos de la url y uri
 * @return void
 */
    private function filter_url(){
        if(isset($_GET['uri'])){
            $this->uri = $_GET['uri'];
            $this->uri = rtrim($this->uri,'/');
            $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
            $this->uri = explode('/',strtolower($this->uri)); 
            return $this->uri;
        }
    }
/**
 * Metodo para ejecutar y cargar en automatico el controlador solicitado
 * y pasar parametros a su metodo
 * @return void
 */
    private function dispatch(){
        
        //filtrar la URL y separar la URI
        $this->filter_url();
        
        //////////////////////////////////////>>>CONTROLADORES<<<<<///////////////////////
        //Saber si se esta pasando en la url el nombre de un controlador
        
        if(isset($this->uri[0])){
            $current_controller =  str_replace('-', '_', $this->uri[0]); // users Controller.php
            unset($this->uri[0]);
        }else{
            $current_controller = DEFAULT_CONTROLLER;
        }
        
        // print_r($this->uri );
        // echo $current_controller;
        //Ejecución del controlador
        //Verificamos si existe una clase con el nombre controlador solicitado

        $controller = $current_controller.'Controller';
        
        //Validar si existe el controlador
        if(!class_exists($controller)){
            $controller = DEFAULT_ERROR_CONTROLLER.'Controller';
            $current_controller = DEFAULT_ERROR_CONTROLLER;
        }
        
        //////////////////////////////////////>>>METODOS<<<<<///////////////////////
        //Ejecución del metodo solicitado
        if(isset($this->uri[1])){
            $method = str_replace('-','_', $this->uri[1]);
            //Validar si existe el metodo dentro de la clase a ejecutar (Controlador)
            if(!method_exists($controller,$method)){
                $controller = DEFAULT_ERROR_CONTROLLER.'Controller';
                $current_method = DEFAULT_METHOD;
                $current_controller = DEFAULT_ERROR_CONTROLLER;
            }else{
                $current_method = $method ;
            }
            
            unset($this->uri[1]);
        }else{
            $current_method = DEFAULT_METHOD;
        }
        
        //////////////////////////////////////////////////////
        //Creando constantes para usarlas en el fw
        define(CONTROLLER,$current_controller);
        define(METHOD,$current_method);
        //////////////////////////////////////////////////////
        //Ejecutando controlador y metodo segun se haga la peticion
        $controller = new $controller; 

        //Obteniendo los parametros
        $parameters = array_values(empty($this->uri) ? [] : $this->uri);

        //Llamada del metodo solicitado 
        if(empty($parameters)){
             call_user_func([$controller, $current_method]);
        }else{
             call_user_func_array([$controller, $current_method], $parameters);
        }
        
        return;
        
    }//fin dispatch
/**
 * Ejecutar el framework;
 */
    public static function fly(){
        $ginger = new self();
        return;
    }
}