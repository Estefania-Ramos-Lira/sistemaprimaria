<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

    if ($_SESSION['asistencias']==1)
    {
?>


<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                         Listado 
                     </h3>
                 </div>
                 <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <div class="dropdown dropdown-inline">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable table-sm" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IDALU</th>
                                <!--<th>ALUMNO</th>-->
                                <th>APELLIDOS</th>
                                <th>NOMBRE</th>
                                <th>GRADO</th>
                                <th>GRUPO</th>
                                <th>FECHA</th>
                                <th>ENTRADA</th>
                                <th>SALIDA</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>

                        <tfoot>
                        </tfoot>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>


<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
             <form class="kt-form kt-form--label-right " name="formulario" id="formulario" method="POST">
            <div class="modal-header">
                <h6 class="modal-title" id="lblmodal"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <table class="table table-striped" style="text-align: center;">
                    <tbody>
                        <tr>
                            <td><h4 id="namelast" name="namelast" ></h4></td>
                        </tr>
                    </tbody>
                </table>
     
                    <div class="form-group">
                         <input type="hidden" class="form-control" id="idalumno" name="idalumno">
                         <input type="hidden" class="form-control" id="idassistance" name="idassistance">

                        <label for="recipient-name" class="form-control-label">INGRESO:</label>
                        <input type="time" class="form-control form-control-sm" id="timestar" name="timestar">
                        <input type="date" class="form-control" id="datestar" name="datestar" style="display: none;">

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">SALIDA:</label>
                        <input type="time" class="form-control form-control-sm" id="timeend" name="timeend">
                        <input type="date" class="form-control" id="dateend" name="dateend" style="display: none;">
                    </div>
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hidemoldal()">Cerrar</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Guardar</button>
            </div>
             </form>

        </div>
    </div>
</div>


</div>

</div>
</div>

<?php 
require 'footer.php'; 
    }else{
        require 'error.html';
    }
}
ob_end_flush();

?>

<script type="text/javascript" src="scripts/list_assistance.js"></script>

