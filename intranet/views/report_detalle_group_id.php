<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

    if ($_SESSION['reported']==1)
    {
?>

<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">

<div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg" style="background-color: #343a40">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title" id="lbltitle" style="color: #FFFFFF">
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


        <div class="kt-portlet__body" id="contend_list" style="padding-bottom: 0px; padding-top: 20px;">
<div class="row">
    
    <div class="col-xl-5 col-lg-5">
        <div class="kt-portlet">
            <div class="kt-portlet__head" style="min-height:40px; background-color: #14443A;">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title" style="color: #FFFFFF">
                       <i class="fa fa-user"></i> DATOS ALUMNOS
                    </h3>
                </div>
            </div>
                <div class="kt-portlet__body">

                    <div class="form-group input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">ALUMNO</span></div>
                            <input type="text" class="form-control" id="tipo_alumno" name="tipo_alumno" readonly required>
                        </div>
                    </div>


                    <div class="form-group  input-group-sm datos" style="margin-bottom: 1rem;">
                      <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">GRADO</span></div>
                            <input type="text" class="form-control" id="datos1" name="datos1" readonly>
                        </div>
                    </div>

                    <div class="form-group  input-group-sm datos">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">GRUPO</span></div>
                            <input type="text" class="form-control" id="datos2" name="datos2" readonly>
                        </div>
                    </div>


                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">FECHA STAR</span></div>
                            <input type="date" class="form-control form-control form-control-sm" id="date_star" name="date_star">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                        </div>
                    </div>


                     <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">FECHA END</span></div>
                            <input type="date" class="form-control form-control form-control-sm" id="date_end" name="date_end">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                        </div>
                    </div>

                    <div class="form-group  input-group-sm">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">HORA INGRESO</span></div>
                            <input class="form-control form-control form-control-sm" type="time" id="timeingreso" name="timeingreso">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-clock-o"></i></span></div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-google btn-elevate btn-pill" onclick="viewpdf();"><i class="fa fa-file-pdf"></i> GENERAR</button>
                    
                </div>

        </div>
    </div>

    <div class="col-xl-7 col-lg-7">
        <div class="kt-portlet">
            <div class="kt-portlet__head" style="min-height:40px; background-color: #14443A;">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title" style="color: #FFFFFF">
                        <i class="fa fa-file-pdf"></i>  VISTA PREVIA
                    </h3>
                </div>
            </div>
                <div class="kt-portlet__body" >
                    <div class="row" style="border: 1px solid #484848; height: 410px;" id="view_pdf">
                        
                    </div>

                </div>

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

</div> 

</div> 

<div id="divprint" style="display: none;"></div>

<?php 
require 'footer.php'; 
    }else{
        require 'error.html';
    }
}
ob_end_flush();

?>

        <script type="text/javascript" src="scripts/view_detalle_group_id.js"></script>