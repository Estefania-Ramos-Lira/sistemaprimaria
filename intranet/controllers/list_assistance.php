<?php
date_default_timezone_set('America/Regina');
require_once "../models/List_assistance.php";
$Obj=new List_assistance();

$idalu=isset($_POST["idalu"])? limpiarCadena($_POST["idalu"]):"";
$idassistance=isset($_POST["idassistance"])? limpiarCadena($_POST["idassistance"]):"";
$idalumno=isset($_POST["idalumno"])? limpiarCadena($_POST["idalumno"]):"";
$timestar=isset($_POST["timestar"])? limpiarCadena($_POST["timestar"]):"";
$timeend=isset($_POST["timeend"])? limpiarCadena($_POST["timeend"]):"";
$datestar=isset($_POST["datestar"])? limpiarCadena($_POST["datestar"]):"";
$dateend=isset($_POST["dateend"])? limpiarCadena($_POST["dateend"]):"";

$newdatestar= $datestar." ".$timestar;


$newdate=date('Y-m-d');
if ($dateend=="") {
    $newdateend= $newdate." ".$timeend;
}else{
    $newdateend= $dateend." ".$timeend;
}


switch ($_GET["op"]){

case 'saveupdate':

    if (empty($timeend)) {
        $rspta=$Obj->update($idassistance,$idalumno,$newdatestar);
        echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
    }else {
        $rspta=$Obj->update_2($idassistance,$idalumno,$newdatestar,$newdateend);
        echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
    }
    break;

case 'delete':
        $rspta=$Obj->delete($idassistance);
        echo $rspta ? "registro eliminado" : "registro no se puede eliminar";
    break;

case 'vista':
    $rspta=$Obj->vista($idassistance);
    echo json_encode($rspta);
    break;
     

case 'listar':
    $rspta=$Obj->listar();
    $data= Array();
    $i = 1;
    while ($reg=$rspta->fetch_object()){

            if ($reg->kind_id==2) {
                $time_star="Justificado";
            } else if($reg->kind_id==3) {
                $time_star="Inasistencia";
            } else {
                $time_star=Date('g:i A',strtotime($reg->time_star));
            }


        $data[]=array(
            "0"=>$i,
            "1"=>$reg->idalu,
            //"2"=>$reg->tipo_alumno,
            "2"=>$reg->apellidos,
            "3"=>$reg->nombre,
            "4"=>$reg->datos1,
            "5"=>$reg->datos2,
            "6"=>$reg->fecha, 
            "7"=>$time_star,
            "8"=>($reg->time_end)? Date('g:i A',strtotime($reg->time_end)):$reg->time_end,
            "9"=>($reg->kind_id==2 or $reg->kind_id==3)?'<a href="#" onclick="delet(' . $reg->idassistance.')"><i data-toggle="tooltip" title="Eliminar" class="fla flaticon2-rubbish-bin" style="color: red;"></i></a>':
            ' <a href="#" onclick="delet(' . $reg->idassistance.')"><i data-toggle="tooltip" title="Eliminar" class="fla flaticon2-rubbish-bin" style="color: red;"></i></a>'. ' <a href="#" data-toggle="modal" data-target="#kt_modal_1" onclick="vista('.$reg->idassistance.'); "><i data-toggle="tooltip" title="Modificar" class="fla flaticon-edit" style="color: rgb(0, 166, 90);"></i></a>' 
            ,
            
        );
        $i++;
    }
    $results = array(
            "sEcho"=>1, 
            "iTotalRecords"=>count($data), 
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
    echo json_encode($results);

    break;

}

?>
