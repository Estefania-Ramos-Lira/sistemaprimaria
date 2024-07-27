<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

if ($_SESSION['acceso']==1)
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
                            LISTADO DE USUARIOS
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar" >
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_1"><i class="flaticon2-plus"></i> Nuevo</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Login</th>
                                <th>Imagen</th>
                                <th>Condicion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--begin::Modal-->
            <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 48% !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="htitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" onclick="hidemoldal();clear()" aria-label="Close">
                            </button>
                        </div>
                        <form class="kt-form kt-form--label-right" name="formulario" id="formulario" method="POST">
                            <div class="modal-body">
                                
                                    <div class="kt-portlet__body">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Nombre:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="hidden" class="form-control form-control-sm" id="idusuario" name="idusuario">
                                                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-user"></i></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label>Cargo:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <select class="form-control form-control-sm" id="cargo" name="cargo" required>
                                                        <option value="">Seleccione...</option>
                                                        <option value="Administrador">Administrador</option>
                                                        <option value="Secretaria">Secretaria</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                        <span><i class="la la-user"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                            </div>

                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Login:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                   <input type="text" class="form-control form-control-sm" id="login" name="login" required>
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-eyedropper"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                        

                                            <div class="col-lg-6">
                                                <label>password:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="password" class="form-control form-control-sm" id="clave" name="clave" required>
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-eyedropper"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-4 col-form-label">Logo</label>
                                            <div class="col-lg-8 col-xl-6">
                                                <div class="kt-avatar kt-avatar--outline kt-avatar--danger" id="kt_user_avatar_4" name="kt_user_avatar_4">
                                                    <div class="kt-avatar__holder" id="logovisor" name="logovisor" style="background-image: url(https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1024px-Circle-icons-profile.svg.png)"></div>
                                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Cambiar Image">
                                                        <i class="fa fa-pen"></i>
                                                        <input type="file" id="logo" name="logo" accept=".png, .jpg, .jpeg" >
                                                         <input type="hidden" name="logoactual" id="logoactual">
                                                    </label>
                                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel Image">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                                </div>
                                                <span class="form-text text-muted">Tipos de archivo permitidos:  png, jpg, jpeg.</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <label>Permisos:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <ul style="list-style: none;" id="permisos" required></ul>
                                                </div>
                                            </div>
                                        </div>



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
            <!--end::Modal-->

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
 <script type="text/javascript" src="scripts/usuario.js"></script>

