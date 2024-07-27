<?php include 'header.php'; ?>
<style type="text/css" media="screen">
.ui-autocomplete {
    z-index: 5000;
}  
</style>
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                         Justificaciones
                     </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-toolbar-wrapper">
                                <div class="dropdown dropdown-inline">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable table-sm" id="kt_table_1">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Alumno</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>DATOS I</th>
                                    <th>DATOS II</th>
                                    <th>FECHA</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                            <tfoot>
                            </tfoot>
                        </table>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require 'footer.php'; ?>

        <script type="text/javascript" src="scripts/report_justification.js"></script>

        