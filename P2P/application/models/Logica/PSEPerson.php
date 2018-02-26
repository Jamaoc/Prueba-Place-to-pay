<?php
/**
 *
 * 
 */
require_once(APPPATH.'models/Data/cls_procedure.php'); 
class Cls_PSEPerson{
/**/

/*Metodos*/

/**
	 
**/

public static function consultar($p_emailAddress){
   	try{
   		$nResultado=null;
	    $nCount=null;	   
	    $Mensaje='';   		
	    $params = array(   
	    	      array($p_emailAddress, SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(80)),  
	              array($nResultado, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              array($nCount, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              array($Mensaje, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_NVARCHAR(3000))
	    ); 
	    $query = "{call sp_consulta_PSEPerson(?, ?, ?, ?)}";
	    $consulta=cls_procedure::ejecutar_procedure($query,$params);
	    return $datos=array('consulta'=>$consulta,'nResultado'=>$nResultado,'nCount'=>$nCount,'Mensaje'=>$Mensaje);				
   	}catch (Excepción $e) {
		throw $e;   	
	}
}

public static function insertar($p_document,$p_documentType,$p_firstName,$p_lastName,$p_emailAddress,$p_address,$p_mobile,$p_company='',$p_city='',$p_province='',$p_country='',$p_phone=''){
   	try{
   		$nResultado=null;
	    $nCount=null;	   
	    $Mensaje='';   		
	    $params = array(
	    			array($p_document, SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(12)),  
	    			array($p_documentType,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(3)),  
	    			array($p_firstName,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(60)),  
	    			array($p_lastName, SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(60)),
	    			array($p_company,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(60)),  
	    			array($p_emailAddress,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(80)),  
	    			array($p_address,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(100)),  
	    			array($p_city,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(50)), 
	    			array($p_province,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(50)), 
	    			array($p_country,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(2)),  
	    			array($p_phone,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(30)),     
	    	    	array($p_mobile,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(30)),  
	    			array($nResultado, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              	array($nCount, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              	array($Mensaje, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_NVARCHAR(3000))
	    ); 
	    $query = "{call sp_insercion_PSEPerson(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)}";
	    $consulta=cls_procedure::ejecutar_procedure($query,$params);
	    return $datos=array('consulta'=>$consulta,'nResultado'=>$nResultado,'nCount'=>$nCount,'Mensaje'=>$Mensaje);				
   	}catch (Excepción $e) {
		throw $e;   	
	}
}
}
?>



