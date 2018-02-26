<?php
/**
 */

//referencias
require_once(APPPATH.'controllers/mensaje.php'); 
require_once(APPPATH.'models/Logica/cls_ws_pse.php'); 
require_once(APPPATH.'models/Logica/PSEPerson.php'); 
require_once(APPPATH.'models/Logica/PSETransactionInformation.php'); 


class Estado_transaccion extends CI_Controller{
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
  function consultar_transaccion()
    {
      try{
        $p_rowid_person=$this->input->post('text_rowid_person_PagBas');
        if (isset($p_rowid_person) and !empty($p_rowid_person))  
        {
            $datos=Cls_PSETransactionInformation::consultar($p_rowid_person);
            IF ($datos['nResultado']==0)
            {
              IF ($datos['nCount']==1)
              {
                  $transactionID=$datos['consulta'][0]['transactionID'];
                  $ws=cls_ws_pse::getTransactionInformation($transactionID);
                  switch ($ws->transactionState) {
                      case 'OK':
                          $datos=Cls_PSETransactionInformation::actualizar($p_rowid_person,$transactionID,$ws->transactionState);
                          IF ($datos['nResultado']==0)
                          {
                              IF ($datos['nCount']==1)
                              {
                                $datos_pagina=mensaje::asignar_mensaje('Correcto','Transaccion '.$ws->transactionID.' '.$ws->responseReasonText);                          
                                $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
                                $pagina = array(
                                        'indicador' => '#mensaje_principal',
                                        'html' =>$pagina_html);
                                echo json_encode($pagina, JSON_FORCE_OBJECT);
                              }else{
                                  throw new Exception("Error en la Actualizacion");
                              }    
                          }else{
                              throw new Exception("Error en la Actualizacion");
                          }   
                          break;
                      case 'NOT_AUTHORIZED':
                          $datos=Cls_PSETransactionInformation::actualizar($p_rowid_person,$transactionID,$ws->transactionState);
                          IF ($datos['nResultado']==0)
                          {
                              IF ($datos['nCount']==1)
                              {
                                $datos_pagina=mensaje::asignar_mensaje('Alerta','Transaccion '.$ws->transactionID.' '.$ws->responseReasonText);
                                $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
                                $pagina = array(
                                        'indicador' => '#mensaje_principal',
                                        'html' =>$pagina_html);
                                echo json_encode($pagina, JSON_FORCE_OBJECT);      
                              }else{
                                  throw new Exception("Error en la Actualizacion");
                              }    
                          }else{
                              throw new Exception("Error en la Actualizacion");
                          }         
                          break;
                      case 'PENDING':
                          $datos=Cls_PSETransactionInformation::actualizar($p_rowid_person,$transactionID,$ws->transactionState);
                          IF ($datos['nResultado']==0)
                          {
                              IF ($datos['nCount']==1)
                              {
                                $datos_pagina=mensaje::asignar_mensaje('Aviso','Transaccion '.$ws->transactionID.' '.$ws->responseReasonText);
                                $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
                                $pagina = array(
                                        'indicador' => '#mensaje_principal',
                                        'html' =>$pagina_html);
                                echo json_encode($pagina, JSON_FORCE_OBJECT);      
                              }else{
                                  throw new Exception("Error en la Actualizacion");
                              }    
                          }else{
                              throw new Exception("Error en la Actualizacion");
                          }       
                          break;
                      case 'FAILED':
                          $datos=Cls_PSETransactionInformation::actualizar($p_rowid_person,$transactionID,$ws->transactionState);
                         
                          IF ($datos['nResultado']==0)
                          {
                              IF ($datos['nCount']==1)
                              {
                                $datos_pagina=mensaje::asignar_mensaje('Error','Transaccion '.$ws->transactionID.' '.$ws->responseReasonText);
                                $pagina_html =$this->load->view('Mensaje',$datos_pagina,true);                  
                                $pagina = array(
                                        'indicador' => '#mensaje_principal',
                                        'html' =>$pagina_html);
                                echo json_encode($pagina, JSON_FORCE_OBJECT); 
                              }else{
                                  throw new Exception("Error en la Actualizacion");
                              }    
                          }else{
                              throw new Exception("Error en la Actualizacion");
                          }       
                          break;
                  }                

              }else IF ($datos['nCount']>1){
                  throw new Exception("Error en la Consulta de transacciones pendientes");
              }
            }
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