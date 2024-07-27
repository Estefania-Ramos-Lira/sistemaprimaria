<?php
ob_start();
date_default_timezone_set('America/Regina');

require_once __DIR__ . '/../resource/domPdf/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $date_star= $_REQUEST['date_star']; 
    $date_end= $_REQUEST['date_end']; 
    $tipo_alumno= $_REQUEST['tipo_alumno']; 
    $datos1= $_REQUEST['datos1'];
    $datos2= $_REQUEST['datos2'];
    $timeingreso= $_REQUEST['timeingreso']; 
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

require_once "../models/Reportsheetdetalle.php";
$obj=new Reportsheetdetalle();

$DBobj = $obj->listar();
$rows=$DBobj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;
$IMG ='../resource/files/logo/'.$logo; 
$range = 0;
$pdf='';
$ii=1;

if($date_star==null and $date_end==null){
echo "<script>alert('Seleccione fecha')</script>";
            echo "<script>window.close();</script>";
                        exit;
}


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


$pdf.= '

<link rel="stylesheet" href="css/pdftime.css">  
<!-- Logos de la escuela y otra institución -->
<div style="position: relative; margin-bottom: 20px;">
    <img src="../resource/files/logo/logosep.png" style="width: 300px; height: auto; margin-right: 427px;">
    <img src="../resource/files/logo/logo2.png" style="width: 300px; height: auto;">
</div>  
';


if ($datos1=="" and $datos2=="") {
        $rspta=$obj->listaralumno($tipo_alumno);
        $rows = $rspta->num_rows;

        if ($rows>0) {
                $pdf.= 
            '
            <table class="txtheader" style="font-size: 8pt;">
                <tr>
                  <td style="width:10%;" rowspan="3"><img class="radius_img" src="'.$IMG.'" alt=""></td>
                  <td style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">'.$institucion.'</td>
                </tr>
                <tr>
                  <td  style="text-align:center; background-color:#FFFFCC;color:#000000"  colspan="4">LISTADO DE ASISTENCIAS</td>
                </tr>
                <tr>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">GRADO</td>
                  <td style="text-align: left;">'.$tipo_alumno.'</td>
                  <td style="width:12%;background-color:#FFFFCC;color:#000000">GRUPO</td>
                  <td style="text-align: left;">'.$tipo_alumno.'</td>
                </tr>
            </table><br>
            <table style="font-size: 8pt;" class="table">
                <tr>
                    <td style="text-align:center; background-color:#006B3D;color:#FFFFFF" COLSPAN="2">DATOS DE LOS ALUMNOS</td> 
                    <td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="'.$range.'" >'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
                    <td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="4" >ESTADO</td>
                </tr>

                <tr style="color:#FFFFFF;  background-color:#006B3D;">
                        
                        <td rowspan="2" style="vertical-align:middle;">ID</td>
                        <td rowspan="2" style="vertical-align:middle;" width="25%">APELLIDOS Y NOMBRES</td>';
                          /*  for($i=0;$i<$range;$i++): 
                         $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
                $pdf.= '  <td class="text-center" style="">'.$namberdate.'</td>';       
                            endfor;
*/
                $pdf.= '  <td rowspan="2" style="background-color:green; text-align:center;">A</td>
                        
                        <td rowspan="2" style="background-color:#FF0000; text-align:center;">F</td>
                        <td rowspan="2" style="background-color:blue; text-align:center;">J</td>
                 </tr>

                <tr style="color:#FFFFFF;  background-color:#006B3D;">';
                        for($i=0;$i<$range;$i++): 
                        $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                $newdia= date("w",strtotime($newdate));
                                if ($newdia==1) {
                                   $newdia="L";
                                } else if($newdia==2 or $newdia==3) {
                                    $newdia="M";
                                }elseif ($newdia==4) {
                                   $newdia="J";
                                }elseif($newdia==5){
                                    $newdia="V";
                                }elseif ($newdia==6) {
                                    $newdia="S";
                                }elseif ($newdia==0) {
                                    $newdia="D";
                                }
                $pdf.= '  <td  style="text-align:center;">'.$newdia.'</td>';
                         endfor;
         $pdf.= '</tr>';
            

                while ($regss=$rspta->fetch_object()) {
                            
        $pdf.=  '<tr>
                    <td >'.$ii.'</td>
                    <td >'.$regss->idalu.'</td>
                    <td >'.$regss->apellidos.", ".$regss->nombre.'</td>';
                            for($i=0;$i<$range;$i++):
                                $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                                $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at);
                                $reg=$rspta_assistance->fetch_object();
                                $rspta_holidays=$obj->listarholidays($date_at);

                                        $newdia= date("w",strtotime($date_at));
                                        if ($newdia==1) {
                                           $newdia="L";
                                        } else if($newdia==2 or $newdia==3) {
                                            $newdia="M";
                                        }elseif ($newdia==4) {
                                           $newdia="J";
                                        }elseif($newdia==5){
                                            $newdia="V";
                                        }elseif ($newdia==6) {
                                            $newdia="S";
                                        }elseif ($newdia==0) {
                                            $newdia="D";
                                        }


                                    if($reg!=null){
        $pdf.='       <td style="text-align:center;">';
                                            if ($reg->kind_id==1) {
                                                if($reg->time_star==$timeingreso){
                                                    
                                                   $pdf.= "<i  style='color:green;'>&radic;</i>";
                                                }elseif ($reg->time_star<$timeingreso) {
                                                   
                                                    $pdf.= "<i  style='color:green;'>&radic;</i>"; 
                                                } elseif($reg->time_star>$timeingreso) {
                                                   if ($timeingreso==null) {
                                                        
                                                        $pdf.= "<i  style='color:green;'>&radic;</i>";
                                                    }elseif($reg->time_star>$timeingreso) {
                                                         
                                                          $pdf.= "<i style='color:#F28900'>T</i>";
                                                    }
                                                }
                                            }else if($reg->kind_id==2){                                                 
                                                            $pdf.=  "<i  style='color:#1313D3'>J</i>";
                                            }else if($reg->kind_id==3){                                                
                                                            $pdf.=  "<i  style='color:#FF0000'>F</i>";
                                            }
        $pdf.='       </td>';
                                     } else {

                                        if ($newdia=="S") {
        $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;"></td>';              
                                         }elseif($newdia=="D"){
        $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;"></td>';
                                         } else { 
        $pdf.= '      <td class="text-center">';
                                                    
        
        while ($rowholidays = $rspta_holidays->fetch_object()) {
            $newholidays = date("Y-m-d", strtotime($rowholidays->dateholidays));
            
            if ($date_at == $newholidays) {
                // Obtener el color de la base de datos para la fecha actual
                $query = "SELECT color FROM calendar WHERE start = '$date_at'";
                $result = $conexion->query($query);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $color = $row['color'];
                } else {
                    // Color predeterminado si no se encuentra un registro para la fecha actual
                    $color = '#C65911';
                }
                
                $pdf .= "<i style='background-color: $color; color: #FFFFFF; padding: 4px;'>C</i>";
            } else {
                $pdf .= "";
            }
        }

        $pdf.= '      </td>';
                                         }
                                    }
                                
                            endfor;  $ii++;

                                    $rspt_j=$obj->listarj($regss->idalumno,$date_star,$date_end);
                                    $result_j=$rspt_j->fetch_object();
                                    if($result_j!=null){
                                        $status_j=$result_j->total;
                                    }else{
                                      $status_j='0';  
                                    }


                                    $rspt_f=$obj->listarf($regss->idalumno,$date_star,$date_end);
                                    $result_f=$rspt_f->fetch_object();
                                    if($result_f!=null){
                                        $status_f=$result_f->total;
                                    }else{
                                      $status_f='0';  
                                    }


                                    $rspt_a=$obj->listar_a_total($regss->idalumno,$date_star,$date_end);
                                    $result_a=$rspt_a->fetch_object();

                                    if ($timeingreso==null) {
                                         if ($result_a!=null) {
                                            $status_a=$result_a->total;
                                    $pdf.='
                                            <td style="text-align:center;">'.$status_a.'</td>';
                                        } else {
                                            $pdf.='
                                            <td style="text-align:center;">0</td>';
                                        }
                                    }else{

                                        $rspt_tem=$obj->listar_a_tem($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tem=$rspt_tem->fetch_object();

                                        $rspt_tar=$obj->listar_a_tar($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tar=$rspt_tar->fetch_object();
                                        
                                        if ($result_tem==null) {
                                            $pdf.=' <td style="text-align:center;">0</td>';
                                        } else {
                                           $status_tem=$result_tem->total;
                                           $pdf.=' <td style="text-align:center;">'.$status_tem.'</td>';
                                        }
                                                                              

                                        if ($result_tar==null) {
                                            $pdf.=' <td style="text-align:center;">0</td>';
                                        } else {
                                           $status_tar=$result_tar->total;
                                            $pdf.=' <td style="text-align:center;">'.$status_tar.'</td>';
                                        }
                                    }

                                            
        $pdf.='       <td style="text-align:center;">'.$status_f.'</td>
                    <td style="text-align:center;">'.$status_j.'</td>
                </tr>';
                }

        $pdf.='</table>';
        }else{
                 echo "<script>alert('No hay alumno seleccionado')</script>";
                        echo "<script>window.close();</script>";
                        exit();           
        }

}else {

        $rspta=$obj->listarstudent($tipo_alumno,$datos1,$datos2);
        $rows = $rspta->num_rows;

        if ($rows>0) {
                $pdf.= 
            '
            <table class="txtheader" style="font-size: 8pt;">
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
                <tr>
                    <td style="text-align:center; background-color:#006B3D;color:#FFFFFF" COLSPAN="2">DATOS DE LOS ALUMNOS</td> 
                    <td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="'.$range.'" >'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
                    <td style="text-align:center;background-color:#006B3D;color:#FFFFFF" COLSPAN="4" >ESTADO</td>
                </tr>

                <tr style="color:#FFFFFF;  background-color:#006B3D;">
                        
                        <td rowspan="2" style="vertical-align:middle;">ID</td>
                        <td rowspan="2" style="vertical-align:middle;">IDALU</td>
                        <td rowspan="2" style="vertical-align:middle;" width="25%">APELLIDOS Y NOMBRES</td>';
                            for($i=0;$i<$range;$i++): 
                         $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
                $pdf.= '  <td class="text-center" style="">'.$namberdate.'</td>';       
                            endfor;

                $pdf.= '  <td rowspan="2" style="background-color:green; text-align:center;">A</td>
                        <td rowspan="2" style="background-color:#FF0000; text-align:center;">F</td>
                        <td rowspan="2" style="background-color:blue; text-align:center;">J</td>
                 </tr>

                <tr style="color:#FFFFFF;  background-color:#006B3D;">';
                        for($i=0;$i<$range;$i++): 
                        $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                $newdia= date("w",strtotime($newdate));
                                if ($newdia==1) {
                                   $newdia="L";
                                } else if($newdia==2 or $newdia==3) {
                                    $newdia="M";
                                }elseif ($newdia==4) {
                                   $newdia="J";
                                }elseif($newdia==5){
                                    $newdia="V";
                                }elseif ($newdia==6) {
                                    $newdia="S";
                                }elseif ($newdia==0) {
                                    $newdia="D";
                                }
                $pdf.= '  <td  style="text-align:center;">'.$newdia.'</td>';
                         endfor;
         $pdf.= '</tr>';
            

                while ($regss=$rspta->fetch_object()) {
                            
        $pdf.=  '<tr>
                    <td >'.$ii.'</td>
                    <td >'.$regss->idalu.'</td>
                    <td >'.$regss->apellidos.", ".$regss->nombre.'</td>';
                            for($i=0;$i<$range;$i++):
                                $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                                $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at);
                                $reg=$rspta_assistance->fetch_object();
                                $rspta_holidays=$obj->listarholidays($date_at);

                                        $newdia= date("w",strtotime($date_at));
                                        if ($newdia==1) {
                                           $newdia="L";
                                        } else if($newdia==2 or $newdia==3) {
                                            $newdia="M";
                                        }elseif ($newdia==4) {
                                           $newdia="J";
                                        }elseif($newdia==5){
                                            $newdia="V";
                                        }elseif ($newdia==6) {
                                            $newdia="S";
                                        }elseif ($newdia==0) {
                                            $newdia="D";
                                        }


                                    if($reg!=null){
        $pdf.='       <td style="text-align:center;">';
                                            if ($reg->kind_id==1) {
                                                if($reg->time_star==$timeingreso){
                                                    
                                                   $pdf.= "<i class='fa fa-check' style='color:green;'>&radic;</i>";
                                                }elseif ($reg->time_star<$timeingreso) {
                                                   
                                                    $pdf.= "<i class='fa fa-check' style='color:green;'>&radic;</i>"; 
                                                } elseif($reg->time_star>$timeingreso) {
                                                   if ($timeingreso==null) {
                                                        
                                                        $pdf.= "<i class='fa fa-check' style='color:green;'>&radic;</i>";
                                                    }elseif($reg->time_star>$timeingreso) {
                                                         
                                                          $pdf.= "<i class='' style='color:#F28900'>T</i>";
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

                                        if ($newdia=="S") {
        $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;"></td>';              
                                         }elseif($newdia=="D"){
        $pdf.= '      <td style="color:#FFFFFF;  background-color:#FFD966;"></td>';
                                         } else { 
        $pdf.= '      <td class="text-center">';
                                                   
        while ($rowholidays = $rspta_holidays->fetch_object()) {
            $newholidays = date("Y-m-d", strtotime($rowholidays->dateholidays));
            
            if ($date_at == $newholidays) {
                // Obtener el color de la base de datos para la fecha actual
                $query = "SELECT color FROM calendar WHERE start = '$date_at'";
                $result = $conexion->query($query);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $color = $row['color'];
                } else {
                    // Color predeterminado si no se encuentra un registro para la fecha actual
                    $color = '#C65911';
                }
                
                $pdf .= "<i style='background-color: $color; color: #FFFFFF; padding: 4px;'>C</i>";
            } else {
                $pdf .= "";
            }
        }
        
        $pdf.= '      </td>';
                                         }
                                    }
                            endfor;  $ii++;

                                    $rspt_j=$obj->listarj($regss->idalumno,$date_star,$date_end);
                                    $result_j=$rspt_j->fetch_object();
                                    if($result_j!=null){
                                        $status_j=$result_j->total;
                                    }else{
                                      $status_j='0';  
                                    }


                                    $rspt_f=$obj->listarf($regss->idalumno,$date_star,$date_end);
                                    $result_f=$rspt_f->fetch_object();
                                    if($result_f!=null){
                                        $status_f=$result_f->total;
                                    }else{
                                      $status_f='0';  
                                    }


                                    $rspt_a=$obj->listar_a_total($regss->idalumno,$date_star,$date_end);
                                    $result_a=$rspt_a->fetch_object();

                                    if ($timeingreso==null) {
                                         if ($result_a!=null) {
                                            $status_a=$result_a->total;
                                    $pdf.='
                                            <td style="text-align:center;">'.$status_a.'</td>';
                                        } else {
                                            $pdf.='
                                            <td style="text-align:center;">0</td>';
                                        }
                                    }else{

                                        $rspt_tem=$obj->listar_a_tem($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tem=$rspt_tem->fetch_object();

                                        $rspt_tar=$obj->listar_a_tar($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tar=$rspt_tar->fetch_object();
                                        
                                        if ($result_tem==null) {
                                            $pdf.=' <td style="text-align:center;">0</td>';
                                        } else {
                                           $status_tem=$result_tem->total;
                                           $pdf.=' <td style="text-align:center;">'.$status_tem.'</td>';
                                        }
                                                                              

                                        if ($result_tar==null) {
                                            $pdf.=' <td style="text-align:center;">0</td>';
                                        } else {
                                           $status_tar=$result_tar->total;
                                            $pdf.=' <td style="text-align:center;">'.$status_tar.'</td>';
                                        }
                                    }

                                            
        $pdf.='       <td style="text-align:center;">'.$status_f.'</td>
                    <td style="text-align:center;">'.$status_j.'</td>
                </tr>';
                }

        $pdf.='</table>';
        }else{
                 echo "<script>alert('No hay alumno seleccionado')</script>";
                        echo "<script>window.close();</script>";
                        exit();           
        }
}


$pdf.='
<br>
<table style="width:20%; font-size: 8pt;padding: 2px;">
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center; width:65px;">&radic;</td>
                  <td>Asistencia</td>
                </tr>
                
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center;">F</td>
                  <td>Faltó</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center;">J</td>
                  <td>Justificacion</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;text-align: center;">C</td>
                  <td>Celebracion/Feriado</td>
                </tr>
              </table>';

ob_end_clean();
$dompdf->setPaper( 'A4','landscape');
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($pdf);
$dompdf->render();
$dompdf->stream('invoice.pdf',array("Attachment"=>false));