<?php
/**
 */

//referencias
require_once(APPPATH.'controllers/mensaje.php'); 
require_once(APPPATH.'models/Logica/cls_ws_pse.php'); 
require_once(APPPATH.'models/Logica/PSEPerson.php'); 


class Verificacion_registro extends CI_Controller{
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
  function pagina_verificacion()
    {
     try{
        $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
        $datos_pagina['select_lstbank_PagBas']= $this->input->post('select_lstbank_PagBas');
        
        $pagina_html =$this->load->view('pagina_verificacion',$datos_pagina,true);
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
  function validar_person()
  {
    try{
        $p_emailAddress=$this->input->post('text_Email_VerReg');
        $datos=Cls_PSEPerson::consultar($p_emailAddress);
        IF ($datos['nResultado']==0)
        {
              IF ($datos['nCount']==0)
              {
                $datos_pagina_mensaje=mensaje::asignar_mensaje('Aviso','El email no se encuentra Registrado, Debe diligenciar un registro');
                $pagina_html =$this->load->view('Mensaje',$datos_pagina_mensaje,true);                  
                $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
                $datos_pagina['select_lstbank_PagBas']= $this->input->post('select_lstbank_PagBas');
                $datos_pagina['text_email_PagVrf']=$p_emailAddress;
                $pagina_html1 =$this->load->view('pagina_verificacion',$datos_pagina,true);
                $pagina = array(
                            'indicador' => '#mensaje_principal',
                            'html' =>$pagina_html,
                            'indicador1' => '#body_principal',
                            'html1' =>$pagina_html1
                            );
                echo json_encode($pagina, JSON_FORCE_OBJECT);                  
              }else if($datos['nCount']==1){
                
                $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
                $datos_pagina['select_lstbank_PagBas']= $this->input->post('select_lstbank_PagBas');
                
                $datos_pagina['select_tipId_PagVrf']=$datos['consulta'][0]['documentType'];
                $datos_pagina['text_NumId_PagVrf']=$datos['consulta'][0]['document'];
                $datos_pagina['text_nombres_PagVrf']=$datos['consulta'][0]['firstName'];
                $datos_pagina['text_apellidos_PagVrf']=$datos['consulta'][0]['lastName'];
                $datos_pagina['text_email_PagVrf']=$datos['consulta'][0]['emailAddress'];
                $datos_pagina['text_direccion_PagVrf']=$datos['consulta'][0]['address'];
                $datos_pagina['text_celular_PagVrf']=$datos['consulta'][0]['mobile'];
                
                
                
                
                $pagina_html =$this->load->view('pagina_verificacion',$datos_pagina,true);
                $pagina = array(
                            'indicador' => '#body_principal',
                            'html' =>$pagina_html                            
                            );              
                echo json_encode($pagina, JSON_FORCE_OBJECT);  
              }else{
                throw new Exception("Error en la Validadion del Email");
              }

        }else{
          throw new Exception("Error en la Validadion del Email");
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