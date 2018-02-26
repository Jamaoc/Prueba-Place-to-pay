<?php
/**
 */

//referencias
require_once(APPPATH.'controllers/mensaje.php'); 
require_once(APPPATH.'models/Logica/cls_ws_pse.php'); 
require_once(APPPATH.'models/Logica/PSEPerson.php'); 
require_once(APPPATH.'models/Logica/PSETransactionInformation.php'); 


class Pagina_verificacion extends CI_Controller{
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
  function crear_transaccion()
    {
      try{
        $bankInterface=$this->input->post('select_tipCuenta_PagBas');
        $bankCode=$this->input->post('select_lstbank_PagBas');
        $description=$this->input->post('text_DescPag_PagVrf');
        $totalAmount=$this->input->post('text_ValPag_PagVrf');
        $payer=array(
                'document'=>$this->input->post('text_NumId_PagVrf'),
                'documentType'=>$this->input->post('select_tipId_PagVrf'),
                'firstName'=>$this->input->post('text_nombres_PagVrf'),
                'lastName'=>$this->input->post('text_apellidos_PagVrf'),
                'company'=>'',
                'emailAddress'=>$this->input->post('text_email_PagVrf'),
                'address'=>$this->input->post('text_direccion_PagVrf'),
                'city'=>'',
                'province'=>'',
                'country'=>'',
                'phone'=>'',
                'mobile'=>$this->input->post('text_celular_PagVrf')
               );
        //insercion bd PSEPerson
        $datos=Cls_PSEPerson::insertar($this->input->post('text_NumId_PagVrf'),$this->input->post('select_tipId_PagVrf'),$this->input->post('text_nombres_PagVrf'),$this->input->post('text_apellidos_PagVrf'),$this->input->post('text_email_PagVrf'),$this->input->post('text_direccion_PagVrf'),$this->input->post('text_celular_PagVrf'));
        
        $datos=Cls_PSEPerson::consultar($this->input->post('text_email_PagVrf'));
        IF ($datos['nResultado']==0)
        {
              IF ($datos['nCount']==1)
              {
                $rowid_person=$datos['consulta'][0]['rowid'];
              }else{
                throw new Exception("Error en la Validadion del Email");
              }
        }else{
           throw new Exception("Error en la Validadion del Email");
        } 


        $ws=cls_ws_pse::createTransaction($bankCode,$bankInterface,$description,$totalAmount,$payer,null,null,$rowid_person);
        
        if($ws->returnCode=='SUCCESS'){
            $transactionID=$ws->transactionID;
            $sessionID=$ws->sessionID;
            $returnCode=$ws->returnCode;
            $trazabilityCode=$ws->trazabilityCode;
            $transactionCycle=$ws->transactionCycle;
            $bankCurrency=$ws->bankCurrency;
            $bankFactor=$ws->bankFactor;
            $bankURL=$ws->bankURL;
            $responseCode=$ws->responseCode;
            $responseReasonCode=$ws->responseReasonCode;
            $responseReasonText=$ws->responseReasonText;        
            
            $datos=Cls_PSETransactionInformation::insertar($rowid_person,$transactionID,$sessionID,$returnCode,$trazabilityCode,$transactionCycle,$bankCurrency,$bankFactor,$bankURL,$responseCode,$responseReasonCode,$responseReasonText);
            IF ($datos['nResultado']==0)
              {
                  $datos_pagina['bankURL']=$ws->bankURL;            
                  $datos_pagina_mensaje=mensaje::asignar_mensaje('Correcto',$ws->responseReasonText);
                  $pagina_html =$this->load->view('Mensaje',$datos_pagina_mensaje,true);                  
                  $pagina_html1=$this->load->view('Pagina_verificacion',$datos_pagina,true);
                  $pagina = array(
                              'indicador' => '#mensaje_principal',
                              'html' =>$pagina_html,
                              'indicador1' => '#body_principal',
                              'html1' =>$pagina_html1
                              );
                  echo json_encode($pagina, JSON_FORCE_OBJECT);
              }else{ 
                  throw new Exception(utf8_encode($datos['Mensaje']));                                 
              }                               
        }else{
            $datos_pagina_mensaje=mensaje::asignar_mensaje('Error',$ws->responseReasonText);
            $pagina_html =$this->load->view('Mensaje',$datos_pagina_mensaje,true);                  
            $pagina = array(
                        'indicador' => '#mensaje_principal',
                        'html' =>$pagina_html,
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
  /*---------------------------------------------*/  
  function pago_basico()
    {
     try{
        $ws=cls_ws_pse::getBankList();
        $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
        $datos_pagina['select_lstbank_PagBas']= $this->input->post('select_lstbank_PagBas');
        $datos_pagina['rowid_person']= $this->input->post('text_rowid_person_PagBas');
        $datos_pagina['lstbank']=$ws;
        
        $pagina_html =$this->load->view('pago_basico',$datos_pagina,true);
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
  /*---------------------------------------------*/  
  function verificacion_registro()
    {
     try{
        $ws=cls_ws_pse::getBankList();
        $datos_pagina['select_tipCuenta_PagBas']= $this->input->post('select_tipCuenta_PagBas');
        $datos_pagina['select_lstbank_PagBas']= $this->input->post('select_lstbank_PagBas');
        $datos_pagina['lstbank']=$ws;
        
        $pagina_html =$this->load->view('verificacion_registro',$datos_pagina,true);
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
}
?>