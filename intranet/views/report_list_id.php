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


<div class="row">
    
    <div class="col-xl-5 col-lg-5">
        <div class="kt-portlet">
            <div class="kt-portlet__head" style="min-height:40px; background-color: #14443A;">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title" style="color: #FFFFFF">
                       <i class="fa fa-user"></i> INGRESAR DATOS DEL ALUMNO
                    </h3>
                </div>
            </div>
                <div class="kt-portlet__body">

                    <div class="form-group" style="margin-bottom: 1rem;">
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="hidden" class="form-control" id="idalumno" name="idalumno">
                            <input type="text" class="form-control form-control-sm" placeholder="Buscar..." id="idalu" name="idalu" required >
                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                <span><i class="la la-search"></i></span>
                            </span>
                        </div>
                    </div>


                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                      
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm" id="apellidos" name="apellidos" readonly placeholder="APELLIDOS">
                        </div>
                    </div>

                    <div class="form-group  input-group-sm">
                      
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm" id="names" name="names" readonly placeholder="NOMBRES">
                        </div>
                    </div>


                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">FECHA INCIO</span></div>
                            <input type="DATE" class="form-control form-control form-control-sm" id="date_star" name="date_star">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                        </div>
                    </div>


                     <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">FECHA FIN</span></div>
                            <input type="DATE" class="form-control form-control form-control-sm" id="date_end" name="date_end">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                        </div>
                    </div>

                </div>

        </div>
    </div>

    <div class="col-xl-7 col-lg-7">
        <div class="kt-portlet">

            <div class="kt-portlet__body" >
                        <div class="kt-section">
                            <div class="kt-section__content">
                                 <div class="col-sm-12 text-right">

                                    <div class="dt-buttons btn-group flex-wrap text-left">
                                        
                                        <button id="export_excel" onclick="reportExcel();" class="btn btn-secondary" type="button"><i class="kt-nav__link-icon fa fa-file-excel" style="color: green;font-size:18px;"></i></button>
                                        <button id="export_excel" onclick="reportWord();" class="btn btn-secondary" type="button"><i class="kt-nav__link-icon fa fa-file-word" style="color: #1A3AA4;font-size:18px;"></i></button>

                                        <button  id="export_pdf" onclick="reportPdf();" class="btn btn-secondary" type="button"><span><i class="fa fa-file-pdf" style="color: red;font-size:18px;"></i></span></button>
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

<script type="text/javascript" src="scripts/view_list_id.js"></script>


