<?php
date_default_timezone_set('America/Regina');
ob_start();
require_once __DIR__ . '/../resource/domPdf/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $get_date_star= $_REQUEST['date_star'];
    
    if ($get_date_star==0) {
        $date_star=0;
    } else {
    $newstar=explode('/',$get_date_star);
    $getdaystar=$newstar[0];
    $getmonthstar=$newstar[1];
    $getyearstar=$newstar[2];
    $date_star= $getyearstar.'-'.$getmonthstar.'-'.$getdaystar;
    }


    $get_date_end= $_REQUEST['date_end'];

    if ($get_date_end==0) {
        $date_end=0;
    } else {
    $newend=explode('/',$get_date_end);
    $getdayend=$newend[0];
    $getmonthend=$newend[1];
    $getyearend=$newend[2];
    $date_end= $getyearend.'-'.$getmonthend.'-'.$getdayend;
    }


    $tipo_alumno= $_REQUEST['tipo_alumno']; 
    $datos1= $_REQUEST['datos1'];
    $datos2= $_REQUEST['datos2'];
    $timeingreso= $_REQUEST['timeingreso']; 
     if ($timeingreso!=0) {
        $timeingreso;
    } else {
        $timeingreso='00:00';
    } 

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

require_once '../models/Reportsheet_time.php';

$DBobj=new Reportsheet();


$obj = $DBobj->listar();
$rows=$obj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;

$IMG ='../resource/files/logo/'.$logo; 
/*if (isset($IMG) && !empty($IMG)) { 
    $imageType = "png";
   if (strpos($IMG, ".png") === false) { 
      $imageType = "jpg";
   }
}*/
/*$gdImage = ($imageType == 'png') ? imagecreatefrompng('../Resource/files/logo/'.$logo) : imagecreatefromjpeg('../Resource/files/logo/'.$logo); */

if ($datos1=="" and $datos2=="") {
     $rspta = $DBobj->listarall($date_star,$date_end,$tipo_alumno,$timeingreso);
} else {
  $rspta = $DBobj->listarstudent($date_star,$date_end,$tipo_alumno,$datos1,$datos2,$timeingreso);
}

$pdf=''; 
$pdf.=' 
<link rel="stylesheet" href="css/pdftime.css"> 

<table class="txtheader" style="font-size: 8pt;">
                <tr>
                  <td style="width:10%;" rowspan="3"><img class="radius_img" src="'.$IMG.'" alt=""></td>
                  <td style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">'.$institucion.'</td>
                </tr>
                <tr>
                  <td  style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">LISTADO DE ASISTENCIAS</td>
                </tr>
                <tr>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">GRADO:</td>
                  <td style="text-align: left;">'.$datos1.'</td>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">GRUPO:</td>
                  <td style="text-align: left;">'.$datos2.'</td>
                </tr>
</table><br>

<table style="font-size: 8pt;">
    <tr id="header">
      <td colspan="5" style="text-align:center;">alumno</td>
      <td colspan="5" style="text-align:center;">'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
    </tr>
    <tr id="header">
      <td>ID</td>
      <td>IDALU</td> 
      <td>APELLIDOS</td>
      <td>NOMBRE</td>
      <td>GRADO</td>
      <td>GRUPO</td>
      <td>FECHA</td>
      <td>H. ENTRADA</td>
      <td>H. SALIDA</td>
      <td>STATUS</td>
    </tr>';
$tardanza= "";
$i = 1;

while ($reg=$rspta->fetch_object()){
 $idalu = $reg->idalu;
 $marcacion=$timeingreso;
        if ($reg->kind_id==1) {

                if ($reg->time_star<$timeingreso) {
                    $tardanza="<i class='fa fa-check' style='color:green;'>Temprano</i>";
                } elseif($reg->time_star>$timeingreso) { 
                   if ($timeingreso=="00:00") {
                        $tardanza= "<i class='fa fa-check' style='color:green;'>Asistio</i>";
                    }elseif($reg->time_star>$timeingreso) {
                           $tardanza= "<i class='' style='color:#EF870D'>Tarde ". $reg->tardanza."</i>";
                    }
                }elseif($reg->tardanza=$timeingreso){
                    $tardanza="<i class='fa fa-check' style='color:green;'>Temprano</i>";
                }


        }else if($reg->kind_id==2){
          $tardanza=  "<i class='' style='color:#1313D3'>Justificado</i>";
        }else if($reg->kind_id==3){                                              
           $tardanza='<i style="color:#FF0000;">Faltó</i>';
        }

                                        if ($reg->kind_id==2 or $reg->kind_id==3) {
                                            $time_star="";
                                        } else {
                                            $time_star=$reg->time_star;
                                        }
    $pdf.='<tr>
      <td>'.$i.'</td>
      <td>'.$idalu.'</td> 
      <td>'.$reg->apellidos.'</td>
      <td>'.$reg->nombre.'</td>
      <td>'.$reg->datos1.'</td>
      <td>'.$reg->datos2.'</td>
      <td>'.$reg->fecha.'</td>
      <td>'.$time_star.'</td>
      <td>'.$reg->time_end.'</td>
      <td>'.$tardanza.'</td>';
   $pdf.=' </tr>';
  $i++;
  }
$pdf.='
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