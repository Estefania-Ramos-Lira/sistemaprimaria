<?php
ob_start();
date_default_timezone_set('America/Regina');
require_once __DIR__ . '/../resource/phpspreadsheet/vendor/autoload.php';

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
$status_f=0;
$status_j=0;
$newholidays=0;

$range = 0;
$ii=1;


require_once "../models/Reportsheetdetalle.php";
$obj=new Reportsheetdetalle();

$DBobj = $obj->listar();
$rows=$DBobj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;
$IMG = '../resource/files/logo/'.$logo; 

if($date_star<=$date_end){
                    $range= ((strtotime($date_end)-strtotime($date_star))+(24*60*60)) /(24*60*60);
                    if($range>31){

                        echo "<script>alert('El Rango Maximo es 31 Dias')</script>";
                        echo "<script>window.close();</script>";
                        exit;
                    }
}else{

            echo "<script>alert('Rango Invalido')</script>";
                        echo "<script>window.close();</script>";
                        exit;
}

if($date_star==null and $date_end==null){
echo "<script>alert('Seleccione fecha')</script>";
            echo "<script>window.close();</script>";
                        exit;
}

use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\style\Alignment;
use PhpOffice\PhpSpreadsheet\style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Protection;


$htmlString='';
$colspan=$range+5;


$htmlString.='

';
               

if ($datos1=="" and $datos2=="") {
$rspta=$obj->listaralumno($tipo_alumno);
$rows = $rspta->num_rows;

if ($rows>0) {
$htmlString .='
          <table>
            <tr>
              <td ROWSPAN="3" style="text-align: center;border:3px solid #92D050;"></td> 
              <td COLSPAN="'.$colspan.'" style="text-align: center;border:3px solid #92D050" >'.$institucion.'</td> 
            </tr> 
            <tr>
              <td COLSPAN="'.$colspan.'" style="text-align: center;border:3px solid #92D050;">LISTADO DE ASISTENCIAS</td> 
            </tr> 
            <tr>
              <td COLSPAN="'.$colspan.'" style="text-align: center;border:3px solid #92D050;" >GRADO: '.$tipo_alumno. " /  GRUPO: ".$tipo_alumno.'</td> 
            </tr>
          </table>
          <table style="text-align: center;"> 
        			<tr>
        					<td COLSPAN="2" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; ">DATOS ALUMNOS</td> 
        					<td COLSPAN="'.$range.'" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; ">'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
        					<td COLSPAN=3" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; ">ESTADO</td>
        			</tr>

        			<tr>
                  <td ROWSPAN="2" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; vertical-align:middle;">ID</td>
                  <td ROWSPAN="2" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;">APELLIDOS Y NOMBRES</td>';
                            for($i=0;$i<$range;$i++): 
                              $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
$htmlString .='   <td style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align: center; ">'.$namberdate.'</td>';
                            endfor;
$htmlString .='   <td ROWSPAN="2" style="background-color:#008000; color:#FFFFFF;border:5px solid #92D050;text-align: center;">A</td>
        		       <td ROWSPAN="2" style="background-color:#FF0000; color:#FFFFFF;border:5px solid #92D050;text-align: center;">F</td>
        		      <td ROWSPAN="2"  style="background-color:#0000FF; color:#FFFFFF;border:5px solid #92D050;text-align: center;">J</td>
                      
              </tr>
              <tr>';
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
$htmlString .='  <td style="color:#FFFFFF; background-color:#006B3D; border:5px solid #92D050; text-align: center;" >'.$newdia.'</td>';
                            endfor;
$htmlString .='</tr>';

                while ($regss=$rspta->fetch_object()) {
                            
        $htmlString.=  '<tr>
                    <td style="border:5px solid #92D050;text-align:center;">'.$regss->idalu.'</td>
                    <td style="border:5px solid #92D050;">'.$regss->apellidos.", ".$regss->nombre.'</td>';
                            for($i=0;$i<$range;$i++):
                                $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                                $newdate_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                $new_date= date("d",strtotime($newdate_at));

                                $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at);
                                $reg=$rspta_assistance->fetch_object();
                               
                                $rspta_holidays=$obj->listarholidays($newdate_at);
                                $row=$rspta_holidays->fetch_object();
                                $newholidays= date("Y-m-d",strtotime($row->dateholidays));


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

                                $v = "";

                                    if($reg!=null){
                                         if ($reg->kind_id==1) {
                                            if($reg->time_star==$timeingreso){
                                                $v="A";
                                            }elseif ($reg->time_star<$timeingreso) {
                                                 $v="A";
                                            } elseif($reg->time_star>$timeingreso) {
                                               if ($timeingreso==null) {
                                                      $v="A";
                                                }elseif($reg->time_star>$timeingreso) {
                                                       $v="T";
                                                }
                                            }
                                        }else if($reg->kind_id==2){                                                     
                                             $v="J";
                                        }else if($reg->kind_id==3){                                                     
                                             $v="F";
                                        }                         

                                     } else {
                                        if($newdate_at==$newholidays){
                                            $v="C";
                                        } else{
                                            $v="";
                                        }
                                    }


                                   if($v=="A"){
                                        $htmlString.='     <td style="color:#14851C;border:5px solid #92D050;text-align: center;">&radic;</td>';
                                    }elseif($v=="J"){
                                        $htmlString.='     <td style="color:#0000FF;border:5px solid #92D050;text-align: center;">'.$v.'</td>';
                                    }elseif($v=="F"){
                                        $htmlString.='     <td style="color:#FF0000;border:5px solid #92D050;text-align: center;">'.$v.'</td>';
                                    }else{

                                         if ($newdia=="S") {
                                        $htmlString.= '   <td style="color:#FFFFFF;  background-color:#FFD966;border:5px solid #92D050;"></td>';  
                                        }elseif($newdia=="D"){
                                            $htmlString.= '    <td style="color:#FFFFFF;  background-color:#FFD966;border:5px solid #92D050;"></td>';
                                        }else{
                                            if ($v == "C") {
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
                                                
                                                $htmlString .= '<td style="background-color: ' . $color . '; color: #FFFFFF; border: 5px solid #92D050; text-align: center;">C</td>';
                                            } else{
                                          $htmlString.='         <td style="border:5px solid #92D050;"></td>';
                                          }
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
                                        $htmlString.='<td style="border:5px solid #92D050;text-align:center;">'.$status_a.'</td>';
                                            } else {
                                        $htmlString.='<td style="border:5px solid #92D050;text-align:center;">0</td>';
                                            }
                                    }else{

                                        $rspt_tem=$obj->listar_a_tem($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tem=$rspt_tem->fetch_object();

                                        $rspt_tar=$obj->listar_a_tar($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tar=$rspt_tar->fetch_object();
                                        
                                        if ($result_tem==null) {
                                            $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">0</td>';
                                        } else {
                                           $status_tem=$result_tem->total;
                                           $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">'.$status_tem.'</td>';
                                        }
                                                                              

                                        if ($result_tar==null) {
                                            $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">0</td>';
                                        } else {
                                           $status_tar=$result_tar->total;
                                            $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">'.$status_tar.'</td>';
                                        }
                                    }

                                            
        $htmlString.='       <td style="border:5px solid #92D050;text-align:center;"">'.$status_f.'</td>
                    <td style="border:5px solid #92D050;text-align:center;"">'.$status_j.'</td>
                </tr>';
                }

$htmlString.='</table>';

  }else{

            echo "<script>alert('No hay alumno registrado')</script>";
                        echo "<script>window.close();</script>";
                         exit;         
             } 

}else{

$rspta=$obj->listarstudent($tipo_alumno,$datos1,$datos2);
    $rows = $rspta->num_rows;

if ($rows>0) {
$htmlString .='
          <table>
            <tr>
              <td ROWSPAN="3" style="text-align: center;border:3px solid #92D050;"></td> 
              <td COLSPAN="'.$colspan.'" style="text-align: center;border:3px solid #92D050" >'.$institucion.'</td> 
            </tr> 
            <tr>
              <td COLSPAN="'.$colspan.'" style="text-align: center;border:3px solid #92D050;">LISTADO DE ASISTENCIAS</td> 
            </tr> 
            <tr>
              <td COLSPAN="'.$colspan.'" style="text-align: center;border:3px solid #92D050;" >GRADO: '.$datos1. " /  GRUPO: ".$datos2.'</td> 
            </tr>
          </table>
          <table style="text-align: center;"> 
              <tr>
                  <td COLSPAN="2" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; ">DATOS ALUMNOS</td> 
                  <td COLSPAN="'.$range.'" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; ">'.$diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end.'</td>
                  <td COLSPAN="3" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; ">ESTADO</td>
              </tr>

              <tr>
                  <td ROWSPAN="2" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align:center; vertical-align:middle;">IDALU</td>
                  <td ROWSPAN="2" style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;">APELLIDOS Y NOMBRES</td>';
                            for($i=0;$i<$range;$i++): 
                              $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
$htmlString .='   <td style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align: center; ">'.$namberdate.'</td>';
                            endfor;
$htmlString .='   <td ROWSPAN="2" style="background-color:#008000; color:#FFFFFF;border:5px solid #92D050;text-align: center;">A</td>
                   <td ROWSPAN="2" style="background-color:#FF0000; color:#FFFFFF;border:5px solid #92D050;text-align: center;">F</td>
                  <td ROWSPAN="2"  style="background-color:#0000FF; color:#FFFFFF;border:5px solid #92D050;text-align: center;">J</td>
              </tr>
              <tr>';
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
$htmlString .='  <td style="color:#FFFFFF; background-color:#006B3D; border:5px solid #92D050; text-align: center;" >'.$newdia.'</td>';
                            endfor;
$htmlString .='</tr>';

                while ($regss=$rspta->fetch_object()) {
                            
        $htmlString.=  '<tr>
                    <td style="border:5px solid #92D050;text-align:center;">'.$regss->idalu.'</td>
                    <td style="border:5px solid #92D050;">'.$regss->apellidos.", ".$regss->nombre.'</td>';
                            for($i=0;$i<$range;$i++):
                                $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                                $newdate_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                $new_date= date("d",strtotime($newdate_at));

                                $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at);
                                $reg=$rspta_assistance->fetch_object();
                                
                                $rspta_holidays=$obj->listarholidays($newdate_at);
                                $row=$rspta_holidays->fetch_object();
                                $newholidays= date("Y-m-d",strtotime($row->dateholidays));

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

                                $v = "";

                                    if($reg!=null){
                                         if ($reg->kind_id==1) {
                                            if($reg->time_star==$timeingreso){
                                                $v="A";
                                            }elseif ($reg->time_star<$timeingreso) {
                                                 $v="A";
                                            } elseif($reg->time_star>$timeingreso) {
                                               if ($timeingreso==null) {
                                                      $v="A";
                                                }elseif($reg->time_star>$timeingreso) {
                                                       $v="T";
                                                }
                                            }
                                        }else if($reg->kind_id==2){                                                     
                                             $v="J";
                                        }else if($reg->kind_id==3){                                                     
                                             $v="F";
                                        }                         

                                     } else {
                                        if($newdate_at==$newholidays){
                                            $v="C";
                                        } else{
                                            $v="";
                                        }
                                    }


                                    if($v=="A"){
                                        $htmlString.='     <td style="color:#14851C;border:5px solid #92D050;text-align: center;">&radic;</td>';
                                     }elseif($v=="J"){
                                        $htmlString.='     <td style="color:#0000FF;border:5px solid #92D050;text-align: center;">'.$v.'</td>';
                                    }elseif($v=="F"){
                                        $htmlString.='     <td style="color:#FF0000;border:5px solid #92D050;text-align: center;">'.$v.'</td>';
                                    }else{
                                      
                                         if ($newdia=="S") {
                                        $htmlString.= '   <td style="color:#FFFFFF;  background-color:#FFD966;border:5px solid #92D050;"></td>';  
                                        }elseif($newdia=="D"){
                                            $htmlString.= '    <td style="color:#FFFFFF;  background-color:#FFD966;border:5px solid #92D050;"></td>';
                                        }else{
                                            if ($v == "C") {
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
                                                
                                                $htmlString .= '<td style="background-color: ' . $color . '; color: #FFFFFF; border: 5px solid #92D050; text-align: center;">C</td>';
                                            } else{
                                          $htmlString.='         <td style="border:5px solid #92D050;"></td>';
                                          }
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
                                        $htmlString.='<td style="border:5px solid #92D050;text-align:center;">'.$status_a.'</td>';
                                            } else {
                                        $htmlString.='<td style="border:5px solid #92D050;text-align:center;">0</td>';
                                            }
                                    }else{

                                        $rspt_tem=$obj->listar_a_tem($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tem=$rspt_tem->fetch_object();

                                        $rspt_tar=$obj->listar_a_tar($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tar=$rspt_tar->fetch_object();
                                        
                                        if ($result_tem==null) {
                                            $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">0</td>';
                                        } else {
                                           $status_tem=$result_tem->total;
                                           $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">'.$status_tem.'</td>';
                                        }
                                                                              

                                        if ($result_tar==null) {
                                            $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">0</td>';
                                        } else {
                                           $status_tar=$result_tar->total;
                                            $htmlString.=' <td style="border:5px solid #92D050;text-align:center;"">'.$status_tar.'</td>';
                                        }
                                    }

                                            
        $htmlString.='       <td style="border:5px solid #92D050;text-align:center;"">'.$status_f.'</td>
                    <td style="border:5px solid #92D050;text-align:center;"">'.$status_j.'</td>
                </tr>';
                }

$htmlString.='</table>';
  }else{

            echo "<script>alert('No hay alumno registrado')</script>";
                        echo "<script>window.close();</script>";
                        exit;         
             } 

}


$htmlString.='<table>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align: center;">&radic;</td>
                  <td style="border:5px solid #92D050">Asistencia</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align: center;">F</td>
                  <td style="border:5px solid #92D050">Faltó</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align: center;">J</td>
                  <td style="border:5px solid #92D050">Justificacion</td>
                </tr>
                <tr>
                  <td style="color:#FFFFFF; background-color:#006B3D;border:5px solid #92D050;text-align: center;">C</td>
                  <td style="border:5px solid #92D050">Celebracion/Feriado</td>
                </tr>
              </table>';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html(); 
$spreadsheet = $reader->loadFromString($htmlString);

//$spreadsheet->getActiveSheet()->getProtection()->setPassword('report');
//$spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
//$spreadsheet->getActiveSheet()->getProtection()->setSort(true);
//$spreadsheet->getActiveSheet()->getProtection()->setInsertRows(true);
//$spreadsheet->getActiveSheet()->getProtection()->setFormatCells(true);


$sharedStyle = new Style();
$sharedStyle1 = new Style();
$sharedStyle2 = new Style();


$sharedStyle->applyFromArray(
    ['fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'FFFFFFCC'],
            	],
     'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
             ],
      'alignment' => [
                  'horizontal' => Alignment::HORIZONTAL_CENTER,
                  'vertical' => Alignment::VERTICAL_CENTER,
                  'wrapText' => true,
              ]
     ]
);

$sharedStyle1->applyFromArray(
    ['fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '006B3D'],
              ],
     'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
             ],

      'alignment' => [
                  'horizontal' => Alignment::HORIZONTAL_CENTER,
                  'vertical' => Alignment::VERTICAL_CENTER,

              ],
        'font' => [
                  'color' => [
                      'rgb' => 'FFFFFF'
                  ]
              ]
     ]
);


$sharedStyle2->applyFromArray(
    ['fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '006B3D'],
              ],
     'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => ['rgb' => '92D050']],
             ],

      'alignment' => [

                  'vertical' => Alignment::VERTICAL_CENTER,

              ],
        'font' => [
                  'color' => [
                      'rgb' => 'FFFFFF'
                  ]
              ]
     ]
);


$drawing = new Drawing();
$drawing->setName('PhpSpreadsheet logo');
$drawing->setDescription('PhpSpreadsheet logo');
$drawing->setPath(__DIR__ . '/'.$IMG.'');
$drawing->setHeight(36);
$drawing->setCoordinates('A2');
$drawing->setOffsetY(-5);
$drawing->setOffsetX(10);
$drawing->setWorksheet($spreadsheet->getActiveSheet());



for($i=0,$j='C';$i<$range+4;$i++,$j++) {
        $spreadsheet->getActiveSheet()->getColumnDimension($j)->setAutoSize(true);
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle, $j.'1');
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle, $j.'2');
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle, $j.'3');

        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, $j.'5');
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, $j.'7');

      }

for($i=0,$j='C';$i<$range;$i++,$j++) {
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, $j.'6');

      }

$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle, 'B1:B3');
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, 'A6');
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, 'A5:B5');
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle2, 'B6');
/*$cols = 5;  
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, 'A5:B5');  


for($i=0,$j='C';$i<$range+4;$i++,$j++) {
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, $j.$cols);
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle, $j.'1');
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle, $j.'2');
        $spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle, $j.'3');
      }*/

$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    


/*$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT); */
$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
$spreadsheet->getActiveSheet()->setTitle('DATA');


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="REPORTE.xls"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls'); 

ob_end_clean();
$writer->save('php://output');
Exit;
