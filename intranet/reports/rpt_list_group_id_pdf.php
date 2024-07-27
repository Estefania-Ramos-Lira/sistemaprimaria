<?php
ob_start();
date_default_timezone_set('America/Regina');
require_once __DIR__ . '/../resource/domPdf/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $date_star= $_REQUEST['date_star'];
    $date_end= $_REQUEST['date_end'];
    $datos1= $_REQUEST['datos1']; 
    $datos2= $_REQUEST['datos2']; 
    $tipo_alumno= $_REQUEST['tipo_alumno']; 
 
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

            $status_a=0;
            $status_tem=0;
            $status_tar=0;
            $status_f=0;
            $status_j=0;
            $newholidays=0;
            $range = 0;

require_once '../models/Identification_group.php';

$DBobj=new Identification_group();

$obj = $DBobj->listar_institucion();
$rows=$obj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;
$IMG ='../resource/files/logo/'.$logo; 

$pdf='';

$range = 0;
        if($date_star<=$date_end){
                    $range= ((strtotime($date_end)-strtotime($date_star))+(24*60*60)) /(24*60*60);
                    if($range>31){
                        echo "<script>alert('El Rango Maximo es 31 Dias')</script>";
                        echo "<script>window.close();</script>";
                        exit(0);

                    }
        }else{
           echo "<script>alert('Rango Invalido')</script>";
            echo "<script>window.close();</script>";
                        exit(0);

         }


$count=0;


if ($tipo_alumno=="Estudiante") {
    $spta_alumno = $DBobj->listarstudent($tipo_alumno,$datos1,$datos2);

    while ($row_alumno=$spta_alumno->fetch_object()) {
          $idalumno=$row_alumno->idalumno;
          $nombre=$row_alumno->nombre; 
          $apellidos=$row_alumno->apellidos; 
          $datos1=$row_alumno->datos1; 
          $datos2=$row_alumno->datos2;
  $rspta_assistance_today=$DBobj->listarassistance_today($idalumno,$date_star,$date_end);




              $total_today=$rspta_assistance_today->fetch_object();
              $numbertotal= ($total_today->numbertotal +1);//cuentas las filas que habrá contando las columnas de uno de los registros
              $colspancell= ($total_today->numbertotal +1)*2;



    $pdf.=' 

<link rel="stylesheet" href="css/pdfidentifcation.css"> 
<div class="center_cont">





<table>
    <tr>
      <td class="text-center" rowspan="2" colspan="2"  style="color:#FFFFFF;"><img class="radius_img" src="'.$IMG.'" alt=""></td>
      <td class="text-center" colspan="'.$colspancell.'" style="color:#FFFFFF; background-color:#006B3D;">'.$institucion.'</td>
    </tr>
    <tr>
      <td class="text-center" colspan="'.(($colspancell)).'" style="color:#FFFFFF; background-color:#006B3D;">'.$apellidos.', '.$nombre.'</td>
    </tr>
    <tr>
      <td class="text-center"  colspan="'.(1+($numbertotal)).'" style="color:#000000; background-color:#FFFFCC;">GRADO: '.$datos1.'</td>
      <td class="text-center" colspan="'.(1+($numbertotal)).'" style="color:#000000; background-color:#FFFFCC;">GRUPO: '.$datos2.'</td>
    </tr>
    
   <tr>
      <td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="'.($colspancell+2).'" >'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
    </tr>

    <tr>
      <td class="text-center"  rowspan="2" colspan="2" style="color:#000000; background-color:#FFFFCC;">DIA</td>';
        for($turno=1;$turno<$numbertotal+1;$turno++): 
    $pdf.='<td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="2" >Salida '.$turno.'</td>';
     endfor;
 
$pdf.='</tr>
       <tr>';
          
    for($i=0;$i<$numbertotal;$i++): 
    $pdf.='<td class="text-center" colspan="" style="color:#000000; background-color:#FFFFCC;">ENTRADA</td>
          <td class="text-center" colspan="" style="color:#000000; background-color:#FFFFCC;">SALIDA</td>';

     endfor;   

$pdf.='</tr>';


$range= ((strtotime($date_end)-strtotime($date_star))+(24*60*60)) /(24*60*60);
for($i=0;$i<$range;$i++): 

      $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
      $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
      $newdia= date("w",strtotime($newdate));
                                if ($newdia==1) {
                                   $newdia="LU";
                                } else if($newdia==2) {
                                    $newdia="MA";
                                }elseif ($newdia==3) {
                                  $newdia="MI";
                                }elseif ($newdia==4) {
                                   $newdia="JU";
                                }elseif($newdia==5){
                                    $newdia="VI";
                                }elseif ($newdia==6) {
                                    $newdia="SA";
                                }elseif ($newdia==0) {
                                    $newdia="DO";
                                }
      $rspta_assistance=$DBobj->listarassistance($idalumno,$newdate);
      $reg=$rspta_assistance->fetch_object();

      $rspta_holidays=$DBobj->listarholidays($newdate); 
      $row=$rspta_holidays->fetch_object();
      $newholidays= date("Y-m-d",strtotime($row->dateholidays));

$pdf.=' <tr>
          <td class="text-center" style="color:#FFFFFF; background-color:#006B3D;">'.$namberdate.'</td>
          <td class="text-center" style="color:#000000; background-color:#FEFFE3;" >'.$newdia.'</td>';
        
        if ($reg!=null) {

                if ($reg->kind_id==1) {
                              
                    for($cell=0;$cell<$numbertotal;$cell++): 
                          $rspta_assistance_all_day=$DBobj->listarassistance_all_day($idalumno,$reg->fecha,$cell);
                          $fila_day=$rspta_assistance_all_day->fetch_object();

                          $pdf.=' <td class="text-center" >'.$fila_day->timestar.'</td>
                                  <td class="text-center" >'.$fila_day->timeend.'</td>';           
                    endfor; 

                }else if($reg->kind_id==2){  
$pdf.='<td style="color:#1129E0;text-align:center;" colspan="'.$colspancell.'">Justificación</td>';
                }else if($reg->kind_id==3){  
$pdf.= '<td style="color:#FF0000;text-align:center;" colspan="'.$colspancell.'">Faltò</td>';                                              
                }


        } else {

                                              if ($newdia=="SA") {
 $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;" colspan="'.$colspancell.'"></td>
';              
                                                 }elseif($newdia=="DO"){
  $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;" colspan="'.$colspancell.'"></td>';
                                                } else { 
                                                    if ($newholidays==$newdate) {
$pdf.='       <td style="text-align:center;background-color:#C65911;color:#FFFFFF " colspan="'.$colspancell.'">Feriado/Celebracion</td>'; 
                                                    } else {

          for($cell=0;$cell<$colspancell;$cell++): 
$pdf.='<td class="text-center" ></td>';
         endfor;  


                                                    }
                                                } 
                                          }
$pdf.= '</tr>';   
 endfor;




$pdf.='</table>';

         
$pdf.='<br>
</div><div style="page-break-after:always;"></div>';
         }


} else {


  $spta_alumno = $DBobj->listaralumno($tipo_alumno);

    while ($row_alumno=$spta_alumno->fetch_object()) {
          $idalumno=$row_alumno->idalumno;
          $nombre=$row_alumno->nombre; 
          $apellidos=$row_alumno->apellidos; 
          $datos1=$row_alumno->datos1; 
          $datos2=$row_alumno->datos2;

  $rspta_assistance_today=$DBobj->listarassistance_today($idalumno,$date_star,$date_end);




              $total_today=$rspta_assistance_today->fetch_object();
              $numbertotal= ($total_today->numbertotal +1);
              $colspancell= ($total_today->numbertotal +1)*2;



    $pdf.=' 

<link rel="stylesheet" href="css/pdfidentifcation.css"> 
<div class="center_cont">



<table>
    <tr>
      <td class="text-center" rowspan="2" colspan="2"  style="color:#FFFFFF;"><img class="radius_img" src="'.$IMG.'" alt=""></td>
      <td class="text-center" colspan="'.$colspancell.'" style="color:#FFFFFF; background-color:#006B3D;">'.$institucion.'</td>
    </tr>
    <tr>
      <td class="text-center" colspan="'.(($colspancell)).'" style="color:#FFFFFF; background-color:#006B3D;">'.$apellidos.', '.$nombre.'</td>
    </tr>
    <tr>
      <td class="text-center"  colspan="'.(1+($numbertotal)).'" style="color:#000000; background-color:#FFFFCC;">GRADO: '.$datos1.'</td>
      <td class="text-center" colspan="'.(1+($numbertotal)).'" style="color:#000000; background-color:#FFFFCC;">GRUPO: '.$datos2.'</td>
    </tr>
    
   <tr>
      <td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="'.($colspancell+2).'" >'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
    </tr>

    <tr>
      <td class="text-center"  rowspan="2" colspan="2" style="color:#000000; background-color:#FFFFCC;">DIA</td>';
        for($turno=1;$turno<$numbertotal+1;$turno++): 
    $pdf.='<td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="2" >Salida '.$turno.'</td>';
     endfor;
 
$pdf.='</tr>
       <tr>';
          
    for($i=0;$i<$numbertotal;$i++): 
    $pdf.='<td class="text-center" colspan="" style="color:#000000; background-color:#FFFFCC;">ENTRADA</td>
          <td class="text-center" colspan="" style="color:#000000; background-color:#FFFFCC;">SALIDA</td>';

     endfor;   

$pdf.='</tr>';


$range= ((strtotime($date_end)-strtotime($date_star))+(24*60*60)) /(24*60*60);
for($i=0;$i<$range;$i++): 

      $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
      $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
      $newdia= date("w",strtotime($newdate));
                                if ($newdia==1) {
                                   $newdia="LU";
                                } else if($newdia==2) {
                                    $newdia="MA";
                                }elseif ($newdia==3) {
                                  $newdia="MI";
                                }elseif ($newdia==4) {
                                   $newdia="JU";
                                }elseif($newdia==5){
                                    $newdia="VI";
                                }elseif ($newdia==6) {
                                    $newdia="SA";
                                }elseif ($newdia==0) {
                                    $newdia="DO";
                                }
      $rspta_assistance=$DBobj->listarassistance($idalumno,$newdate);
      $reg=$rspta_assistance->fetch_object();

      $rspta_holidays=$DBobj->listarholidays($newdate); 
      $row=$rspta_holidays->fetch_object();
      $newholidays= date("Y-m-d",strtotime($row->dateholidays));

$pdf.=' <tr>
          <td class="text-center" style="color:#FFFFFF; background-color:#006B3D;">'.$namberdate.'</td>
          <td class="text-center" style="color:#000000; background-color:#FEFFE3;" >'.$newdia.'</td>';
        
        if ($reg!=null) {

                if ($reg->kind_id==1) {
                              
                    for($cell=0;$cell<$numbertotal;$cell++): 
                          $rspta_assistance_all_day=$DBobj->listarassistance_all_day($idalumno,$reg->fecha,$cell);
                          $fila_day=$rspta_assistance_all_day->fetch_object();

                          $pdf.=' <td class="text-center" >'.$fila_day->timestar.'</td>
                                  <td class="text-center" >'.$fila_day->timeend.'</td>';           
                    endfor; 

                }else if($reg->kind_id==2){  
$pdf.='<td style="color:#FFD966;text-align:center;" colspan="'.$colspancell.'">J</td>';
                }else if($reg->kind_id==3){  
$pdf.= '<td style="color:#FF0000;text-align:center;" colspan="'.$colspancell.'">Faltò</td>';                                              
                }


        } else {

                                              if ($newdia=="SA") {
 $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;" colspan="'.$colspancell.'"></td>
';              
                                                 }elseif($newdia=="DO"){
  $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;" colspan="'.$colspancell.'"></td>';
                                                } else { 
                                                    if ($newholidays==$newdate) {
$pdf.='       <td style="text-align:center;background-color:#C65911;color:#FFFFFF " colspan="'.$colspancell.'">Feriado/Celebracion</td>'; 
                                                    } else {

          for($cell=0;$cell<$colspancell;$cell++): 
$pdf.='<td class="text-center" ></td>';
         endfor;  


                                                    }
                                                } 
                                          }
$pdf.= '</tr>';   
 endfor;




$pdf.='</table>';

         
$pdf.='<br>
</div><div style="page-break-after:always;"></div>';
         }
}


ob_end_clean();              
$dompdf->setPaper( 'A4','portrait');
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($pdf);
$dompdf->render();
$dompdf->stream('invoice.pdf',array("Attachment"=>false));
