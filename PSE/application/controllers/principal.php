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
class Principal extends CI_Controller{

   function index(){
      $this->load->view('principal');                               
   }      
}
?>