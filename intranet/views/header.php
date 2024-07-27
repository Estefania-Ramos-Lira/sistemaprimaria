<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />

    <title>PRIMARIA 21 DE AGOSTO | QR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="../resource/assets/js/viewbl.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link rel="stylesheet" href="../resource/assets/css/pages/wizard/wizard-4.css">

    <link href="../resource/assets/plugins/jquery-uiV1.12/jquery-ui-v1.12.1.css" rel="stylesheet" type="text/css" />
    <link href="../resource/assets/plugins/jquery-uiV1.12/demosstyle.css" rel="stylesheet" type="text/css" />
    <link href="../resource/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

    <link href="../resource/assets/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../resource/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../resource/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <link href="../resource/assets/plugins/galeria/jquery.lighter.css" rel="stylesheet" type="text/css" />
    <link href="../resource/assets/plugins/toastr.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="https://keenthemes.com/metronic/themes/metronic/theme/default/demo12/dist/assets/media/logos/favicon.ico" />

    <link href='../resource/assets/plugins/calendar@5/assets/demo-to-codepen.css' rel='stylesheet' />
    <link href='../resource/assets/plugins/calendar@5/npm/fullcalendar@5.2.0/main.min.css' rel='stylesheet' />


</head>
<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="#">
                <img alt="Logo" src="../resource/assets/media/logos/letrass.png" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>

            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>
    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <!-- begin:: Aside -->
            <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

            <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
                <!-- begin:: Aside -->
                <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                    <div class="kt-aside__brand-logo">
                        <a href="#">
                            <img alt="Logo" src="../resource/assets/media/logos/letrass.png">
                        </a>
                    </div>

                    <div class="kt-aside__brand-tools">
                        <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler"><span></span></button>
                    </div>
                </div>
                <!-- end:: Aside -->

                <!-- begin:: Aside Menu  kt-menu__item--active -->
                <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">

                        <ul class="kt-menu__nav ">

                        <?php 
                            if ($_SESSION['escritorio']==1){
                            echo ' <li class="kt-menu__item" aria-haspopup="true" id="mescritorio">
                                        <a href="escritorio.php" class="kt-menu__link ">
                                            <i class="kt-menu__link-icon flaticon2-architecture-and-city"></i>
                                            <span class="kt-menu__link-text">Escritorio</span>
                                        </a>
                                    </li>';
                            }
                        ?>
                           

                            <li class="kt-menu__section ">
                                <h4 class="kt-menu__section-text">Menu</h4>
                                <i class="kt-menu__section-icon flaticon-more-v2"></i>
                            </li>
                        
                        <?php
                         if ($_SESSION['calendar'] == 1) {
                            echo '<li class="kt-menu__item " aria-haspopup="true"  id="mcalendar">
                                <a href="calendar.php" class="kt-menu__link ">
                                    <i class="kt-menu__link-icon fas fa-calendar-alt"></i>
                                    <span class="kt-menu__link-text">Calendario</span>
                                </a>
                            </li>';
                        }
                        
                        if ($_SESSION['alumno'] == 1) {
                            echo '<li class="kt-menu__item " aria-haspopup="true" id="mpersonal">
                                <a href="persona.php" class="kt-menu__link ">
                                    <i class="kt-menu__link-icon fas fa-user-graduate"></i>
                                    <span class="kt-menu__link-text">Alumnos</span>
                                </a>
                            </li>';
                        }
                     ?>    


                        <?php 
                            if ($_SESSION['asistencias']==1){
                            echo ' <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="masistencias"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-layers-2"></i><span class="kt-menu__link-text">Asistencias</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">

                                            <li class="kt-menu__item " aria-haspopup="true" id="lasistencias">
                                                <a href="list_assistance.php" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                    <span class="kt-menu__link-text">Configuracion</span>

                                                </a>
                                            </li>

                                            <li class="kt-menu__item " aria-haspopup="true" id="lcheckout">
                                                <a href="check_out.php" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                    <span class="kt-menu__link-text">Finalizar Día</span>

                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>';
                            }

                        
                            if ($_SESSION['reportel']==1){
                                echo ' <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="mreportl"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-line-chart"></i><span class="kt-menu__link-text">Reportes</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
                                            
                                            
    
                                                <li class="kt-menu__item " aria-haspopup="true" id="ldgroup">
                                                    <a href="report_list_group.php" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                        <span class="kt-menu__link-text">Reporte General</span>
                                                    </a>
                                                </li>
                    
    
                                                <li class="kt-menu__item " aria-haspopup="true" id="ldgroupid">
                                                    <a href="report_list_group_id.php" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                        <span class="kt-menu__link-text">Reporte por Grupo</span>
                                                    </a>
                                                </li>
    
                                                <li class="kt-menu__item " aria-haspopup="true" id="lddni">
                                                    <a href="report_list_id.php" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                        <span class="kt-menu__link-text">Reporte Individual</span>
                                                    </a>
                                                </li>

                                                <li class="kt-menu__item " aria-haspopup="true" id="lgroup">
                                                        <a href="report_detalle_group.php" class="kt-menu__link ">
                                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                            <span class="kt-menu__link-text">Reporte Concetrado Por Periodo</span>
        
                                                        </a>
                                                    </li>
        


                                            </ul>
                                        </div>
                                    </li>';
                                }
    
    
                             /*   if ($_SESSION['reported']==1){
                                    echo ' <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="mreportd"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-line-chart"></i><span class="kt-menu__link-text">Reportes Detallado</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                <ul class="kt-menu__subnav">
        
        
                                                    <li class="kt-menu__item " aria-haspopup="true" id="lgroup">
                                                        <a href="report_detalle_group.php" class="kt-menu__link ">
                                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                            <span class="kt-menu__link-text">Grupo</span>
        
                                                        </a>
                                                    </li>
        
        
                                                    <li class="kt-menu__item " aria-haspopup="true" id="lgroupid">
                                                        <a href="report_detalle_group_id.php" class="kt-menu__link ">
                                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                            <span class="kt-menu__link-text">Grupo lista Individual</span>
                                                        </a>
                                                    </li>
        
                                                    <li class="kt-menu__item " aria-haspopup="true" id="ldni">
                                                        <a href="report_detalle_id.php" class="kt-menu__link ">
                                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                            <span class="kt-menu__link-text">IDALU</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>';
                                    }*/
    


                          /*   if ($_SESSION['seguridad']==1){
                            echo '<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="msecurity"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-download"></i><span class="kt-menu__link-text">Seguridad</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">

                                            <li class="kt-menu__item " aria-haspopup="true" id="lbackup">
                                                <a href="backup.php" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                    <span class="kt-menu__link-text">Backup</span>

                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>';
                            }*/
  
                            if ($_SESSION['codeqr']==1){
                                echo '<li class="kt-menu__item" aria-haspopup="true" id="mqr">
                                            <a href="qrcode.php" class="kt-menu__link ">

                                                <i class="kt-menu__link-icon fa fa-qrcode"></i>
                                                <span class="kt-menu__link-text">Consultar QR</span>
                                            </a>
                                        </li>';
                            }



                            if ($_SESSION['acceso']==1){
                                echo ' <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="macceso"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-safe-shield-protection"></i><span class="kt-menu__link-text">Acceso</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
    
                                                <li class="kt-menu__item " aria-haspopup="true" id="lusuario">
                                                    <a href="usuario.php" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                                        <span class="kt-menu__link-text">Usuarios</span>
    
                                                    </a>
                                                </li>
    
                                                
                                            </ul>
                                        </div>
                                    </li>';
                                }

                             // Nuevo botón para abrir en una nueva pestaña sin condición
                                echo '<li class="kt-menu__item" aria-haspopup="true" id="mlocal">
                                <a href="https://localhost/sistema_primaria/indexl.php" class="kt-menu__link " target="_blank">
                                    <i class="kt-menu__link-icon fa fa-link"></i>
                                    <span class="kt-menu__link-text">Escanear Códigos QR</span>
                                </a>
                                </li>';



                            if (!isset($_SESSION["idalumno"])){

                            }else{
                                echo '<li class="kt-menu__item" aria-haspopup="true" id="mviewpersonal">
                                            <a href="viewpersonal.php" class="kt-menu__link ">

                                                <i class="kt-menu__link-icon fa fa-qrcode"></i>
                                                <span class="kt-menu__link-text">view alumno</span>
                                            </a>
                                    </li>';    
                            }
                        ?>                            


                        </ul>
                    </div>
                </div>
                <!-- end:: Aside Menu -->

            </div>
            <!-- end:: Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                    <!-- begin: Header Menu -->
                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

                        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                            <ul class="kt-menu__nav ">
                            <?php 
                            //if ($_SESSION['calendar']==1){ 
                              //  echo '<li class="kt-menu__item " aria-haspopup="true"  id="mcalendar"><a href="calendar.php" class="kt-menu__link "><span class="kt-menu__link-text">Calendario</span> </a> </li>';
                            //}                       

                            //if ($_SESSION['alumno']==1){ 
                              //  echo '<li class="kt-menu__item " aria-haspopup="true" id="mpersonal"><a href="persona.php" class="kt-menu__link "><span class="kt-menu__link-text">Alumnos</span></a></li>';
                            //}

                            //if ($_SESSION['institucion']==1){ 
                              //  echo '<li class="kt-menu__item " aria-haspopup="true" id="mentity"><a href="entity.php" class="kt-menu__link " ><span class="kt-menu__link-text">Institucion</span></a></li>';
                            //}
                            ?> 
                            </ul>
                        </div>
                    </div>
                    <!-- end: Header Menu -->
                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">
                        <!--begin: Search -->
                        <!--begin: Search -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                               <!-- <span class="kt-header__topbar-icon">-->
                                 <!--  <i class="flaticon2-search-1"></i>-->
                               </span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                                <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact" id="kt_quick_search_dropdown">
                                    <form method="get" class="kt-quick-search__form">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                                            <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
                                            <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
                                        </div>
                                    </form>
                                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search -->
                        <!--begin: Notifications -->

                        <div class="kt-header__topbar-item dropdown">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
                                <!--<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">-->
                                <!--<i class="flaticon2-bell-alarm-symbol"></i>-->
                                <!-- <span class="kt-pulse__ring"></span>-->
                                </span>
                            </div>
                        </div>
                        <!--end: Notifications -->

                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                                <div class="kt-header__topbar-user">
                                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hola,</span>
                                    <span class="kt-header__topbar-username kt-hidden-mobile"><?php echo $_SESSION['nombre']; ?></span>

                                    <?php if (!isset($_SESSION["idpersonal"])){
                                    echo '<img alt="Pic" class="kt-radius-100" src="../resource/files/usuarios/'.$_SESSION['imagen'].'"/>';
		                            }else{
		                            echo '<img alt="Pic" class="kt-radius-100" src="../resource/files/logo/user.jpeg"/>';
									}?>

                                </div>
                            </div>

                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                                <!--begin: Head -->
                                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(../resource/assets/media/misc/bg-1.jpg)">
                                    <div class="kt-user-card__avatar">
                                        <img class="kt-hidden" alt="Pic" src="../resource/assets/media/users/300_25.jpg" />
                                       
                                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
									<?php if (!isset($_SESSION["idpersonal"])){
									echo '<img alt="Pic" class="kt-radius-100" src="../resource/files/usuarios/'.$_SESSION['imagen'].'" />';
									}else{
									echo '<img alt="Pic" class="kt-radius-100" src="../resource/files/logo/user.jpeg"/>';
									}?>
                                        </span>
                                    </div>
                                    <div class="kt-user-card__name">
                                    <?php echo $_SESSION['nombre']; ?>
                                    </div>
                                    <div class="kt-user-card__badge">
                                        <span class="btn btn-success btn-sm btn-bold btn-font-md"><?php echo $_SESSION['cargo']; ?></span>
                                    </div>
                                </div>
                                <!--end: Head -->

                                <!--begin: Navigation -->
                                <div class="kt-notification">
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="usuario.php"  class="btn btn-clean btn-sm btn-bold">Actualizar</a>

                                        <a href="../controllers/usuario.php?op=salir"  class="btn btn-label btn-label-brand btn-sm btn-bold">Cerrar</a>
                                    </div>
                                </div>
                                <!--end: Navigation -->
                            </div>
                        </div>
                        <!--end: User Bar -->

                    </div>
                    <!-- end:: Header Topbar -->
                </div>
                <!-- end:: Header -->

                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                    <!-- begin:: Subheader -->
                    <div class="kt-subheader   kt-grid__item" id="kt_subheader">

                    </div>
                    <!-- end:: Subheader -->