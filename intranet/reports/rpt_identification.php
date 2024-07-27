<?php
ob_start();
date_default_timezone_set('America/Regina');
require_once __DIR__ . '/../resource/domPdf/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $date_star= $_GET['date_star']; 
    $date_end= $_GET['date_end']; 
    $idalumno= $_GET['idalumno']; 

    $timeingreso= $_GET['timeingreso']; 
     if ($timeingreso!=0) {
        $timeingreso;
    } else {
        $timeingreso='';
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

            $status_a=0;
            $status_tem=0;
            $status_tar=0;
            $status_f=0;
            $status_j=0;
            $newholidays=0;
            $range = 0;

require_once '../models/Identification.php';

$DBobj=new Identification();

$obj = $DBobj->listar_institucion();
$rows=$obj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;
$IMG ='../resource/files/logo/'.$logo; 

$spta_alumno = $DBobj->list_alumno(intval($idalumno));
$row_alumno=$spta_alumno->fetch_object();
$nombre=$row_alumno->nombre; 
$apellidos=$row_alumno->apellidos; 
$datos1=$row_alumno->datos1; 
$datos2=$row_alumno->datos2;

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
         
$pdf='';
$pdf.=' 


<link rel="stylesheet" href="css/pdfidentifcation.css"> 
<div class="center_cont">
<table>
    <tr>
      <td class="text-center" rowspan="2" style="color:#FFFFFF;"><img class="radius_img" src="'.$IMG.'" alt=""></td>
      <td class="text-center" colspan="3" style="color:#FFFFFF; background-color:#006B3D;">'.$institucion.'</td>
    </tr>
    <tr>
      <td class="text-center" colspan="3" style="color:#FFFFFF; background-color:#006B3D;">NOMBRE: '.$apellidos.', '.$nombre.'</td>
    </tr>
    <tr>
      <td class="text-center" width="50%" colspan="2" style="color:#000000; background-color:#FFFFCC;">GRADO: '.$datos1.'</td>
      <td class="text-center" colspan="2" style="color:#000000; background-color:#FFFFCC;">GRUPO: '.$datos2.'</td>
    </tr>
    <tr>

      <td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="4" >'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
    </tr>

    <tr>
      <td class="text-center" width="5%" colspan="2" style="color:#000000; background-color:#FFFFCC;">DIA</td>
      <td class="text-center" colspan="2" style="color:#000000; background-color:#FFFFCC;">STATUS</td>
    </tr>';

$range= ((strtotime($date_end)-strtotime($date_star))+(24*60*60)) /(24*60*60);

for($i=0;$i<$range;$i++): 
      $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
      $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
      $newdia= date("w",strtotime($newdate));
                                if ($newdia==1) {
                                   $newdia="Lunes";
                                } else if($newdia==2) {
                                    $newdia="Martes";
                                }elseif ($newdia==3) {
                                  $newdia="Miercoles";
                                }elseif ($newdia==4) {
                                   $newdia="Jueves";
                                }elseif($newdia==5){
                                    $newdia="Viernes";
                                }elseif ($newdia==6) {
                                    $newdia="Sabado";
                                }elseif ($newdia==0) {
                                    $newdia="Domingo";
                                }
      $rspta_assistance=$DBobj->listarassistance($idalumno,$newdate);
      $reg=$rspta_assistance->fetch_object();

      $rspta_holidays=$DBobj->listarholidays($newdate);
      $row=$rspta_holidays->fetch_object();
      $newholidays= date("Y-m-d",strtotime($row->dateholidays));

$pdf.=' <tr>
        <td class="text-center" style="color:#FFFFFF; background-color:#006B3D;">'.$namberdate.'</td>
        <td style="color:#000000; background-color:#F8FBE6;" >'.$newdia.'</td>';

     
                                          if ($reg!=null) {
$pdf.='       <td style="text-align:center;" colspan="2">';
                                            if ($reg->kind_id==1) {
                                                if($reg->timestar==$timeingreso){
                                                    
                                                   $pdf.= "<i  style='color:green;'>&radic;</i>";
                                                }elseif ($reg->timestar<$timeingreso) {
                                                   
                                                    $pdf.= "<i  style='color:green;'>&radic;</i>"; 
                                                } elseif($reg->timestar>$timeingreso) {
                                                   if ($timeingreso==null) {
                                                        
                                                        $pdf.= "<i  style='color:green;'>&radic;</i>";
                                                    }elseif($reg->timestar>$timeingreso) {
                                                         
                                                          $pdf.= "<i style='color:#F28900'>T</i>";
                                                    }
                                                }
                                            }else if($reg->kind_id==2){                                                 
                                                            $pdf.=  "<i  style='color:#1313D3'>J</i>";
                                            }else if($reg->kind_id==3){                                                
                                                            $pdf.=  "<i  style='color:#FF0000'>F</i>";
                                            }else{
                                                $pdf.= "";
                                            }
 $pdf.='       </td>';
                                          } else {

                                              if ($newdia=="Sabado") {
 $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;" colspan="2"></td>';              
                                                 }elseif($newdia=="Domingo"){
  $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;" colspan="2"></td>';
                                                } else { 
                                                    if ($newholidays==$newdate) {
$pdf.='       <td style="text-align:center;background-color:#C65911;color:#FFFFFF " colspan="2">C</td>'; 
                                                    } else {
$pdf.='       <td style="text-align:center;" colspan="2"></td>'; 
                                                    }
                                                } 
                                          }



                              

$pdf.= '</tr>';   
 endfor;


$pdf.='</table>
';

                                    $rspt_j=$DBobj->listarj($idalumno,$date_star,$date_end);
                                    $result_j=$rspt_j->fetch_object();
                                    if($result_j!=null){
                                        $status_j=$result_j->total;
                                    }else{
                                      $status_j='0';  
                                    }


                                    $rspt_f=$DBobj->listarf($idalumno,$date_star,$date_end);
                                    $result_f=$rspt_f->fetch_object();
                                    if($result_f!=null){
                                        $status_f=$result_f->total;
                                    }else{
                                      $status_f='0';  
                                    }


                                    $rspt_a=$DBobj->listar_a_total($idalumno,$date_star,$date_end);
                                    $result_a=$rspt_a->fetch_object();

                                    if ($timeingreso==null) {
                                         if ($result_a!=null) {
                                            $status_tem=$result_a->total;
                                            $status_tar='0';
                                        } else {
                                            $status_tem='0';
                                            $status_tar='0';
                                        }
                                    }else{

                                        $rspt_tem=$DBobj->listar_a_tem($idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tem=$rspt_tem->fetch_object();

                                        $rspt_tar=$DBobj->listar_a_tar($idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tar=$rspt_tar->fetch_object();
                                        
                                        if ($result_tem==null) {
                                           $status_tem='0';
                                        } else {
                                           $status_tem=$result_tem->total;
                                        }
                                                                              

                                        if ($result_tar==null) {
                                           $status_tar='0';
                                        } else {
                                           $status_tar=$result_tar->total;
                                        }
                                    }



$pdf.='
<br>
<table style="width:80%; font-size: 8pt;padding: 2px;">
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center; width:65px;" width="20%">&radic;</td>
                  <td width="44%">Asistencia</td>
                  <td colspan="2">'.$status_tem.'</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center;">T</td>
                  <td>Tardanza</td>
                  <td colspan="2">'.$status_tar.'</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center;">F</td>
                  <td>Faltó</td>
                  <td colspan="2">'.$status_f.'</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center;">J</td>
                  <td>Justificacion</td>
                  <td colspan="2">'.$status_j.'</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center;">C</td>
                  <td>Celebracion/Feriado</td>
                  <td colspan="2"></td>
                </tr>
              </table></div>';
              
ob_end_clean();          
$dompdf->setPaper( 'A4','portrait');
/*$dompdf->setPaper( 'A4','landscape');*/
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($pdf);
$dompdf->render();
$dompdf->stream('invoice.pdf',array("Attachment"=>false));


// <img class="radius_img" src="'.$IMG.'" alt="">