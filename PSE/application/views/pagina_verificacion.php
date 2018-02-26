<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<META HTTP-EQUIV="REFRESH" <?php if(isset($bankURL)){ ?> CONTENT="4;<?php echo 'URL='.$bankURL ?>" <?php } ?> >
<script>
</script>	
</head>
<body>
    <form id="frm_PagVrf" class="form-horizontal">
        <div id="franja_PagBas" style="background-color:#FFC300;height:5px; margin-top: 0%">
        </div>
        <h4 style="margin-left:10px">Pago Basico en Linea PSE - Datos Personales y Transaccion</h4>
        <div id="panel_body_PagVrf" class="form-group form-group-xs col-xs-10 col-xs-offset-1" style="margin-top:5%;">   
            <div id="form_persona_PagVrf" class="col-xs-6 col-xs-offset-4">
            <div id="panel_PagVrf" class="panel panel-info">
                <div class="panel-heading">
                    Datos Basicos Personales
                </div>
                <div class="panel-body">
                    <input id="select_tipCuenta_PagBas" type="text" class="form-control" style="display:none;" 
                    value="<?php if(isset($select_tipCuenta_PagBas)) echo $select_tipCuenta_PagBas; ?>" />                   
                    <input id="select_lstbank_PagBas" type="text" class="form-control" style="display:none;"                    value="<?php if(isset($select_lstbank_PagBas)) echo $select_lstbank_PagBas; ?>" />                   

                    <div class="row">
                        <div class="col-xs-6">
                            <label id="label_tipId_PagVrf">Tipo de Identificacion</label>
                            <select id="select_tipId_PagVrf" class="form-control"> 
                                        <option value=''>Seleccione Tipo de Identificacion</option>
                                        <option value='CC' <?php if(isset($select_tipId_PagVrf) and $select_tipId_PagVrf=='CC'):?>selected<?php endif;?>>Cédula de ciudanía colombiana</option>                            
                                        <option value='CE' <?php if(isset($select_tipId_PagVrf) and $select_tipId_PagVrf=='CE'):?>selected<?php endif;?>>Cédula de extranjería</option>
                                        <option value='TI' <?php if(isset($select_tipId_PagVrf) and $select_tipId_PagVrf=='TI'):?>selected<?php endif;?>>Tarjeta de identidad</option>
                                        <option value='PPN' <?php if(isset($select_tipId_PagVrf) and $select_tipId_PagVrf=='PPN'):?>selected<?php endif;?>>Pasaporte</option>
                            </select> 
                        </div>
                        <div class="col-xs-6">
                            <label id="label_NumId_PagVrf">Numero de Identificacion</label>
                            <input id="text_NumId_PagVrf" type="text" class="form-control" value="<?php if(isset($text_NumId_PagVrf)) echo $text_NumId_PagVrf;?>" <?php if(isset($text_NumId_PagVrf)){ ?> disabled <?php } ?>/>                   
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <label id="label_nombres_PagVrf">Nombres</label>
                            <input id="text_nombres_PagVrf" type="text" class="form-control" value="<?php if(isset($text_nombres_PagVrf)) echo $text_nombres_PagVrf;?>" <?php if(isset($text_nombres_PagVrf)){ ?> disabled <?php } ?>/>                                     

                        </div>
                        <div class="col-xs-6">
                            <label id="label_apellidos_PagVrf">Apellidos</label>
                            <input id="text_apellidos_PagVrf" type="text" class="form-control" value="<?php if(isset($text_apellidos_PagVrf)) echo $text_apellidos_PagVrf;?>" <?php if(isset($text_apellidos_PagVrf)){ ?> disabled <?php } ?>/>                   
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <label id="label_email_PagVrf">Correo Electronico</label>
                            <input id="text_email_PagVrf" type="text" class="form-control" value="<?php if(isset($text_email_PagVrf)) echo $text_email_PagVrf;?>" <?php if(isset($text_email_PagVrf)){ ?> disabled <?php } ?> />                   
                        </div>    
                        <div class="col-xs-6">
                            <label id="label_direccion_PagVrf">Direccion Completa</label>
                            <input id="text_direccion_PagVrf" type="text" class="form-control" value="<?php if(isset($text_direccion_PagVrf)) echo $text_direccion_PagVrf;?>" <?php if(isset($text_direccion_PagVrf)){ ?> disabled <?php } ?>/>                   
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <label id="label_celular_PagVrf">Numero de Celular</label>
                            <input id="text_celular_PagVrf" type="text" class="form-control" value="<?php if(isset($text_celular_PagVrf)) echo $text_celular_PagVrf;?>" <?php if(isset($text_celular_PagVrf)){ ?> disabled <?php } ?>/>                   
                        </div>
                        <div class="col-xs-6">
                        </div>    
                    </div>                    
            </div>
            </div>       
            <br>
            <div id="panel_PagVrf" class="panel panel-info">
                <div class="panel-heading">
                    Datos Financieros
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <label id="label_ValPag_PagVrf">Valor a Pagar COP</label>
                            <input id="text_ValPag_PagVrf" type="text" class="form-control" />                   
                        </div>
                        <div class="col-xs-6">
                            <label id="label_DescPag_PagVrf">Descripcion de Pago</label>
                            <input id="text_DescPag_PagVrf" type="text" class="form-control" />                   
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-default form-control" onclick="formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas','index.php/pagina_verificacion/verificacion_registro')">Regresar</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-default form-control" onclick="formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas,select_tipId_PagVrf,text_NumId_PagVrf,text_nombres_PagVrf,text_apellidos_PagVrf,text_email_PagVrf,text_direccion_PagVrf,text_celular_PagVrf,text_ValPag_PagVrf,text_DescPag_PagVrf','index.php/pagina_verificacion/crear_transaccion')">Continuar Proceso de Pago</button>
                        </div>
               </div> 
            </div>
            </div>                  
        </div>
        <?php if(isset($resultado)) var_dump($resultado)?>
    </form>
</body>



