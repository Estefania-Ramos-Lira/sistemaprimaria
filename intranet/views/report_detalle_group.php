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
        <div class="kt-portlet__head kt-portlet__head--lg" style="background-color: #343a40 ">
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


        <div class="kt-portlet__body" id="contend_list" style="padding-bottom: 0px; background-color: #F5F4E3; padding-top: 20px; color: #000000">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>FECHA INICIO (*):</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                                                <input type="hidden" id="tipo_alumno" name="tipo_alumno" class="form-control form-control-sm">
                                                <input type="hidden" id="datos1" name="datos1" class="form-control form-control-sm">
                                                <input type="hidden" id="datos2" name="datos2" class="form-control form-control-sm">
                                        <input type="date" class="form-control form-control-sm" id="date_star" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label>FECHA FIN (*):</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                                        <input type="date"  class="form-control form-control-sm" id="date_end" placeholder="">
                                    </div>
                                </div>

                               <!-- <div class="col-lg-4">
                                    <label>HORA INGRESO:</label>
                                    <div class="input-group timepicker">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="la la-clock-o"></i></span>
                                        </div>
                                                <input class="form-control form-control-sm" type="time" id="timeingreso" name="timeingreso" value="">
                                    </div>
                                </div>--->

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









            <div class="kt-portlet__body" id="contend_list1">
                        <div class="kt-section">
                            <div class="kt-section__info">
                                <div class="col-sm-12 text-right">
                                    <div class="dt-buttons btn-group flex-wrap">
                                        <!--<button  onclick="reportPrinttime();" class="btn btn-secondary buttons-print" tabindex="0" aria-controls="kt_table_1" type="button"><i class="flaticon2-print" style="color: black; font-size:18px; "></i></button> -->
                                        <button onclick="reportExceltime();"class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="kt_table_1" type="button" ><i class="kt-nav__link-icon fa fa-file-excel" style="color: green;font-size:18px;"></i></button>
                                         <button onclick="reportWordtime();" class="btn btn-secondary" type="button"><i class="kt-nav__link-icon fa fa-file-word" style="color: #1A3AA4;font-size:18px;"></i></button>
                                        <button onclick="reportPdftime();" class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="kt_table_1" type="button"><span><i class="fa fa-file-pdf" style="color: red;font-size:18px;"></i></span></button>
                                    </div>
                                </div>
                            </div>

                            <div class="kt-section__content">
                                <div class="table-responsive" >
                                    <table class="table table-striped- table-bordered table-hover table-checkable table table-bordered table-striped table-sm" id="kt_table_1">
                                           
                                    </table>
                                </div>
                                
                            </div>
                            
                         </div>

                    </div>

</div> 

</div> 



<div id="divprint" style="display: none; "></div>
<?php 
require 'footer.php'; 
    }else{
        require 'error.html';
    }
}
ob_end_flush();

?>

        <script type="text/javascript" src="scripts/view_detalle_group.js"></script>
        <script type="text/javascript" src="scripts/report_detalle_group.js"></script>

