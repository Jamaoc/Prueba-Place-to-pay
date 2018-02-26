<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>    
</script>	
</head>
<body>
    <form id="frm_DetTran" class="form-horizontal">
        <div id="franja_PagBas" style="background-color:#FFC300;height:5px; margin-top: 0%">
        </div>
        <h4 style="margin-left:10px">Pago Basico en Linea PSE - Detalle de Transaccion</h4>
        <div id="panel_body_DetTran" class="form-group form-group-xs col-xs-10 col-xs-offset-1" style="margin-top:5%;">   
            <div id="form_persona_DetTran" class="col-xs-6 col-xs-offset-4">
            <div id="panel_DetTran" class="panel panel-info">
                <div class="panel-heading">
                    Detalle de Transaccion
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <label id="label_tipId_DetTran">Tipo de Identificacion</label>
                        </div>
                        <div class="col-xs-6">
                            <label id="label_tipId_DetTran">Tipo de Identificacion</label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-default form-control" onclick="formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas','index.php/pagina_verificacion/pago_basico')">Cancelar Pago</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-default form-control" onclick="formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas,select_tipId_PagVrf,text_NumId_PagVrf,text_nombres_PagVrf,text_apellidos_PagVrf,text_email_PagVrf,text_direccion_PagVrf,text_celular_PagVrf,text_ValPag_PagVrf,text_DescPag_PagVrf','index.php/pagina_verificacion/crear_transaccion')">Ir a la Pagina del Banco</button>
                        </div>
                    </div> 
                </div>
            </div>                  
        </div>        
    </form>
</body>



