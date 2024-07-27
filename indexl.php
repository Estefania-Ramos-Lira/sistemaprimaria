<script type="text/javascript">
document.oncontextmenu = function(){return false;}
</script>


<?php 

 require_once "intranet/models/welcome.php";
 $DBobj = new Entity();

  $rspta = $DBobj->listar();
  $reg=$rspta->fetch_object();
  $nombre=$reg->nombre;

 ?>


<!DOCTYPE html>

<html lang="en">
    
    <head><meta charset="euc-kr">
        

        <title>PRIMARIA 21 DE AGOSTO | QR</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="intranet/resource/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

        <link href="intranet/resource/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="intranet/resource/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        
        <link rel="stylesheet" type="text/css" href="intranet/resource/assets/js/js/style.css" />
        <link rel="stylesheet" type="text/css" href="intranet/resource/assets/js/js/fontstyle.css" />

        <style type="text/css" media="screen">
            input[type="range"] {
                display: block;
                width: 100%;
            }

            input[type="text"] {
                display: block;
                width: 100%;
            }
        </style>
    </head>


    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

        <div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed">
            <div class="kt-header-mobile__logo">
                <a href="#">
                   <!-- <img alt="Logo" src="intranet/resource/assets/media/logos/logo-12.png" /> -->
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">

                <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>

        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" style="padding-left: 0px;">

                    <div id="kt_header" class="kt-header kt-grid__item kt-header--fixed" style="left: 0px;">

                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile kt-header-menu--layout-default">
                                <ul class="kt-menu__nav">
                                    <li class="kt-menu__item" aria-haspopup="true">
                                        <a class="kt-menu__link">
                                            <span class="kt-menu__link-text">
                                                <h1 style="color: #ffffff;">
                                                    <strong> <marquee> CONTROL DE ASISTENCIA - <?php echo $nombre; ?></marquee></strong>
                                                </h1>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="kt-header__topbar">
                            <div class="kt-header__topbar-item dropdown">
                                <div class="kt-header__topbar-wrapper" data-offset="30px,0px" aria-expanded="true">
                                    <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand kt-menu__link-text">
                                        <a href="intranet/" target="_blank" class="kt-menu__link"><i class="flaticon-users-1"></i></a>
                                        <span class="kt-pulse__ring"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <div class="kt-subheader kt-grid__item" id="kt_subheader"></div>

                        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                            <div class="row">
                                <div class="col-md-1"></div>

                                <div class="col-md-4">
                                    <div class="kt-portlet">
                                        <form name="form_identification" id="form_identification">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label" style="width: 100%;">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="identificacion" id="identificacion" placeholder="Ingrese Idalu" autofocus="autofocus" />
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit" id="btnSave"><i style="color: #ffffff;" class="la la-check"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="kt-portlet__body">
                                            <div class="kt-pricing-1 kt-pricing-1--fixed">
                                                <div class="kt-pricing-1__items row">
                                                    <div class="kt-pricing-1__item col-lg-12" style="text-align: center;">
                                                        <div class="well" style="position: relative; display: inline-block;">
                                                            <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                                                            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                                                        </div>

                                                        <div class="" style="width: 100%; padding: 0px; margin-top: -8px;">
                                                            <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20" />
                                                        </div>
                                                        <!-- BUTTOOM HIDE -->
                                                        <div class="" style="width: 100%;">
                                                            <select class="form-control" id="camera-select" style="width: 100%;"></select>
                                                            <div class="form-group" style="display: none;">
                                                                <input id="image-url" type="text" class="form-control" placeholder="Image url" />
                                                                <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-upload"></span></button>
                                                                <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-picture"></span></button>
                                                                <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                                                                <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"></span></button>
                                                                <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>
                                                            </div>
                                                        </div>

                                                        <!-- ZOOM HIDE -->
                                                        <div class="well" style="width: 100%; display: none;">
                                                            <label id="zoom-value" width="100">Zoom: 2</label>
                                                            <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20" />
                                                            <label id="brightness-value" width="100">Brightness: 0</label>
                                                            <input id="brightness" onchange="Page.changeBrightness();" type="range" min="0" max="128" value="0" />
                                                            <label id="contrast-value" width="100">Contrast: 0</label>
                                                            <input id="contrast" onchange="Page.changeContrast();" type="range" min="0" max="64" value="0" />
                                                            <label id="threshold-value" width="100">Threshold: 0</label>
                                                            <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0" />
                                                            <label id="sharpness-value" width="100">Sharpness: off</label>
                                                            <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox" />
                                                            <label id="grayscale-value" width="100">grayscale: off</label>
                                                            <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox" />
                                                            <br />
                                                            <label id="flipVertical-value" width="100">Flip Vertical: off</label>
                                                            <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox" />
                                                            <label id="flipHorizontal-value" width="100">Flip Horizontal: off</label>
                                                            <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="kt-portlet">
                                        <div class="kt-portlet__head" style="background-color: #201f2b;">
                                            <div class="wrap">
                                                <div class="widget" style="margin-top: 1rem; text-align: left;">
                                                    <div class="fecha">
                                                        <!-- <p id="diaSemana" class="diaSemana"></p> -->
                                                        <p id="dia" class="dia"></p>
                                                        <p>-</p>
                                                        <p id="mes" class="mes"></p>
                                                        <p>-</p>
                                                        <p id="year" class="year"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="reloj widget" style="text-align: right;">
                                                <p id="horas" class="horas"></p>
                                                <p>:</p>
                                                <p id="minutos" class="minutos"></p>
                                                <p>:</p>
                                                <p id="mes" class="mes"></p>
                                                <p id="segundos" class="segundos"></p>
                                                <p id="ampm" class="ampm"></p>
                                            </div>
                                        </div>

                                        <div class="kt-portlet__body">
                                            <div class="kt-pricing-1 kt-pricing-1--fixed">
                                                <div class="kt-pricing-1__items row">
                                                    <div class="kt-pricing-1__item col-lg-12">
                                                        <!--begin: Datatable -->
                                                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1" class="kt_table_1" style="color: #000000;">
                                                            <thead style="background-color: #14443a;">
                                                                <th>Nombres</th>
                                                                <th>Apellidos</th>
                                                                <th>Entrada</th>
                                                                <th>Salida</th>                                                      
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                        <!--end: Datatable -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <!--end::Portlet-->
                            </div>
                        </div>
                        <!-- end:: Content -->
                    </div>

                    <!-- begin:: Footer -->
                    <div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-container kt-container--fluid">
                             <div class="kt-footer__copyright">&nbsp;&copy;&nbsp;Primaria 21 de Agosto</div>
                            <div class="kt-footer__menu">
                                <!--<a href="https://wa.me/" target="_blank" class="kt-footer__menu-link kt-link"><i class="fab fa-whatsapp" style="color: green; font-size: 18px;"></i> WhatsApp</a>
                                <a href="https://web.facebook.com/" target="_blank" class="kt-footer__menu-link kt-link"><i class="fab fa-facebook" style="color: #2467ba; font-size: 18px;"></i> Facebook</a>
                                <a href="http://www.youtube.com/ target="_blank" class="kt-footer__menu-link kt-link"><i class="fab fa-youtube" style="color: red; font-size: 18px;"></i> Youtube</a>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Footer -->
                </div>
            </div>
        </div>
        <!-- end:: Page -->
        <audio id="audio" controls style="display: none;"><source src="intranet/resource/assets/js/js/beep.mp3" type="audio/mp3" /></audio>
        <audio id="error" controls style="display: none;"><source src="intranet/resource/assets/js/js/error.mp3" type="audio/mp3" /></audio>
        <audio id="desconocido" controls style="display: none;"><source src="intranet/resource/assets/js/js/desconocido_pilar.mp3" type="audio/mp3" /></audio>
        <audio id="entrada" controls style="display: none;"><source src="intranet/resource/assets/js/js/entrada_pilar.mp3" type="audio/mp3" /></audio>
        <audio id="salida" controls style="display: none;"><source src="intranet/resource/assets/js/js/salida_pilar.mp3" type="audio/mp3" /></audio>
        <audio id="idden" controls style="display: none;"><source src="intranet/resource/assets/js/js/identificacion_pilar.mp3" type="audio/mp3" /></audio>
        <audio id="yamarco" controls style="display: none;"><source src="intranet/resource/assets/js/js/yaregistro_pilar1.mp3" type="audio/mp3" /></audio>

        <audio id="falta" controls style="display: none;"><source src="intranet/resource/assets/js/js/falta.mp3" type="audio/mp3" /></audio>
        <audio id="justificacion" controls style="display: none;"><source src="intranet/resource/assets/js/js/justification.mp3" type="audio/mp3" /></audio>

        <script>
            var KTAppOptions = {
                colors: {
                    state: {
                        brand: "#2c77f4",
                        light: "#ffffff",
                        dark: "#282a3c",
                        primary: "#5867dd",
                        success: "#34bfa3",
                        info: "#36a3f7",
                        warning: "#ffb822",
                        danger: "#fd3995",
                    },
                    base: {
                        label: ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        shape: ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"],
                    },
                },
            };
        </script>

        <script src="intranet/resource/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
        <script src="intranet/resource/assets/js/scripts.bundle.js" type="text/javascript"></script>
        <script src="intranet/resource/assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
        <script src="intranet/resource/assets/js/pages/components/extended/sweetalert2d.js" type="text/javascript"></script>
        <script src="intranet/views/scripts/form_id.js" type="text/javascript"></script>

        <script type="text/javascript" src="intranet/resource/assets/js/js/filereader.js"></script>
        <script type="text/javascript" src="intranet/resource/assets/js/js/qrcodelib.js"></script>
        <script type="text/javascript" src="intranet/resource/assets/js/js/webcodecamjquery.js"></script>
        <script type="text/javascript" src="intranet/resource/assets/js/js/mainjquery.js"></script>
        <script type="text/javascript" src="intranet/resource/assets/js/js/reloj.js"></script>

    </body>
</html>


