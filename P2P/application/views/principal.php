<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<title>Prueba PSE</title>
<head>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/MasterPage.css"); ?>" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>    
    <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.anexgrid"); ?>"></script>    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<style type="text/css">
  #gif_principal
    {
    position:fixed;
    top:0px;
    left:0px;
    z-index:3200;
    filter:alpha(opacity=40);
   -moz-opacity:40;
    opacity:0.40;
    background:#ffffff;
    }
</style>
<body>
	<form id="frm_principal">
        <div id="mensaje_principal">
        </div>
        <div id='body_principal'> 
            <input id="text_rowid_person_PagBas" type="text" class="form-control"  value="<?php if(isset($rowid_person)) echo $rowid_person; ?>"  style="display:none;"/>    
        </div>          
    </form>
</body>
<script type="text/javascript">
$(document).ready(function() {
    objeto={}
    objeto['page']='pago_basico'
    objeto['rowid_person']=document.getElementById('text_rowid_person_PagBas').value;
    page_controller="index.php/controller_view/page_view"
    //Solicitud funcion para cargar la pagina
    myPage_principal(page_controller,objeto,'#body_principal')       
}); 


var myPage_principal = function(controller,user_page,page_div){
    controller="<?php echo base_url(); ?>"+controller
    jQuery.ajax ({
                 url:controller,
                 type: 'POST',
                 datatype:'json',
                 timeout: 10000,                 
                 data:user_page,
                 beforeSend: function(){
                    gif_load();
                 },
                 success: function(success_res){
                    if (success_res)
                    {
                        gif_remover();
                        $(page_div).html(success_res);  
                    }
                 },
                 error: function(e){
                    //$("#respuesta").html('');                    
                    alert(e.statusText)
                 }                 
        });
    }


var formato_json_principal= function(datos,controller)
    {
        var datos_json = datos.split(",");
        var objeto={}
        if(datos!='')
        {
            for (var i=0; i<datos_json.length; i++) 
            { 
                if(document.getElementById(datos_json[i]).value!=undefined)
                    objeto[datos_json[i]]=document.getElementById(datos_json[i]).value
                else
                    objeto[datos_json[i]]=document.getElementById(datos_json[i]).innerHTML
            }
        }
        esb_principal(controller,objeto,datos);    
    }

var formato_json_ws= function(datos,controller)
    {
        var datos_json = datos.split(",");
        var objeto={}
        if(datos!='')
        {
            for (var i=0; i<datos_json.length; i++) 
            { 
                if(document.getElementById(datos_json[i]).value!=undefined)
                    objeto[datos_json[i]]=document.getElementById(datos_json[i]).value
                else
                    objeto[datos_json[i]]=document.getElementById(datos_json[i]).innerHTML
            }
        }
        esb_ws(controller,objeto,datos);    
    }

//Movimiento de la informacion
var esb_principal = function(controller,data,campos){
    controller="<?php echo base_url(); ?>"+controller
    jQuery.ajax ({
                 url:controller,
                 type: 'POST',
                 datatype:'json',
                 data:data,                            
                 beforeSend: function(){
                    gif_load();
                 },
                 success: function(success_res){
                    if (success_res)
                    {
                        gif_remover();
                        success_res = $.parseJSON(success_res)
                        var i=0;
                        for (var segmento in success_res){
                              segmento_indicador=segmento.substr(0,9)
                              segmento_html=segmento.substr(0,4)
    
                              if(segmento_indicador=='indicador')
                              {
                                 indicador = success_res[segmento]
                                 i=i+1;
                              }
                              if(segmento_html=='html')
                              {
                                 html = success_res[segmento]                              
                                 i=i+1;
                              }
                              if(i==2)
                              {
                                 $(indicador).html(html);  
                                 i=0;
                              }
                        }  
                    }
                 },
                 error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                 }                 
        });
    }

var esb_ws = function(controller,data,campos){
    controller="<?php echo base_url(); ?>"+controller
    jQuery.ajax ({
                 url:controller,
                 type: 'POST',
                 datatype:'json',
                 data:data,
                 beforeSend: function(){                   
                 },
                 success: function(success_res){
                    if (success_res)
                    {
                        success_res = $.parseJSON(success_res)
                        var i=0;
                        for (var segmento in success_res){
                              segmento_indicador=segmento.substr(0,9)
                              segmento_html=segmento.substr(0,4)
    
                              if(segmento_indicador=='indicador')
                              {
                                 indicador = success_res[segmento]
                                 i=i+1;
                              }
                              if(segmento_html=='html')
                              {
                                 html = success_res[segmento]                              
                                 i=i+1;
                              }
                              if(i==2)
                              {
                                 $(indicador).html(html);  
                                 i=0;
                              }
                        }  
                    }
                 },
                 error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                 }                 
        });
    }

var gif_remover=function () {
    $("#gif_principal").remove();    
}
 
var gif_load=function () {
    //eliminamos si existe un div ya bloqueando
    gif_remover();
    //centrar imagen gif
    ancho = 0;
    alto = 0;
    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;
    //operación necesaria para centrar el div que muestra el mensaje
    heightdivsito = alto/2 - parseInt(20)/2;//Se utiliza en el margen superior, para centrar    
    //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><img style='color:#000;margin-top:" + heightdivsito + "px;' src=\""+"<?php echo base_url(); ?>" + "assets/png/ajax-loader.gif\"/></div>";
        //div que bloquea 
        div = document.createElement("div");
        div.id = "gif_principal"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("#body_principal").append(div);
        //creamos un input text para que el foco se situe y no se permita escribir
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"
        
        //asignamos el div que bloquea
        $("#gif_principal").append(input);
 
        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();
 
        //centramos el div del texto
        $("#gif_principal").html(imgCentro);
 
}
</script>


