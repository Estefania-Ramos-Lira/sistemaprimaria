<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

    if ($_SESSION['reportel']==1)
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


        <div class="kt-portlet__body" id="contend_list" style="padding-bottom: 0px; background-color: #F5F4E3; padding-top: 20px; color: #000000">
                            <div class="form-group row" >
                                <div class="col-lg-4">
                                    <label>FECHA INICIO(*):</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                                                <input type="hidden" id="tipo_alumno" name="tipo_alumno" class="form-control form-control-sm">
                                                <input type="hidden" id="datos1" name="datos1" class="form-control form-control-sm">
                                                <input type="hidden" id="datos2" name="datos2" class="form-control form-control-sm">
                                        <input type="text" class="form-control form-control form-control-sm date" id="date_star" name="date_star" placeholder="" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label>FECHA FIN (*):</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                                         <input type="text" class="form-control form-control form-control-sm date" id="date_end" placeholder="" readonly>
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









            <div class="kt-portlet__body" id="contend_list1">
                        <div class="kt-section">
                            <div class="kt-section__content">
                                 <div class="col-sm-12 text-right">

                                    <div class="dt-buttons btn-group flex-wrap text-left">
                                       <!-- <button  onclick="reportPrinttime();" class="btn btn-secondary"  type="button"><i class="flaticon2-print" style="color: black; font-size:18px; "></i></button>-->

                                        <button id="export_excel" onclick="reportTime();" class="btn btn-secondary" type="button"><i class="kt-nav__link-icon fa fa-file-excel" style="color: green;font-size:18px;"></i></button>
                                        <button id="export_excel" onclick="reportWord();" class="btn btn-secondary" type="button"><i class="kt-nav__link-icon fa fa-file-word" style="color: #1A3AA4;font-size:18px;"></i></button>

                                        <button  id="export_pdf" onclick="reportPdftime();" class="btn btn-secondary" type="button"><span><i class="fa fa-file-pdf" style="color: red;font-size:18px;"></i></span></button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive" >
                                    <table class="table table-striped- table-bordered table-hover table-checkable table-sm" id="kt_table_1">
                                        <thead >
                                            <tr >
                                                <th>ID</th>
                                                <th>APELLIDOS</th>
                                                <th>NOMBRE</th>
                                                <th>GRADO</th>
                                                <th>GRUPO</th>
                                                <th>FECHA</th>
                                                <th>ENTRADA</th>
                                                <th>SALIDA</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>

                                        <tfoot>
                                        </tfoot>
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

        <script type="text/javascript" src="scripts/view_list_group.js"></script>
         <script type="text/javascript" src="scripts/report_list_group.js"></script>

<script type="text/javascript">
             
/*dd/mm/yy*/

$( function() {

var dateFormat = "dd/mm/yy";
  var from = $( "#date_star" )
      .datepicker({
        changeMonth: true
      })
      .on( "change", function() {
        to.datepicker( "option", "minDate", getDate( this ) );
      }),
    to = $( "#date_end" ).datepicker({
      changeMonth: true
    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });



  function getDate( element ) {
    var date;
    
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }

    return date;
  }



});
         </script>