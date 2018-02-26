<?php
/**
 * Controller_view EkaCorp Class
 *
 * Clase que controla el flujo de llamado de ventanas
 *
 * @package    EkaCorp
 * @subpackage Contenedor
 * @category   Controlador
 * @author     T.I. Team
 * @link    
 */

//Cargar clases 
//require_once(APPPATH.'controllers/mensaje.php'); 
class Controller_view extends CI_Controller{

   function page_view(){
   		$user_page  =  $this->input->post('page');
   		$datos_pagina['rowid_person'] =$this->input->post('rowid_person');
        $this->load->view($user_page,$datos_pagina);         
   } 
}
?>