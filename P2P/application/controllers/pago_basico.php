<?php
/**
 */

require_once(APPPATH.'controllers/mensaje.php'); 
require_once(APPPATH.'models/Logica/cls_ws_pse.php'); 


class Pago_basico extends CI_Controller{
/*
==================
Metodos sin Evento
==================
*/

/*
==================
Metodos con Evento
==================
*/
  function select_lstbank()
    {
      try{
        
        $ws=cls_ws_pse::getBankList();
        $datos_pagina['lstbank']=$ws;
        $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
        $datos_pagina['rowid_person']= $this->input->post('text_rowid_person_PagBas');
        
        $pagina_html =$this->load->view('Pago_basico',$datos_pagina,true);
        $pagina = array(
                    'indicador' => '#body_principal',
                    'html' =>$pagina_html
                    );
        echo json_encode($pagina, JSON_FORCE_OBJECT);                  
      }catch(Exception $e){  
        $mensaje=$e->getMessage();
        $tipo_mensaje=explode('$@$',$mensaje);
        switch ($tipo_mensaje[0]) 
        {
          case "Alerta":
          case "Error":
          case "Aviso":                 
          case "Correcto":
            $datos_pagina=mensaje::asignar_mensaje($tipo_mensaje[0],$tipo_mensaje[1]);
            $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
            $pagina = array(
                    'indicador' => '#mensaje_principal',
                    'html' =>$pagina_html);
            echo json_encode($pagina, JSON_FORCE_OBJECT);              
          break;
          default:
            $datos_pagina=mensaje::asignar_mensaje('Error',$tipo_mensaje[0]);
            $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
            $pagina = array(
                  'indicador' => '#mensaje_principal',
                  'html' =>$pagina_html);
            echo json_encode($pagina, JSON_FORCE_OBJECT);              
          break;
        } 
      } 
    }
  /*-------------------------------------------*/  
  function verificacion_registro()
    {
     try{
        $validacion=true;
        $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
        $datos_pagina['select_lstbank_PagBas']= $this->input->post('select_lstbank_PagBas');
        $datos_pagina['rowid_person']= $this->input->post('text_rowid_person_PagBas');
        
        if($this->input->post('select_tipCuenta_PagBas')==2)
        {
          $datos_pagina['span_tipCuenta_PagBas']='Tipo de Cuenta es Obligatorio';
          $validacion=false;
        }else if($this->input->post('select_lstbank_PagBas')==0){
          $ws=cls_ws_pse::getBankList();
          $datos_pagina['lstbank']=$ws;
          $datos_pagina['span_lstbank_PagBas']='Entidad Financiera es Obligatorio';
          $validacion=false;
        }
          
        
        if($validacion==true)
        {
          $pagina_html =$this->load->view('verificacion_registro',$datos_pagina,true);
          $pagina = array(
                    'indicador' => '#body_principal',
                    'html' =>$pagina_html
                    );
          echo json_encode($pagina, JSON_FORCE_OBJECT);                            
        }else if($validacion==false) 
        {
          $pagina_html =$this->load->view('Pago_basico',$datos_pagina,true);
          $pagina = array(
                    'indicador' => '#body_principal',
                    'html' =>$pagina_html
                    );
          echo json_encode($pagina, JSON_FORCE_OBJECT);                            
        }
      }catch(Exception $e){  
        $mensaje=$e->getMessage();
        $tipo_mensaje=explode('$@$',$mensaje);
        switch ($tipo_mensaje[0]) 
        {
          case "Alerta":
          case "Error":
          case "Aviso":                 
          case "Correcto":
            $datos_pagina=mensaje::asignar_mensaje($tipo_mensaje[0],$tipo_mensaje[1]);
            $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
            $pagina = array(
                    'indicador' => '#mensaje_principal',
                    'html' =>$pagina_html);
            echo json_encode($pagina, JSON_FORCE_OBJECT);              
          break;
          default:
            $datos_pagina=mensaje::asignar_mensaje('Error',$tipo_mensaje[0]);
            $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
            $pagina = array(
                  'indicador' => '#mensaje_principal',
                  'html' =>$pagina_html);
            echo json_encode($pagina, JSON_FORCE_OBJECT);              
          break;
        } 
      }
    }
  function pagina_verificacion()
    {
     try{
        $validacion=true;
        $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
        $datos_pagina['select_lstbank_PagBas']= $this->input->post('select_lstbank_PagBas');
        
        if($this->input->post('select_tipCuenta_PagBas')==2)
        {
          $datos_pagina['span_tipCuenta_PagBas']='Tipo de Cuenta es Obligatorio';
          $validacion=false;
        }else if($this->input->post('select_lstbank_PagBas')==0){
          $ws=cls_ws_pse::getBankList();
          $datos_pagina['lstbank']=$ws;
          $datos_pagina['span_lstbank_PagBas']='Entidad Financiera es Obligatorio';
          $validacion=false;
        }
          
        
        if($validacion==true)
        {
          $pagina_html =$this->load->view('pagina_verificacion',$datos_pagina,true);
          $pagina = array(
                    'indicador' => '#body_principal',
                    'html' =>$pagina_html
                    );
          echo json_encode($pagina, JSON_FORCE_OBJECT);                            
        }else if($validacion==false) 
        {
          $pagina_html =$this->load->view('Pago_basico',$datos_pagina,true);
          $pagina = array(
                    'indicador' => '#body_principal',
                    'html' =>$pagina_html
                    );
          echo json_encode($pagina, JSON_FORCE_OBJECT);                            
        }
      }catch(Exception $e){  
        $mensaje=$e->getMessage();
        $tipo_mensaje=explode('$@$',$mensaje);
        switch ($tipo_mensaje[0]) 
        {
          case "Alerta":
          case "Error":
          case "Aviso":                 
          case "Correcto":
            $datos_pagina=mensaje::asignar_mensaje($tipo_mensaje[0],$tipo_mensaje[1]);
            $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
            $pagina = array(
                    'indicador' => '#mensaje_principal',
                    'html' =>$pagina_html);
            echo json_encode($pagina, JSON_FORCE_OBJECT);              
          break;
          default:
            $datos_pagina=mensaje::asignar_mensaje('Error',$tipo_mensaje[0]);
            $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
            $pagina = array(
                  'indicador' => '#mensaje_principal',
                  'html' =>$pagina_html);
            echo json_encode($pagina, JSON_FORCE_OBJECT);              
          break;
        } 
      } 
    }  
}
?>