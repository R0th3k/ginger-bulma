<?php 

class Alert{
    private $valid_types = ['primary','secondary','success','warning','danger','info','light','dark'];
    private $default = 'primary';
    private $type;
    private $msg;

    /**
     * Metodo para guaradar una notificacion
     * @param string array $msg
     * @param string $type
     * @return void
     */

    public static function new($msg,$type=null){
        $self = new self();

        //setear el tipo de notificacion por defecto;
        if ($type == null){
            $self->type = $self->default;
        }

        $self->type = in_array($type, $self->valid_types) ? $type : $self->default;
        

        //Guardar las notificaciones en un array de sesion

        if (is_array($msg)){
            foreach($msg as $m){
                $_SESSION[$self->type][] = $m;
            }
            return true;
            
        }
        $_SESSION[$self->type][] = $msg;
        return true;
    }

    /**
     * Renderiza las notificaciones
     * @return void 
     */
    public static function show(){
        $self = new self(); 
        $output = '';

        foreach($self->valid_types as $type){
            if(isset($_SESSION[$type]) && !empty($_SESSION[$type])){
                foreach ($_SESSION[$type] as $m){
                    $output .= '<div class="alert alert-dismissible show fade alert-'.$type.'" role="alert">';
                    $output .= $m; 
                    $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'; 
                    $output .= '</div>'; 
                }
            }
            unset($_SESSION[$type]);
        } 
        return $output;
    } 
}