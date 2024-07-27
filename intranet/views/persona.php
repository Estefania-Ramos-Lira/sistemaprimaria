<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

    if ($_SESSION['alumno']==1)
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
                         Listado de Estudiantes
                     </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-toolbar-wrapper">
                                <div class="dropdown dropdown-inline">

                                    <button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_1"><i class="flaticon2-plus" ></i> Nuevo</button>

                                    <button type="button" class="btn btn-brand btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon2-fax"></i> Exportar
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">

                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_print">
                                                    <i class="kt-nav__link-icon fa fa-print" style="color: red; "></i>
                                                    <span class="kt-nav__link-text">Imprimir</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_excel">
                                                    <i class="kt-nav__link-icon fa fa-file-excel" style="color: green;"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </a>
                                            </li>

                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_qr" data-toggle="modal" data-target="#kt_modal_5">
                                                    <i class="kt-nav__link-icon fa fa-qrcode" style="color: black;"></i>
                                                    <span class="kt-nav__link-text">Gafete</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
                                    <th>Idalu</th>
                                    <th>Curp</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Grado</th>
                                    <th>Grupo</th>                          
                                    <th>Grados Preescolar</th>
                                    <th>Nacimiento</th>
                                    <th>Edad Estadistica</th>
                                    <th>Edad Siceeo</th>
                                    <th>Necesidades Especiales</th> 
                                    <th>Nombre tutor</th>
                                    <th class="not-export">Qr</th>
                                    <th>Estado</th>
                                    <th class="not-export" nowrap>Accion</th>                                    
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

                <!--begin::Modal-->
                <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="kt-portlet kt-portlet--tabs" style="margin-bottom: 0px;">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-toolbar">
                                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                                            <li class="nav-item">
                                                <div id="idtitle" role="tab" aria-selected="true" style="font-size: 16px; color: blue; display: flex; align-items: center;">
                                                        <i class="fa fa-user-plus" aria-hidden="true" style="margin-right: 5px;"></i>
                                                        AGREGAR ESTUDIANTE
                                                    </div>
                                            </li>
                                            <li class="nav-item" >
                                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_2_tab_content" role="tab" aria-selected="false" id="limport">
                                                    <!-- BOTON DE IMPORTAR <i class="fa fa-file-upload" aria-hidden="true" ></i>IMPORTAR-->
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                     <a href="" class="close" data-dismiss="modal"  aria-label="Close">  <i class="la la-close" aria-hidden="true"></i></a>
                                 </h3>
                                    </div>
                                </div>

                                <div class="kt-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_portlet_base_demo_2_3_tab_content" role="tabpanel">
                                            <form class="kt-form kt-form--label-right " name="formulario" id="formulario" method="POST">
                                                <div class="kt-portlet__body" style="padding: 8px;">

                                                

                                                  <!--  <div class="form-group row"> -->
                                                      <!--  <div class="col-lg-12"> -->
                                                          <!--  <label for="exampleSelects">Seleccione:</label> -->
                                                          <!--  <select class="form-control form-control-sm" name="tipo_alumno" id="tipo_alumno" required> -->
                                                          <!--   <option value=""></option> -->
                                                            <!--    <option value="Estudiante">Estudiante</option> -->
                                                            <!--    <option value="Docente">Docente</option> -->
                                                            <!--    <option value="Administrativo">Administrativo</option> -->
                                                            <!--    <option value="Otros">Otros</option> -->
                                                        <!--     </select> -->
                                                      <!--  </div> -->
                                                  <!--   </div> -->
                                                  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                  <link rel="stylesheet" href="sugerencias.css">
                                                            


                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label>IDALU: *</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="idalu" id="idalu" onkeypress="return soloNumeros(event);" maxlength="9" required>
                                                                <input type="hidden" name="dnimg" id="dnimg" maxlength="100">
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                    <span><i class="la la-eyedropper"></i></span>
                                                                </span>
                                                            </div>
                                                            <span id="idalu-warning" class="custom-text-danger" style="display: none;">El idalu ya se encuentra registrado</span>
                                                        </div>
                                                    

                                                    <div class="col-lg-6">
                                                            <label>CURP: *</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="curp" id="curp" onkeyup="mayus(this);" pattern="^[A-Z]{4}\d{6}[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9][0-9]$" title="La CURP debe tener el formato correcto: 4 letras, 6 números, H/M, 6 letras y 1 número " maxlength="18" required>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                   <span><i class="la la-user"></i></span>
                                                                </span>
                                                            </div>
                                                            <div id="curp-validacion"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label>Nombre: *</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="nombre" id="nombre" onkeyup="mayus(this);" onkeypress="return soloLetras(event);" required>
                                                                <input type="hidden" name="idalumno" id="idalumno" maxlength="100">
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                   <span><i class="la la-user"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label>Apellidos: *</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="apellidos" id="apellidos" onkeyup="mayus(this);" onkeypress="return soloLetras(event);" required>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                   <span><i class="la la-user"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    

                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label id="lbldatos1"></label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <select class="form-control form-control-sm" name="datos1" id="datos1" required>
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                </select>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                    <span><i class="la la-eyedropper"></i></span>
                                                                </span>
                                                            </div>
                                                        
                                                    </div>

                                                        <div class="col-lg-6">
                                                            <label id="lbldatos2"></label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <select class="form-control form-control-sm" name="datos2" id="datos2" required>
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                </select>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                    <span><i class="la la-eyedropper"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label>Grados Preescolar:</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <select class="form-control form-control-sm" name="gpreescolar" id="gpreescolar">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                </select>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left"> 
                                                                    <span><i class="la la-user"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label>Necesidades Especiales: *</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <select class="form-control form-control-sm" onchange="toggleTextInput(this.value)" id="nespecialesSelect" required>
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="NO">NO</option>
                                                                    <option value="SI">SI</option>
                                                                </select>
                                                                <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="nespeciales" id="nespecialesText" style="display: none;" onkeyup="mayus(this);" onkeypress="return soloLetras(event);" oninput="checkEmpty(this)" required>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                    <span><i class="la la-user"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>                                               

                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                            <label>Fecha de Nacimiento: *</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <input type="date" class="form-control form-control-sm" placeholder="Seleccione una fecha..." name="nacimiento" id="nacimiento" placeholder="dd/mm/yyyy" required>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                    <span><i class="la la-calendar"></i></span>
                                                                </span>
                                                            </div>
                                                            <div id="nacimiento-warning" class="custom-text-danger" style="display: none;">Advertencia: La fecha de nacimiento seleccionada es menor a 5 años.</div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label>Edad Estadistica:</label>
                                                                <div class="kt-input-icon kt-input-icon--left">
                                                                    <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="edadestadistica" id="edadestadistica" readonly>
                                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                        <span><i class="la la-user"></i></span>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        <div class="col-lg-6">
                                                            <label>Edad Siceeo:</label>
                                                            <div class="kt-input-icon kt-input-icon--left">
                                                                <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="edadsiceeo" id="edadsiceeo" readonly>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                   <span><i class="la la-user"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                            <label>Nombre Tutor:</label>
                                                            <div class="kt-input-icon kt-input-icon--left suggestions-container">
                                                                <input type="text" class="form-control form-control-sm" placeholder="Digite..." name="nombretutor" id="nombretutor" onkeyup="mayus(this);" onkeypress="return soloLetras(event);">
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                    <span><i class="la la-eyedropper"></i></span>
                                                                </span>
                                                                <div id="tutorSuggestions" class="suggestion-list"></div>
                                                            </div>
                                                        </div>
                                                    </div>                                            
                                                                                                        
                                                                                                                         
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                            <!-- Campo de texto oculto que enviará "Estudiante" al servidor -->
                                                            <input type="hidden" name="tipo_alumno" id="tipo_alumno" value="Estudiante">
                                                        </div>
                                                    </div>


                                                </div>
                                                
                                                <div class="modal-footer">                 
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarCampos(); hidemoldal();">Cerrar</button>
                                                    <button type="submit" id="btnGuardar" class="btn btn-primary" onclick="limpiarValidacionCURP()">Guardar</button>    

                                                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hidemoldal()">Cerrar</button>-->
                                                   <!-- <button type="submit" id="btnGuardar" class="btn btn-primary" onclick="limpiarValidacionCURP()">Guardar</button>-->
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane" id="kt_portlet_base_demo_2_2_tab_content" role="tabpanel">

                                            <!--begin::Form-->
                                            <form class="kt-form" name="formulario_import" id="formulario_import" method="POST">
                                                <div class="kt-portlet__body" style="padding: 8px;">
                                                    <div class="form-group">
                                                        <label>Archivo delimitado por comas (,) con extision .CSV </label>
                                                        <div></div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="customFile" onchange="return validarExt(this)" required>
                                                            <label class="custom-file-label" id="custom-file-label" for="customFile">Elegir archivo</label>
                                                        </div>
                                                        <div id="resultados"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hidemoldal()">Cancel</button>
                                                    <button type="submit" id="savecsv" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                            <!--end::Form-->
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--begin::Modal-->
                <div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabeld">GAFETE | CREDENCIAL</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-3">
                                        <input class="form-control" type="color" value="#152F52" id="cardheader" name="cardheader" data-skin="brand" data-toggle="kt-tooltip" data-placement="top" title="Color de header">
                                    </div>

                                    <div class="col-3">
                                        <input class="form-control" type="color" value="#FFFFFF" id="cardtextheader" name="cardtextheader" data-skin="brand" data-toggle="kt-tooltip" data-placement="top" title="Color de texto">
                                    </div>

                                    <div class="col-3">
                                        <input class="form-control" type="color" value="#14BFD9" id="cardbody" name="cardbody" data-skin="brand" data-toggle="kt-tooltip" data-placement="top" title="Color de body">
                                    </div>

                                    <div class="col-3">
                                        <input class="form-control" type="color" value="#FFFFFF" id="cardtextbody" name="cardtextbody" data-skin="brand" data-toggle="kt-tooltip" data-placement="top" title="Color de texto">
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label for="exampleSelects">Seleccione:</label>
                                    <select class="form-control form-control-sm" id="cboSelects" name="cboSelects" required>
                                        <option value=""></option>
                                        <option value="Estudiante">Grado y Grupo</option>
                                        <!--<option value="Docente">Docente</option>-->
                                        <!--<option value="Administrativo">Administrativo</option>-->
                                        <!--<option value="Otros">Otros</option>-->
                                        <option value="Identificacion">N° de Idalu</option>
                                    </select>
                                </div>
                                
                                <div class="form-group divcard divcard1">
                                    <label id="lblcard1" name="lblcard1">Grado:</label>
                                    <select class="form-control form-control-sm" id="card1" name="card1" required>
                                        <option value="">Selecciona el grado</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    </div>

                                <div class="form-group divcard divcard1">
                                    <label id="lblcard2" name="lblcard2">Grupo:</label>
                                    <select class="form-control form-control-sm" id="card2" name="card2" required>
                                        <option value="">Selecciona el grupo</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <!-- Agrega más opciones según los grupos disponibles -->
                                    </select>
                                </div>  
                                <div class="form-group divcard divcard2">
                                    <label id="lblcard3" name="lblcard3"></label>
                                    <input type="text" class="form-control form-control-sm" id="identificacion" name="identificacion" placeholder="Digite.." onkeypress="return soloNumeros(event);" maxlength="9" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="cardpdf()" id="card-execute" name="card-execute">Generar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Modal-->

            </div>

        </div>
    </div>

    <?php 
require 'footer.php'; 
    }else{
        require 'error.html';
    }
}
ob_end_flush();

?>

<script type="text/javascript" src="scripts/persona.js"></script>


        