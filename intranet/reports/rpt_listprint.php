<?php
date_default_timezone_set('America/Regina');

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

  
require_once '../models/Reportsheet.php';

$DBobj=new Reportsheet();


$obj = $DBobj->listar();
$rows=$obj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;

$IMG ='../Resource/files/logo/'.$logo; 

if ($datos1=="" and $datos2=="") {
     $rspta = $DBobj->listarall($date_star,$date_end,$tipo_alumno);
} else {
  $rspta = $DBobj->listarstudent($date_star,$date_end,$tipo_alumno,$datos1,$datos2);
}

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
                  <td style="text-align: left;">'.$tipo_alumno.'</td>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">DATOS2</td>
                  <td style="text-align: left;">'.$tipo_alumno.'</td>
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
    echo ' </tr>';
  $i++;
  }
 echo '
</table>
</body>
</html>
';
