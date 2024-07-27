<?php
require_once "../models/List.php";
$obj=new Listado();
date_default_timezone_set('America/Regina');



switch ($_GET["op"]){
    case 'listar':

    $tipo_alumno=$_REQUEST['tipo_alumno'];
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
    
    $datos1=$_REQUEST['datos1'];
    $datos2=$_REQUEST['datos2'];
    $time_star= "";
    $time_end= "";
     

    if ($tipo_alumno=="Estudiante") {
         $rspta = $obj->listarstudent($date_star,$date_end,$tipo_alumno,$datos1,$datos2);
    } else {
       $rspta = $obj->listar($date_star,$date_end,$tipo_alumno);
    }
        $data = array();
        $i = 1;
        while ($reg = $rspta->fetch_object()) {
            if ($reg->kind_id==1) {
                $time_star=$reg->time_star;
                $time_end=$reg->time_end;

            }else if($reg->kind_id==2){                                                     
                $time_star='<p style="color:#2B21AB;">Justificado</p>';
            }else if($reg->kind_id==3){                                                                            
                $time_star='<p style="color:#FF0000;">Faltó</p>';
            }

            $data[] = array(
                "0" => $i,
                "1" => $reg->apellidos,
                "2" => $reg->nombre,
                "3" => $reg->datos1,
                "4" => $reg->datos2,
                "5" => $reg->fecha,
                "6" => $time_star,
                "7" => $time_end,
            );
            $i++;
        }
        $results = array(
            "sEcho"                => 1, 
            "iTotalRecords"        => count($data),
            "iTotalDisplayRecords" => count($data), 
            "aaData"               => $data);
        echo json_encode($results);
    break;


    case 'listar_time':

    $tipo_alumno=$_REQUEST['tipo_alumno'];
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
    


    
/*    $date_star= $_REQUEST['date_star'];
    $date_end= $_REQUEST['date_end'];*/
    $datos1=$_REQUEST['datos1'];
    $datos2=$_REQUEST['datos2'];
    $timeingreso=$_REQUEST['timeingreso'];
    $tardanza=0;
     if ($timeingreso!=0) {
        $timeingreso;
    } else {
        $timeingreso='00:00';
    } 
     

    if ($tipo_alumno=="Estudiante") {
         $rspta = $obj->listarstudent_time($date_star,$date_end,$tipo_alumno,$datos1,$datos2,$timeingreso);
    } else {
       $rspta = $obj->listar_time($date_star,$date_end,$tipo_alumno,$timeingreso);
    }
        $data = array();
        $i = 1;
        while ($reg = $rspta->fetch_object()) {
            if ($reg->kind_id==1) {
                if ($reg->time_star<$timeingreso) {
                    $tardanza='<p style="color:green; ">Temprano</p>';
                } elseif($reg->time_star>$timeingreso) { 
                   if ($timeingreso=="00:00") {
                        $tardanza= '<p style="color:green; ">Asistio</p>';
                    }elseif($reg->time_star>$timeingreso) {
                           $tardanza= "<i class='' style='color:#EF870D'>Tarde ". $reg->tardanza."</i>";
                    }
                }elseif($reg->tardanza=$timeingreso){
                    $tardanza='<p style="color:green; ">Temprano</p>';
                }


            }else if($reg->kind_id==2){                                                     
                $tardanza='<p style="color:#2B21AB;">Justificado</p>';
            }else if($reg->kind_id==3){                                                                            
                $tardanza='<p style="color:#FF0000;">Faltó</p>';
            }


            if ($reg->kind_id==2 or $reg->kind_id==3) {
                $time_star="";
            } else {
                $time_star=$reg->time_star;
            }

            $data[] = array(
                "0" => $i,
                "1" => $reg->apellidos,
                "2" => $reg->nombre,
                "3" => $reg->datos1,
                "4" => $reg->datos2,
                "5" => $reg->fecha,
                "6" => $time_star,
                "7" => $reg->time_end,
                "8"=> $tardanza,
            );
            $i++;
        }
        $results = array(
            "sEcho"                => 1, 
            "iTotalRecords"        => count($data),
            "iTotalDisplayRecords" => count($data), 
            "aaData"               => $data);
        echo json_encode($results);
    break;


    case 'listar_id':

    $idalumno=$_REQUEST['idalumno'];
    $date_star= $_REQUEST['date_star'];
    $date_end= $_REQUEST['date_end'];   
    $time_star= "";
    $time_end= "";
     
       $rspta = $obj->listar_id($date_star,$date_end,$idalumno);

        $data = array();
        $i = 1;
        while ($reg = $rspta->fetch_object()) {
            if ($reg->kind_id==1) {
                $time_star=$reg->time_star;
                $time_end=$reg->time_end;

            }else if($reg->kind_id==2){                                                     
                $time_star='<p style="color:#2B21AB;">Justificado</p>';
            }else if($reg->kind_id==3){                                                                            
                $time_star='<p style="color:#FF0000;">Faltó</p>';
            }

            $data[] = array(
                "0" => $i,
                "1" => $reg->apellidos,
                "2" => $reg->nombre,
                "3" => $reg->datos1,
                "4" => $reg->datos2,
                "5" => $reg->fecha,
                "6" => $time_star,
                "7" => $time_end,
            );
            $i++;
        }
        $results = array(
            "sEcho"                => 1, 
            "iTotalRecords"        => count($data),
            "iTotalDisplayRecords" => count($data), 
            "aaData"               => $data);
        echo json_encode($results);
    break;
}


?>
