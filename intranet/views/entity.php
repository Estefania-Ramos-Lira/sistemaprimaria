<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

    if ($_SESSION['institucion']==1)
    {
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Configuracions</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                
                                <th>Nombre</th>
                                <th>Avenida</th>
                                <th>Municipio</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Año</th>
                                <th>Logo</th>
                                <th>Accion</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!--begin::Modal-->
            <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 48% !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS</h5>
                            <button type="button" class="close" data-dismiss="modal" onclick="hidemoldal();" aria-label="Close">
                            </button>
                        </div>
                        <form class="kt-form kt-form--label-right" name="formulario" id="formulario" method="POST">
                            <div class="modal-body">
                                <form class="kt-form kt-form--label-right"  name="formulario" id="formulario" method="POST">
                                    <div class="kt-portlet__body">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>Entidad:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" placeholder="Digite..."  onkeyup="mayus(this);">
                                                    <input type="hidden" id="idinstitucion" name="idinstitucion">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-user"></i></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>avenida:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" id="avenida" name="avenida" class="form-control form-control-sm" placeholder="Digite...">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-user"></i></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>municipio:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" id="municipio" name="municipio" class="form-control form-control-sm" placeholder="Digite...">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-eyedropper"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>ciudad:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" id="ciudad" name="ciudad" class="form-control form-control-sm" placeholder="Digite...">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-eyedropper"></i></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>estado</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" id="estado" name="estado" class="form-control form-control-sm" placeholder="Digite...">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-eyedropper"></i></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>Año</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" id="anio" name="anio" class="form-control form-control-sm" placeholder="Digite...">
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
                                        
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hidemoldal()">Cerrar</button>
                                <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
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
<script type="text/javascript" src="scripts/entity.js"></script>