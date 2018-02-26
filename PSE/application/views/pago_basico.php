<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
    
    $(document).ready(function() {
        temporizador_1();
        timer_1 = setInterval('temporizador_1()',10000);           
    }); 

    
    $('#select_tipCuenta_PagBas').change(function(evento) {
        formato_json_principal('select_tipCuenta_PagBas,text_rowid_person_PagBas','index.php/pago_basico/select_lstbank')
    }); 
    function temporizador_1() {
        formato_json_ws('text_rowid_person_PagBas','index.php/estado_transaccion/consultar_transaccion')        
    }    
</script>	
</head>
<body>
    <form id="frm_PagBas" class="form-horizontal">
        <div id="franja_PagBas" style="background-color:#FFC300;height:5px; margin-top: 0%">
        </div>
        <h4 style="margin-left:10px">Pago Basico en Linea PSE - Listado de Bancos</h4>
        <div id="panel_body_PagBas" class="form-group form-group-xs col-xs-10 col-xs-offset-1" style="margin-top:5%;">   
            <div id="form_pago_PagBas" class="col-xs-4 col-xs-offset-5">
            <div id="panel_PagBas" class="panel panel-info">
                <div class="panel-heading">
                    Informacion Financiera
                </div>
                <div class="panel-body">
                    <label id="label_tipCuenta_PagBas">Indique el Tipo de Cuenta</label>
                    <select id="select_tipCuenta_PagBas" class="form-control"> 
                                <option value=2 <?php if(isset($select_tipCuenta_PagBas) and $select_tipCuenta_PagBas==2):?>selected<?php endif;?>>
                                Seleccione Tipo de Cuenta</option>
                                <option value=0 <?php if(isset($select_tipCuenta_PagBas) and $select_tipCuenta_PagBas==0):?>selected<?php endif;?>>
                                Personal</option>
                                <option value=1 <?php if(isset($select_tipCuenta_PagBas) and $select_tipCuenta_PagBas==1):?>selected<?php endif;?>>
                                Empresa</option>
                    </select> 
                    <span id="span_tipCuenta_PagBas" style="color:red"><?php if(isset($span_tipCuenta_PagBas)) echo $span_tipCuenta_PagBas?></span>
                    <br>
                    <label id="label_lstbank_PagBas">Seleccione la entidad financiera con la que desea hacer el pago</label>
                    <select id="select_lstbank_PagBas" class="form-control"> 
                                <?php 
                                if($lstbank): foreach($lstbank as  $bank):
                                ?>
                                    <option value="<?php echo $bank->bankCode;?>" 
                                    <?php if(isset($select_lstbank_PagBas) and $select_lstbank_PagBas==$bank->bankCode):?> 
                                    selected<?php endif;?>><?php echo $bank->bankName;?></option>
                                <?php endforeach; endif;?> 
                    </select> 
                    <span id="span_lstbank_PagBas" style="color:red"><?php if(isset($span_lstbank_PagBas)) echo $span_lstbank_PagBas?></span>
                    <br>
                    <br>
                    <button type="button" class="btn btn-default" onclick="formato_json_principal('select_tipCuenta_PagBas,select_lstbank_PagBas,text_rowid_person_PagBas','index.php/pago_basico/verificacion_registro')">Generar Proceso de Pago</button>

                    <input id="text_rowid_person_PagBas" type="text" class="form-control"  value="<?php if(isset($rowid_person)) echo $rowid_person; ?>" style="display:none;"/>
               </div> 
            </div>
            </div>             
        </div>
    </form>
</body>



