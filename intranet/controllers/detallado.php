<?php
require_once "../models/Detallado.php";
$obj=new Detallado();
date_default_timezone_set('America/Regina');



switch ($_GET["op"]){
    case 'listar':

     $ii = 1;
     $range = 0;
    $date_star= $_GET['date_star']; 
    $date_end= $_GET['date_end']; 
    $tipo_alumno= $_GET['tipo_alumno']; 
    $datos1= $_GET['datos1'];
    $datos2= $_GET['datos2'];
    $timeingreso= $_GET['timeingreso']; 
     if ($timeingreso!=0) {
        $timeingreso;
    } else {
        $timeingreso='';
    } 

if($date_star==null and $date_end==null){
echo '<div class="alert alert-warning fade show" role="alert" id="alerta">
                                    
    <div class="alert-text">No hay datos, por favor selecciona una fecha.</div>
 </div>';
}else{


        if($date_star<=$date_end){
                    $range= ((strtotime($date_end)-strtotime($date_star))+(24*60*60)) /(24*60*60);
                    if($range>31){
                        echo '<div class="alert alert-danger fade show" role="alert" id="alert2">
                            <div class="alert-icon"><i class="flaticon-danger"></i></div>
                            <div class="alert-text">El Rango Maximo es 31 Dias</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>';
                        exit(0);
                    }
        }else{
            echo '<div class="alert alert-danger fade show" role="alert" id="alert3">
                            <div class="alert-"><i class="flaticon-danger"></i></div>
                            <div class="alert-text">Rango Invalido</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>';
            exit(0);
         }


if ($datos1=="" and $datos2=="") {
        $rspta=$obj->listaralumno($tipo_alumno);
        $rows = $rspta->num_rows;
      
        if ($rows>0) {
            echo '
                    <tr style="color:#FFFFFF;  background-color:#006B3D;">
                        
                        <td rowspan="2" style="vertical-align:middle;">ID</td>
                        <td rowspan="2" style="vertical-align:middle;" width="25%">APELLIDOS Y NOMBRES</td>';
                    for($i=0;$i<$range;$i++): 
                            $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
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

                            echo '  <td class="text-center" style="height:auto;">'.$namberdate.'</td>';

                         endfor;
            echo '</tr>



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

                        echo '  <td class="text-center" style="height:auto;">'.$newdia.'</td>';
                    endfor;
                        
            echo '</tr>';




                            while ($regss=$rspta->fetch_object()) {
                            
            echo '    <tr>
                        <td >'.$regss->idalu.'</td>
                        <td >'.$regss->apellidos.", ".$regss->nombre.'</td>';
                                 for($i=0;$i<$range;$i++):
                                    $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                                    $newdate_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                    
                                    $new_date= date("d",strtotime($newdate_at));//1

                                    $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at,$tipo_alumno);
                                    $reg=$rspta_assistance->fetch_object();
                                    $rspta_holidays=$obj->listarholidays($date_star,$date_end);

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

                        if($reg!=null){
                 echo '      <td class="text-center">';
                            if ($reg->kind_id==1) {
                                            if($reg->time_star==$timeingreso){
                                               echo "<i class='fa fa-check' style='color:green;'></i>";
                                            }elseif ($reg->time_star<$timeingreso) {
                                                echo "<i class='fa fa-check' style='color:green;'></i>"; 
                                            } elseif($reg->time_star>$timeingreso) {
                                               if ($timeingreso==null) {
                                                    echo "<i class='fa fa-check' style='color:green;'></i>";
                                                }elseif($reg->time_star>$timeingreso) {
                                                      echo "<i class='' style='color:#F28900'>T</i>";
                                                }
                                            }
                            }else if($reg->kind_id==2){                                                     
                                            echo  "<i  style='color:#1313D3'>J</i>";
                            }else if($reg->kind_id==3){                                                     
                                            echo  "<i  style='color:#FF0000'>F</i>";
                            }
                 echo '      </td>';
                        } else {

                            if ($newdia=="S") {
                                 echo '  <td style="height:auto; color:#FFFFFF;  background-color:#FFD966;"></td>';           
                            }elseif($newdia=="D"){
                                echo '  <td style="height:auto; color:#FFFFFF;  background-color:#FFD966;"></td>';
                            } else {

                                                 echo '      <td class="text-center">';
                            while ($rowholidays=$rspta_holidays->fetch_object()) {
                                                $newholidays= $rowholidays->dateholidays;
                                                if($newdate_at==$newholidays){
                                                    echo "<i class='fa fa-calendar-check' data-skin='brand' data-toggle='kt-tooltip' data-placement='top' title='".$rowholidays->descripcion."' style='color:#FF0000;'></i>"; 
                                                }
                                            }
                echo '      </td>';

                             }
                        }



                
                                endfor; 
            echo '      </tr>';
            $ii++;
                            }

        }else{
                    echo '<div class="alert alert-danger fade show" role="alert" id="alert4">
                            <div class="alert-icon"><i class="flaticon-danger"></i></div>
                            <div class="alert-text">No hay alumno registrado</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>';           
             }
}else{


    $rspta=$obj->listarstudent($tipo_alumno,$datos1,$datos2);
        $rows = $rspta->num_rows;

        if ($rows>0) {
            echo '
                    <tr style="color:#FFFFFF;  background-color:#006B3D;">
                        
                        <td rowspan="2" style="vertical-align:middle;">IDALU</td>
                        <td rowspan="2" style="vertical-align:middle;" width="25%">APELLIDOS Y NOMBRES</td>';
                    for($i=0;$i<$range;$i++): 
                            $namberdate=date("d",strtotime($date_star)+($i*(24*60*60)));
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

                            echo '  <td class="text-center" style="height:auto;">'.$namberdate.'</td>';

                         endfor;
            echo '</tr>



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

                        echo '  <td class="text-center" style="height:auto;">'.$newdia.'</td>';
                    endfor;
                        
            echo '</tr>';




                            while ($regss=$rspta->fetch_object()) {
                            
            echo '    <tr>
                        <td >'.$regss->idalu.'</td>
                        <td >'.$regss->apellidos.", ".$regss->nombre.'</td>';
                                 for($i=0;$i<$range;$i++):
                                    $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                                    $newdate_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                    
                                    $new_date= date("d",strtotime($newdate_at));//1

                                    $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at);
                                    $reg=$rspta_assistance->fetch_object();
                                    $rspta_holidays=$obj->listarholidays($date_star,$date_end);

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

                        if($reg!=null){
                 echo '      <td class="text-center">';
                            if ($reg->kind_id==1) {
                                            if($reg->time_star==$timeingreso){
                                               echo "<i class='fa fa-check' style='color:green;'></i>";
                                            }elseif ($reg->time_star<$timeingreso) {
                                                echo "<i class='fa fa-check' style='color:green;'></i>"; 
                                            } elseif($reg->time_star>$timeingreso) {
                                               if ($timeingreso==null) {
                                                    echo "<i class='fa fa-check' style='color:green;'></i>";
                                                }elseif($reg->time_star>$timeingreso) {
                                                      echo "<i class='' style='color:#F28900'>T</i>";
                                                }
                                            }
                            }else if($reg->kind_id==2){                                                     
                                            echo  "<i  style='color:#1313D3'>J</i>";
                            }else if($reg->kind_id==3){                                                     
                                            echo  "<i  style='color:#FF0000'>F</i>";
                            }
                 echo '      </td>';
                        } else {

                            if ($newdia=="S") {
                                 echo '  <td style="height:auto; color:#FFFFFF;  background-color:#FFD966;"></td>';           
                            }elseif($newdia=="D"){
                                echo '  <td style="height:auto; color:#FFFFFF;  background-color:#FFD966;"></td>';
                            } else {

                                                 echo '      <td class="text-center">';
                            while ($rowholidays=$rspta_holidays->fetch_object()) {
                                                $newholidays= $rowholidays->dateholidays;
                                                if($newdate_at==$newholidays){
                                                    echo "<i class='fa fa-calendar-check' data-skin='brand' data-toggle='kt-tooltip' data-placement='top' title='".$rowholidays->descripcion."' style='color:#FF0000;'></i>"; 
                                                }
                                            }
                echo '      </td>';

                             }
                        }
                                endfor; 
            echo '      </tr>';
            $ii++;
                            }

        }else{
                    echo '<div class="alert alert-danger fade show" role="alert" id="alert4">
                            <div class="alert-icon"><i class="flaticon-danger"></i></div>
                            <div class="alert-text">No hay alumno registrado</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>';           
             }







}

}



    break;


    
}


?>
