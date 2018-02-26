<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
    $('#text_Email_VerReg').change(function(evento) {
        formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas,text_Email_VerReg','index.php/Verificacion_registro/validar_person')
    });
</script>	
</head>
<body>
    <form id="frm_VerReg" class="form-horizontal">
        <div id="franja_VerReg" style="background-color:#FFC300;height:5px; margin-top: 0%">
        </div>
        <h4 style="margin-left:10px">Pago Basico en Linea PSE - Verificacion Registro</h4>
        <div id="panel_body_PagVrf" class="form-group form-group-xs col-xs-10 col-xs-offset-1" style="margin-top:5%;">   
            <div id="form_persona_VerReg" class="col-xs-6 col-xs-offset-4">
            <div id="panel_VerReg" class="panel panel-info">
                <div class="panel-heading">
                    Email Registrado
                </div>
                <div class="panel-body">
                    <input id="select_tipCuenta_PagBas" type="text" class="form-control" style="display:none;" 
                    value="<?php if(isset($select_tipCuenta_PagBas)) echo $select_tipCuenta_PagBas; ?>" />                   
                    <input id="select_lstbank_PagBas" type="text" class="form-control" style="display:none;"                    value="<?php if(isset($select_lstbank_PagBas)) echo $select_lstbank_PagBas; ?>" />
                    <input id="text_rowid_person_PagBas" type="text" class="form-control"  value="<?php if(isset($rowid_person)) echo $rowid_person; ?>" style="display:none;"/>

                    <div class="row">
                        <div class="col-xs-6">
                            <label id="label_Email_VerReg">Soy un Usuario Registrado</label>
                        </div>
                        <div class="col-xs-6">
                            <input id="text_Email_VerReg" type="text" class="form-control" placeholder="email_registro" />                   
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-default form-control" onclick="formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas,text_rowid_person_PagBas','index.php/pagina_verificacion/pago_basico')">Regresar</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-default form-control" onclick="formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas','index.php/Verificacion_registro/pagina_verificacion')">Generar un registro Nuevo</button>
                        </div>
               </div> 
            </div>
            </div>                  
        </div>
        <?php if(isset($resultado)) var_dump($resultado)?>
    </form>
</body>



