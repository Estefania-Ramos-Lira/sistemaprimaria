<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';
date_default_timezone_set('America/Regina');

    if ($_SESSION['asistencias']==1)
    {
?>


<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title" id="lbltitle">
                    GRUPOS
                </h3>
            </div>

            <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <button type="button" id="btnreturn" class="btn btn-brand btn-sm" onclick="cancelform()"><i class="fa fa-arrow-left"></i> Regresar</button>
                </div>  
            </div>      

            </div>

        </div>

        <div class="kt-portlet__body" id="contend_group">
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-sm table-striped- table-bordered table-hover table-bordered table-condensed table-checkable dataTable no-footer dtr-inline" id="kt_table_group" name="kt_table_group" role="grid" aria-describedby="kt_table_1_info" style="width: 1003px;">
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="kt-portlet__body" id="contend_list">
            <form class="kt-form kt-form--label-right " name="formulario" id="formulario" method="POST">
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row" >
                     <div class="col-sm-12" style="margin-bottom:  -15px">
                            <div class="form-group row" >
                                        <div class="col-md-2">
                                            <label for="example-date-input">Seleccionar Fecha:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="la la-calendar-check-o" aria-hidden="true"></i></span></div>
                                                <input type="date" id="datesearch" name="datesearch" class="form-control form-control-sm" value="<?php echo date("Y-m-d");?>" required >
                                                <input type="hidden" id="tipo_alumno" name="tipo_alumno" class="form-control form-control-sm">
                                                <input type="hidden" id="datos1" name="datos1" class="form-control form-control-sm">
                                                <input type="hidden" id="datos2" name="datos2" class="form-control form-control-sm">
                                                <div class="input-group-append">
                                                   <button type="button" id="btncopy" class="btn btn-sm btn-primary btn-wide" onclick="bntcopy()"><i class="flaticon2-check-mark" aria-hidden="true" style="color: #FFFFFF"></i> Cerrar</button>
                                                </div>
                                            </div>
                                        </div>

                             </div>
                     </div>

                </div>
                <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-sm table-striped- table-bordered table-hover table-bordered table-condensed table-checkable dataTable no-footer dtr-inline" role="grid" aria-describedby="kt_table_1_info" id="kt_table_assistance">
                        </table>
                        
                         </div>
                    
                </div>
                <button  type="submit" id="btnsave" class="btn btn-sm btn-primary btn-wide" hidden="hidden"><i class="flaticon2-check-mark" aria-hidden="true" style="color: #FFFFFF"></i></button>
            </div>
            </form>
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

        <script type="text/javascript" src="scripts/check_out.js"></script>

        