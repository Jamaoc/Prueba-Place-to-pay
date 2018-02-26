<?php

/**
 *
 * Clase para crear la conexion a la bd, formato singleton
 *  
 */ 

Class cls_sqlsvr{

   public $link; 
   static $_instance;

   /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
   private function __construct(){
      $this->conectar();
   }

   /*Evitamos el clonaje del objeto. Patrón Singleton*/
   private function __clone(){ }

   /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/
   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
      return self::$_instance;      
   }

   /*Realiza la conexión a la base de datos.*/
   private function conectar(){
      $connectionInfo = array( "Database"=>"Prb_PSE", "UID"=>"sa", "PWD"=>"Jamaoc87");
      $this->link= sqlsrv_connect("localhost", $connectionInfo);   
         
		 //if(($errors = sqlsrv_errors())!= null) 
            //throw new Exception('Error en Bd');     
   }
}
?>