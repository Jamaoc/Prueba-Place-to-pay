<?php
/**
 * Contenedor EkaCorp Class
 *
 * 
 * @package    EkaCorp
 * @subpackage Controlador Notificador Mensaje
 * @category   General
 * @author     T.I. Team
 * @link    
 */
class Mensaje{
	public static function asignar_mensaje($tipo_mensaje,$mensaje){
   	 	$datos['tipo_mensaje']='¡'.$tipo_mensaje.'!';
   	 	$datos['mensaje']=$mensaje;
   	 	switch ($tipo_mensaje) 
   	 	{
 			case "Alerta":
        		$datos['css']='alert alert-warning alert-dismissable';
           	break;
    	   	case "Error":
        		$datos['css']='alert alert-danger alert-dismissable';
        	break;
        	case "Aviso":
        		$datos['css']='alert alert-info alert-dismissable';
        	break;
        	case "Correcto":
        		$datos['css']='alert alert-success alert-dismissable';
        	break;
        	default:
       			$datos['css']='';
       		break;
    	} 
    return $datos;
	}   		
   	      
}
?>