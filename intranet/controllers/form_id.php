<?php
date_default_timezone_set('America/Regina');

require_once "../models/form_id.php";
$BDobj=new Form_id();

$identificacion=isset($_POST["identificacion"])? limpiarCadena($_POST["identificacion"]):"";


$hoy=date('Y-m-d H:i:s');
$hoy_fecha=date('Y-m-d');
$hoy_hora=date('H:i:s');

$idassistance="";
$fecha_star="";
$fecha_end="";
$rowidalu="";

switch ($_GET["op"]){

case 'saveupdate':

    if (empty($identificacion)){
        $rspta=0;
    }else{
        $rspta=$BDobj->listar_assistance($identificacion);
        while ($reg=$rspta->fetch_object()){
           $idassistance= $reg->idassistance;
           $fecha_star= $reg->fecha_star;
           $fecha_end= $reg->fecha_end;
           $kind_id= $reg->kind_id;
           $status= $reg->status;
        }


                if ($fecha_star<>0 and $fecha_end==0) {

                    $horaentrada=$fecha_star; 
                    $newtime=Date('H:i:S',strtotime($hoy));
                    $newtime_star=Date('H:i:S',strtotime($horaentrada)+60);
                        if ($kind_id==2) {
                            echo "7";
                        } else if($kind_id==3){
                            echo "8";
                        }else if($newtime_star>$newtime){
                            echo "3";
                        }else{

                            if ($rspta_update=$BDobj->update($idassistance,$hoy)) {
                               echo "4";
                            }else{
                                echo "5";
                                }
                        }

                }else if ($idassistance==0) {
                   $rspta_alumno=$BDobj->listar_alumno($identificacion);
                       while ($reg_alumno=$rspta_alumno->fetch_object()){
                               $idalumno= $reg_alumno->idalumno;
                               $rowidalu= $reg_alumno->idalu;
                         }

                         if ($rowidalu==$identificacion) {
                            $status='0';
                             if ($rspta_save=$BDobj->insert($idalumno,$hoy,$status)) {
                                    echo "1";
                                }else{
                                    echo "2";
                                }
                         }else{
                            echo "6";
                         }
                }else{
                    $rspta_alumno=$BDobj->listar_alumno($identificacion);
                       while ($reg_alumno=$rspta_alumno->fetch_object()){
                               $idalumno= $reg_alumno->idalumno;
                               $rowidalu= $reg_alumno->idalu;
                         }

                         if ($rowidalu==$identificacion) {
                            $status=$status+1;
                            if ($rspta_save=$BDobj->insert($idalumno,$hoy,$status)) {
                                    echo "1";
                                }else{
                                    echo "2";
                                }
                         }else{
                            echo "6";
                         }
                }
    }

     

break; 


case 'listar':

   $rspta_timestar=$BDobj->max_timestar();

        $reg_timestar=$rspta_timestar->fetch_object();
       $timestar_star=$reg_timestar->time_star; 
       $timeend_star=$reg_timestar->time_end; //mayor de salida


        $rspta_timeend=$BDobj->max_timeend();
        $reg_timeend=$rspta_timeend->fetch_object();
       $timestar_end=$reg_timeend->time_star; //mayor de entrada
       $timeend_end=$reg_timeend->time_end; 

// SE HIZO CAMBIO DE ORDENAMIENTO PARA QUE SEA "NOMBRE APELLIDO, ENTRADA Y SALIDA)
   if ($timeend_star>$timestar_end) {
                $rspta=$BDobj->listartemeend();
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>$reg->nombre,
                        "1"=>$reg->apellidos, 
                        "2"=>Date('g:i A',strtotime($reg->time_star)),
                        "3"=>($reg->time_end)? Date('g:i A',strtotime($reg->time_end)):$reg->time_end, 
                    );
                }
                $results = array(
                        "sEcho"=>1, 
                        "iTotalRecords"=>count($data), 
                        "iTotalDisplayRecords"=>count($data),
                        "aaData"=>$data);
                echo json_encode($results);

    }elseif ($timeend_star<$timestar_end){
                 $rspta=$BDobj->listartimestar();
                    $data= Array();
                    while ($reg=$rspta->fetch_object()){
                        $data[]=array(
                            "0"=>$reg->nombre,
                            "1"=>$reg->apellidos, 
                            "2"=>Date('g:i A',strtotime($reg->time_star)),
                            "3"=>($reg->time_end)? Date('g:i A',strtotime($reg->time_end)):$reg->time_end,
                          
                        );
                    }
                    $results = array(
                            "sEcho"=>1, 
                            "iTotalRecords"=>count($data), 
                            "iTotalDisplayRecords"=>count($data),
                            "aaData"=>$data);
                    echo json_encode($results);
        
    }else{
                $rspta=$BDobj->listar();
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>Date('g:i A',strtotime($reg->time_star)),
                        "1"=>($reg->time_end)? Date('g:i A',strtotime($reg->time_end)):$reg->time_end,
                        "2"=>$reg->apellidos,
                        "3"=>$reg->nombre, 
                    );
                }
                $results = array(
                        "sEcho"=>1, 
                        "iTotalRecords"=>count($data), 
                        "iTotalDisplayRecords"=>count($data),
                        "aaData"=>$data);
                echo json_encode($results);
            }
    break;

}

?>
