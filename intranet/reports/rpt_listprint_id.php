<?php
date_default_timezone_set('America/Regina');

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

$IMG ='../Resource/files/logo/'.$logo; 

$rspta = $DBobj->listarall($date_star,$date_end,$idalumno);

$rspta_alumno = $DBobj->listarall($date_star,$date_end,$idalumno);
$row_alumno=$rspta_alumno->fetch_object();
$datos1=$row_alumno->datos1; 
$datos2=$row_alumno->datos2;

echo '

<!DOCTYPE html>
<html>
<head>
<title>Reporte</title>
<style type="text/css">
    body{
    font-family:Poppins,Helvetica,sans-serif;
    font-size: 10pt;
    }

    .txtheader{
      text-align: center;
    }


    .radius_img {
      width:50px;
      height:50px; 
    }


    table{
      border: none;
      border-collapse:collapse;
      width: 100%;
    }

    td,th{
    border: 0.1px #92D050 solid;
      padding: 3px;
    }

    #header{
      background-color: #006B3D;
      color: #FFFFFF;
    }

    </style>

</head>
<body>

<table class="txtheader" style="font-size: 8pt;">
                <tr>
                  <td style="width:10%;" rowspan="3"><img class="radius_img" src="'.$IMG.'" alt=""></td>
                  <td style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">'.$institucion.'</td>
                </tr>
                <tr>
                  <td  style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">LISTADO DE ASISTENCIAS</td>
                </tr>
                <tr>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">DATOS1</td>
                  <td style="width:30%;text-align: left;">'.$datos1.'</td>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">DATOS2</td>
                  <td style="text-align: left;">'.$datos2.'</td>
                </tr>
</table><br>

<table style="font-size: 8pt;">
    <tr id="header">
      <td colspan="5" style="text-align:center;">alumno</td>
      <td colspan="3" style="text-align:center;">'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
    </tr>
    <tr id="header">
      <td>ID</td>
      <td>APELLIDOS</td>
      <td>NOMBRE</td>
      <td>DATOS1</td>
      <td>DATOS2</td>
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
echo '<tr>
      <td>'.$i.'</td>
      <td>'.$reg->apellidos.'</td>
      <td>'.$reg->nombre.'</td>
      <td>'.$reg->datos1.'</td>
      <td>'.$reg->datos2.'</td>
      <td>'.$reg->fecha.'</td>';

          if ($reg->kind_id==3 or $reg->kind_id==2) {
    echo  '<td colspan="2" style="text-align:center">'.$time_star.'</td>';
          }else{
    echo  '<td>'.$time_star.'</td>
           <td>'.$time_end.'</td>';
          }      
echo '</tr>';
  $i++;
  }
 echo '
</table>
</body>
</html>
';
