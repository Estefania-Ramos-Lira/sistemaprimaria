<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

if ($_SESSION['calendar']==1)
{
    ?>

<style>
#calendar{
  max-height: 485px;  
}

</style>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="kt-portlet kt-portlet--mobile">


                <div class="kt-portlet__body">
                    <div id='calendar' name='calendar' ></div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content -->


<!--begin::Modal-->
<div class="modal fade" id="kt_modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form name="formulario" id="formulario" method="POST">
            <div class="modal-body">


            <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">Tipo</span></div>
                        <select class="form-control form-control-sm" id="tipo" name="tipo" onkeypress="cbcondition();">
                            <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Feriado / Celebracion</font></font></option>
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nota</font></font></option>

                            
                        </select>
                        </div>
            </div>

            <div class="form-group  input-group-sm " style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">Titulo</span></div>
                            <input type="hidden"  id="idcalendar" name="idcalendar">
                            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon2" id="title" name="title">
                        </div>
            </div>


            <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">Fecha Inicio</span></div>
                            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon2" id="start" name="start" onkeypress="DataHora(event, this)">
                        </div>
            </div>


            <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">Fecha Fin</span></div>
                            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon2" id="end" name="end" onkeypress="DataHora(event, this)">
                        </div>
            </div>

            <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">Color</span></div>
                            <input type="color" value="" class="form-control" placeholder="" aria-describedby="basic-addon2" id="color" name="color">
                        </div>
            </div>

            <div class="form-group  input-group-sm" id="cbstatus" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">Condicion</span></div>
                        <select class="form-control form-control-sm" id="status" name="status">
                            <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activo</font></font></option>
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Desactivado</font></font></option>

                            
                        </select>
                        </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hidemoldal();">Cancel</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Guardar</button>
            </div>
         </form>

         <form name="formulario_delete" id="formulario_delete" method="POST">

            <div class="modal-body">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <th scope="row" width="30%">Tipo</th>
                      <td id="td_tipo"></td>
                    </tr>
                    <tr>
                      <th scope="row">Titulo</th>
                      <td id="td_title"></td>
                    </tr>
                    <tr>
                      <th scope="row">Fecha Inicio</th>
                      <td id="td_start"></td>
                    </tr>
                    <tr>
                      <th scope="row">Fecha Fin</th>
                      <td id="td_end"></td>
                    </tr>
                    <tr>
                      <th scope="row">Condicion</th>
                      <td id="td_condition"></td>
                    </tr>
                    <tr>
                        <td></td><td></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden"  id="idcalendar_delete" name="idcalendar_delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="showform(true)">Editar</button>
                <button  type="button" class="btn btn-danger" id="delet" >Eliminar</button>
            </div>


         </form>
        </div>
       
    </div>
</div>
<!--end::Modal-->

<?php 

require 'footer.php'; 
}else{
    require 'error.html';
  }

}
ob_end_flush();

?>

<script type="text/javascript" src="scripts/calendar.js"></script>

<script>

function DataHora(evento,objeto){

  var keypress=(window.event) ? event.keyCode:evento.which;
  campo=eval(objeto);
  if(campo.value=='00/00/000 00:00:00'){
    campo.value="";
  }

    caracteres='0123456789';
    separador1='/';
    separador2=' ';
    separador3=':';
    conjunto1='2';
    conjunto2='5';
    conjunto3='10';
    conjunto4='13';
    conjunto5='16';

    if((caracteres.search(String.fromCharCode(keypress))!= -1)&& campo.value.length<(19)){
        if (campo.value.length==conjunto1) {
            campo.value=campo.value+separador1;
        }else if(campo.value.length==conjunto2) {
            campo.value=campo.value+separador1;
        }else if(campo.value.length==conjunto3) {
            campo.value=campo.value+separador2;
        }else if(campo.value.length==conjunto4) {
            campo.value=campo.value+separador3;
        }else if(campo.value.length==conjunto5){ 
            campo.value=campo.value+separador3;}
    }else{
        event.returnValue=false;
    }
}

</script>