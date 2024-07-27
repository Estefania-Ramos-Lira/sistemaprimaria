<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';
?>
<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">


<div class="row">
    
    <div class="col-xl-5 col-lg-5">
        <div class="kt-portlet">
            <div class="kt-portlet__head" style="min-height:40px; background-color: #14443A;">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title" style="color: #FFFFFF">
                       <i class="fa fa-user"></i> DATOS DE LA PERSONA
                    </h3>
                </div>
            </div>
                <div class="kt-portlet__body">

                    <div class="form-group" style="margin-bottom: 1rem;">
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="hidden" class="form-control" value="<?php echo $_SESSION['idalumno']; ?>" id="idalumno" name="idalumno">
                            <input type="text" class="form-control form-control-sm" readonly id="idalu" name="idalu" required value="<?php echo $_SESSION['idalu']; ?>" >
                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                <span><i class="la la-search"></i></span>
                            </span>
                        </div>
                    </div>


                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                      
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm" id="apellidos" name="apellidos" readonly placeholder="APELLIDOS" value="<?php echo $_SESSION['apellidos']; ?>">
                        </div>
                    </div>

                    <div class="form-group  input-group-sm">
                      
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm" id="names" name="names" readonly placeholder="NOMBRES" value="<?php echo $_SESSION['nombre']; ?>">
                        </div>
                    </div>


                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">FECHA STAR</span></div>
                            <input type="DATE" class="form-control form-control form-control-sm" id="date_star" name="date_star">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div>
                        </div>
                    </div>


                     <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">FECHA END</span></div>
                            <input type="DATE" class="form-control form-control form-control-sm" id="date_end" name="date_end">
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

<?php 
require 'footer.php'; 

}
ob_end_flush();

?>

        <script type="text/javascript" src="scripts/view_personal.js"></script>
