<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<form id="frm_mensaje">
  <!--barra mensaje-->
  <div id="pnlmensaje_mensaje" class="<?php echo $css;?>" style="margin-bottom:0px">
      <spam id="label_accion_mensaje" style="margin-left:50px;font-weight:bold"><?php echo $tipo_mensaje;?></sapm>
      <spam id="label_notificacion_mensaje" style="margin-left:5px;font-weight:lighter;"><?php echo $mensaje;?></spam>
  </div>      
</form>
<script type="text/javascript">

$(document).ready(function() {
  if(typeof(timer) != "undefined")
    timer = clearInterval(timer);
  timer = setInterval('temporizador()',3000);           
}); 
function temporizador() {
		$("#pnlmensaje_mensaje").slideUp();;
		timer = clearInterval(timer);
}
</script>


