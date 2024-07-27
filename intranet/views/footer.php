</div>

                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            &nbsp;&copy;&nbsp;Primaria 21 de Agosto, Fraccionamiento CD.Yagul, Tlacolula de Matamoros, Oaxaca
                        </div>
                        <div class="kt-footer__menu">
                           <!-- <a href="https://wa.me/" target="_blank" class="kt-footer__menu-link kt-link"><i class="fab fa-whatsapp" style="color: green;font-size: 18px;"></i> WhatsApp</a>
                            <a href="https://web.facebook.com/" target="_blank" class="kt-footer__menu-link kt-link"><i class="fab fa-facebook" style="color: #2467BA;font-size: 18px;"></i> Facebook</a>
                            <a href="http://www.youtube.com/" target="_blank" class="kt-footer__menu-link kt-link"><i class="fab fa-youtube" style="color: red;font-size: 18px;"></i> Youtube</a>
                            
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>
    <!-- end:: Page -->


    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#2c77f4",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>

    <script src="../resource/assets/plugins/jquery-uiV1.12/jquery-1.12.4.js"></script>
    <script src="../resource/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="../resource/assets/plugins/jquery-uiV1.12/jquery-ui-v1.12.1.js"></script>
    <script src="../resource/assets/js/scripts.bundle.js" type="text/javascript"></script>
    

    <script src="../resource/assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="../resource/assets/js/pages/components/extended/sweetalert2d.js" type="text/javascript"></script>
    <script src="../resource/assets/plugins/galeria/jquery.lighter.js" type="text/javascript"></script>

    <script src="../resource/assets/js/pages/crud/file-upload/ktavatar.js" type="text/javascript"></script>
     
    <script src="../resource/assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js" type="text/javascript"></script>



    <script src="../resource/assets/js/VentanaCentrada.js" type="text/javascript" ></script>
    <script src="../resource/assets/plugins/other/blomayus.js" type="text/javascript"></script>
    <script src="../resource/assets/plugins/toastr.js" type="text/javascript"></script>
    <script src="../resource/assets/plugins/chartjs/chart.min.js" type="text/javascript"></script>

    <script src='../resource/assets/plugins/calendar@5/npm/fullcalendar@5.2.0/main.min.js'></script>
    <script src='../resource/assets/plugins/calendar@5/npm/fullcalendar@5.2.0/locales-all.js'></script>
    <script src='../resource/assets/plugins/calendar@5/assets/demo-to-codepen.js'></script> 

    <script src='../resource/assets/plugins/calendar@5/dist/umd/popper.min.js'></script>
    <script src='../resource/assets/plugins/calendar@5/dist/umd/tooltip.min.js'></script> 

    <script src="../resource/assets/plugins/amcharts/core.js"></script>
    <script src="../resource/assets/plugins/amcharts/charts.js"></script>
    <script src="../resource/assets/plugins/amcharts/animated.js"></script> 


</body>

</html>


<script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 showAnim:'clip',
 firstDay: 1,
 isRTL: false,
 changeMonth:true,
 changeYear:true,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);


$(function () {
$(".date").datepicker();
});

</script>