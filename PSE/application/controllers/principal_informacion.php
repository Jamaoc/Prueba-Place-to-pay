<?php
/**
 * Contenedor Principal Class
 *
 * 
 * @package    Prueba PSE
 * @subpackage Contenedor
 * @category   Controlador
 * @author     Mauricio Ortiz
 * @link    
 */
class Principal_informacion extends CI_Controller{

   function index(){
   	  if (isset($_GET['code']) and !empty($_GET['code']))  	
   	  {
      	$datos_pagina['rowid_person']=$_GET['code'];
      	$this->load->view('principal',$datos_pagina);    
      }
   }      
}
?>