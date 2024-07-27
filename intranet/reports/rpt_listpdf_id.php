<?php
date_default_timezone_set('America/Regina');
ob_start();
require_once __DIR__ . '/../resource/domPdf/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $date_star= $_REQUEST['date_star'];
    $date_end= $_REQUEST['date_end'];
    $idalumno= $_REQUEST['idalumno']; 

$aniostar= date("Y", strtotime($date_star));
$messtar= date("m", strtotime($date_star));
$diastar= date("d", strtotime($date_star));

$anioend= date("Y", strtotime($date_end));
$mesend= date("m", strtotime($date_end));
$diaend= date("d", strtotime($date_end));


$meses = array('ENERO',"FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
$mes_star= date("m", strtotime($date_star));
$mes_end= date("m", strtotime($date_end));


$fecha_star=$meses[date($mes_star)-1];
$fecha_end=$meses[date($mes_end)-1];

require_once '../models/Reportsheet_id.php';

$DBobj=new Reportsheet();


$obj = $DBobj->listar();
$rows=$obj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;

$IMG ='../resource/files/logo/'.$logo; 

$rspta = $DBobj->listarall($date_star,$date_end,$idalumno);

$rspta_alumno = $DBobj->listarall($date_star,$date_end,$idalumno);
$row_alumno=$rspta_alumno->fetch_object();
$datos1=$row_alumno->datos1; 
$datos2=$row_alumno->datos2;


$pdf=''; 
$pdf.=' 
<link rel="stylesheet" href="css/pdftime.css"> 


<!-- Logos de la escuela y otra institución -->
<div style="position: relative; margin-bottom: 20px;">
    <img src="../resource/files/logo/logosep.png" style="width: 300px; height: auto; margin-right: 427px;">
    <img src="../resource/files/logo/logo2.png" style="width: 300px; height: auto;">
</div> 




<table class="txtheader" style="font-size: 9pt; margin-top: 18px;">
                <tr>
                  <td style="width:10%;" rowspan="3"><img class="radius_img" src="'.$IMG.'" alt=""></td>
                  <td style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">'.$institucion.'</td>
                </tr>
                <tr>
                  <td  style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">LISTADO DE ASISTENCIAS</td>
                </tr>
                <tr>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">GRADO</td>
                  <td style="text-align: left;">'.$datos1.'</td>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">GRUPO</td>
                  <td style="text-align: left;">'.$datos2.'</td>
                </tr>
</table><br>

<table style="font-size: 8pt;">
    <tr id="header">
      <td colspan="5" style="text-align:center;">DATOS DEL ALUMNO</td>
      <td colspan="5" style="text-align:center;">'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
    </tr>
    <tr id="header">
      <td>ID</td>
      <td>IDALU</td>
      <td>CURP</td>  
      <td>APELLIDOS</td>
      <td>NOMBRE</td>
      <td>GRADO</td>
      <td>GRUPO</td>
      <td>FECHA</td>
      <td>H. ENTRADA</td>
      <td>H. SALIDA</td>
    </tr>';
$time_star= "";
$time_end= "";
$i = 1;
while ($reg=$rspta->fetch_object()){
                                        if ($reg->kind_id==1) {
                                            $time_star=$reg->time_star;
                                            $time_end=$reg->time_end;
                                        }else if($reg->kind_id==2){                                                     
                                            $time_star=  "<i class='' style='color:#1313D3'>Justificado</i>";
                                        }else if($reg->kind_id==3){                                              
                                            $time_star='<i style="color:#FF0000;">Faltó</i>';
                                        }

    $pdf.= '<tr>
      <td>'.$i.'</td>
      <td>'.$reg->idalu.'</td>
      <td>'.$reg->curp.'</td>
      <td>'.$reg->apellidos.'</td>
      <td>'.$reg->nombre.'</td>
      <td>'.$reg->datos1.'</td>
      <td>'.$reg->datos2.'</td>
      <td>'.$reg->fecha.'</td>';

          if ($reg->kind_id==3 or $reg->kind_id==2) {
    $pdf.=  '<td colspan="2" style="text-align:center">'.$time_star.'</td>';
          }else{
    $pdf.=  '<td>'.$time_star.'</td>
           <td>'.$time_end.'</td>';
          }      
    $pdf.= ' </tr>';
  $i++;
  }
$pdf.= '
</table>
';

/*$dompdf->setPaper( 'A4','portrait');*/
ob_end_clean();
$dompdf->setPaper( 'A4','landscape');
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($pdf);
$dompdf->render();
$dompdf->stream('invoice.pdf',array("Attachment"=>false));


// <img class="radius_img" src="'.$IMG.'" alt="">