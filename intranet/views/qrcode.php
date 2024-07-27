<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

    if ($_SESSION['codeqr']==1)
    {
?>


<style>
.post-title { font-size:20px; }
.mtb-margin-top { margin-top: 20px; }
.top-margin { border-bottom:2px solid #ccc; margin-bottom:20px; display:block; font-size:1.3rem; line-height:1.7rem;}
.btn-success {
  cursor:pointer;
}
.qrdiv {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #7b97a6;
  border-radius: 10px;
}
.loading {
  background-image: url('../resource/files/load/loader.gif');
  background-repeat: no-repeat;
  background-position: center;
  width: 100%;
  height: 100%;
}
</style>
<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">


<div class="row">
    
    <div class="col-xl-5 col-lg-5">
        <div class="kt-portlet">
            <div class="kt-portlet__head" style="min-height:40px; background-color: #14443A;">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title" style="color: #FFFFFF">
                       <i class="kt-menu__link-icon fa fa-qrcode"></i>  CONSULTAR QR-CODE
                    </h3>
                </div>
            </div>
                <div class="kt-portlet__body">

                                          <form class="form-horizontal" name="formulario" id="formulario" method="POST" >
                                              <div class="form-group">
                                                <label class="control-label">Digite IDALU : </label>
                                                <textarea class="form-control col-xs-12" name="dataContent" id="dataContent"  placeholder="Ejemplo: 247584561" onkeypress="return soloNumeros(event);" maxlength="9"></textarea>
                                                
                                              </div>

                                             <!-- <div class="form-group">-->   
                                                <!--<label class="control-label">Calidad : </label>-->   
                                                <!--<select class="form-control col-xs-12" name="calidad" id="calidad"  data-live-search="true">-->   
                                                  <!--<option value="H">H</option>-->   
                                                  <!--<option value="M">M</option>-->
                                                  <!--<option value="Q">Q</option>-->
                                                  <!--<option value="L">L</option>-->                       
                                                <!--</select>-->   
                                              <!--</div>-->   

                                          

                                              <div class="form-group">
                                                <label class="control-label">Tamaño : </label>
                                                <input type="number" min="1" max="15" step="1" class="form-control col-xs-12" name="size" id="size" value="14">
                                              </div>

                                              <div class="form-group row">
                                                    <div class="col-lg-12">
                                                        <!-- Campo de texto oculto que enviará "Estudiante" al servidor -->
                                                        <input type="hidden" name="calidad" value="H">
                                                    </div>
                                                </div>

                                              <div class="form-group">
                                                <label class="control-label"></label>
                                                <button type="submit" id="btnSave" class="btn btn-success" >Generar</button>
                                              
                                              </div>
                                          </form>

                </div>

        </div>
    </div>

    <div class="col-xl-7 col-lg-7">
        <div class="kt-portlet">

            <div class="kt-portlet__body" >
                        <div class="kt-section">
                            <div class="kt-section__content">
                                 
                                <div class="table-responsive" >
                                    <div class="qrdiv loading thumbnail well" style="height: 366px;"></div>
                                    <div class="text-center">
                                      <button type="button" id="btnDownload" class="btn btn-primary" style="margin-top: 10px;">Descargar QR</button>
                                </div>
                            </div>
                            
                         </div>
            </div>

        </div>    
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



<script type="text/javascript" src="scripts/qr_code.js"></script>