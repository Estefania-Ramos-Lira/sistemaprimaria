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
                                Listado de Permisos
                            </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar" >
                        <div class="dropdown dropdown-inline">

                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable table-sm" id="kt_table_2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    <!--end: Datatable -->
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

<script type="text/javascript" src="scripts/permiso.js"></script>