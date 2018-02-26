<?php
/**
 *
 * 
 */
require_once(APPPATH.'models/Data/cls_procedure.php'); 
class Cls_PSETransactionInformation{
/**/

/*Metodos*/

/**
	 
**/


public static function insertar($rowid_person,$transactionID,$sessionID,$returnCode,$trazabilityCode,$transactionCycle,$bankCurrency,$bankFactor,$bankURL,$responseCode,$responseReasonCode,$responseReasonText){
   	try{
   		$nResultado=null;
	    $nCount=null;	   
	    $Mensaje='';   		
	    $params = array(
	    			array($rowid_person,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_INT),
	    			array($transactionID,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_INT),
	    			array($sessionID,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(32)), 
	    			array($returnCode,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(30)), 
	    			array($trazabilityCode,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(40)), 
	    			array($transactionCycle,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_INT),
	    			array($bankCurrency,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(3)), 
	    			array($bankFactor,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_FLOAT), 
	    			array($bankURL,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(255)),
	    			array($responseCode,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_INT),
	    			array($responseReasonCode,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(3)),
	    			array($responseReasonText,SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(255)),
	    			array($nResultado,SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              	array($nCount,SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              	array($Mensaje,SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_NVARCHAR(3000))
	    ); 
	    $query = "{call sp_insercion_PSETransactionInformation(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)}";
	    $consulta=cls_procedure::ejecutar_procedure($query,$params);
	    return $datos=array('consulta'=>$consulta,'nResultado'=>$nResultado,'nCount'=>$nCount,'Mensaje'=>$Mensaje);				
   	}catch (Excepción $e) {
		throw $e;   	
	}
}
//-----------------------------------------------
public static function consultar($p_rowid_person){
   	try{
   		$nResultado=null;
	    $nCount=null;	   
	    $Mensaje='';   		
	    $params = array(   
	    	      array($p_rowid_person, SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_INT),  
	              array($nResultado, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              array($nCount, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              array($Mensaje, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_NVARCHAR(3000))
	    ); 
	    $query = "{call sp_consulta_PSETransactionInformation(?, ?, ?, ?)}";
	    $consulta=cls_procedure::ejecutar_procedure($query,$params);
	    return $datos=array('consulta'=>$consulta,'nResultado'=>$nResultado,'nCount'=>$nCount,'Mensaje'=>$Mensaje);				
   	}catch (Excepción $e) {
		throw $e;   	
	}
}
//-----------------------------------------------
public static function actualizar($p_rowid_person,$p_transactionID,$p_transactionState){
   	try{
   		$nResultado=null;
	    $nCount=null;	   
	    $Mensaje='';   		
	    $params = array(   
	    	      array($p_rowid_person, SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_INT), 
	    	      array($p_transactionID, SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_INT),   
	    	      array($p_transactionState, SQLSRV_PARAM_IN,null,SQLSRV_SQLTYPE_NVARCHAR(20)),
	              array($nResultado, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              array($nCount, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_INT),
	              array($Mensaje, SQLSRV_PARAM_OUT,null,SQLSRV_SQLTYPE_NVARCHAR(3000))
	    ); 
	    $query = "{call sp_update_PSETransactionInformation(?, ?, ?, ?, ?, ?)}";
	    $consulta=cls_procedure::ejecutar_procedure($query,$params);
	    return $datos=array('consulta'=>$consulta,'nResultado'=>$nResultado,'nCount'=>$nCount,'Mensaje'=>$Mensaje);				
   	}catch (Excepción $e) {
		throw $e;   	
	}
}
}
?>



