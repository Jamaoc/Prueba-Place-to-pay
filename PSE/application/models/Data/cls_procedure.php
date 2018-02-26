<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * Clase para ejecutar un procedimiento almacenado
 * 
 */ 
require_once(APPPATH.'models/Data/cls_sqlsvr.php'); 
class Cls_procedure{

static $Arreglo_CID1;


public static function ejecutar_procedure($query,$params)
{
    if ($query === '')
    {
      throw new Exception('Error Query invalido');      
    } 
    $bd=cls_sqlsvr::getInstance();
 
    $stmt=sqlsrv_query($bd->link,$query,$params); 
    if($stmt===false)
        if(($errors = sqlsrv_errors())!= null) 
           throw new Exception($errors['message']);
     
    $datos[]=array();
    while($row=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
           array_push($datos,$row);
    }
    array_shift($datos);
    /*if(count($datos)==0)
        throw new Exception('Aviso$@$El tercero no se encuentra registrado222'); */
    return $datos;    
}

/**
 * capturar campo consulta
 * @param $indice int para columnas
 * @param $campo campo de la bd
 * @return params out|select info
 */
public static function selCampo($indice,$campo){
    $campo=strtolower($campo);
    $valor=self::$Arreglo_CID1[$indice][$campo]; 
    if(!isset($valor))
        throw new Exception('Error al consultar el campo solicitado');        
    return $valor;    
}
}

