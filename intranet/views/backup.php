<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

if ($_SESSION['seguridad']==1)
{
    ?>

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main ">
            

            <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs ">
                    <a href="#" class="kt-subheader__breadcrumbs-home">
                        <i class="flaticon2-shelter"></i>
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <h3 class="kt-subheader__title" style="text-align: center">Copia de respaldo de una base de datos 
                     </h3>
                </div>
        </div>

    </div>
</div>



<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row justify-content-center">
<div class="col-xl-7 col-lg-7">
        <div class="kt-portlet">
            <div class="kt-portlet__head" style="min-height:40px; background-color: #14443A;">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title" style="color: #FFFFFF">
                       <i class="fa fa-user"></i> Credenciales de la base de datos
                    </h3>
                </div>
            </div>
                <div class="kt-portlet__body">
                    <form    name="formulario" id="formulario" method="POST" action="../controllers/backup.php">
                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">SERVIDOR</span></div>
                            <input type="text" class="form-control form-control-sm" id="server" name="server" placeholder="Ejemplo: 'localhost'" required>
                        </div>
                    </div>

                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">USUARIO</span></div>
                            <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Ejemplo: 'root'" required>
                        </div>
                    </div>


                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">CONTRASEÑA</span></div>
                            <input type="text" class="form-control form-control-sm" id="password" name="password" placeholder="db password">
                        </div>
                    </div>

                    <div class="form-group  input-group-sm" style="margin-bottom: 1rem;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">BASE DE DATOS</span></div>
                            <input type="text" class="form-control form-control-sm"  id="dbname" name="dbname" placeholder="Nombre de la base de datos a respaldar" required>
                        </div>
                    </div>

                     <button type="submit" class="btn btn-primary" id="backup" name="backup">Respaldo</button>
                </form>
                </div>

        </div>
    </div>

    </div>
</div>
<!-- end:: Content -->
<?php 

require 'footer.php'; 
}else{
    require 'error.html';
  }

}
ob_end_flush();

?>

<script>
    $('#msecurity').addClass("kt-menu__item--open kt-menu__item--here");
    $('#lbackup').addClass("kt-menu__item--active");
</script>
<!-- <script type="text/javascript" src="scripts/backup.js"></script> -->