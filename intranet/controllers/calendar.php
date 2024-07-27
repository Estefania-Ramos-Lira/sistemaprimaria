<?php 
require_once "../models/Calendar.php";
$BDobj=new Calendar();


$idcalendar=isset($_POST["idcalendar"])? limpiarCadena($_POST["idcalendar"]):"";
$title=isset($_POST["title"])? limpiarCadena($_POST["title"]):"";
$color=isset($_POST["color"])? limpiarCadena($_POST["color"]):"";

$start_get=isset($_POST["start"])? limpiarCadena($_POST["start"]):"";
$start_str=str_replace('/','-',$start_get);
$start=date('Y-m-d H:i:s',strtotime($start_str));

$end_get=isset($_POST["end"])? limpiarCadena($_POST["end"]):"";
$end_str=str_replace('/','-',$end_get);
$end=date('Y-m-d H:i:s',strtotime($end_str));

$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$status=isset($_POST["status"])? limpiarCadena($_POST["status"]):"";
switch ($_GET["op"]){
	case 'saveupdate':

	if (empty($idcalendar)){
		$rspta=$BDobj->insert($title,$color,$start,$end,$tipo);
		echo $rspta ? "registro guardado" : "registro no se pudo guardar";
	}else {
		$rspta=$BDobj->update($idcalendar,$title,$color,$start,$end,$tipo,$status);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
	}
	break;

	case 'delete':
		$idcalendar=$_GET['idcalendar'];
		$rspta=$BDobj->delete($idcalendar);
 		echo $rspta ? "evento eliminado" : "evento no se puede eliminar";
	break;

	case 'updateResize':
    $idcalendar=$_REQUEST['idcalendar'];
    
	$start_get=$_REQUEST['start'];
	$start_str=str_replace('/','-',$start_get);
	$start=date('Y-m-d H:i:s',strtotime($start_str));

	$end_get=$_REQUEST['end'];   
	$end_str=str_replace('/','-',$end_get);
	$end=date('Y-m-d H:i:s',strtotime($end_str)); 


    $rspta = $BDobj->updateResize($idcalendar,$start,$end);
 	echo $rspta ? "Evento Actualizado" : "Evento no se puede Actualizado";
	break;


	case 'updateDrop':
    $idcalendar=$_REQUEST['idcalendar'];
    
	$start_get=$_REQUEST['start'];
	$start_str=str_replace('/','-',$start_get);
	$start=date('Y-m-d H:i:s',strtotime($start_str));

	$end_get=$_REQUEST['end'];   
	$end_str=str_replace('/','-',$end_get);
	$end=date('Y-m-d H:i:s',strtotime($end_str)); 


    $rspta = $BDobj->updateDrop($idcalendar,$start,$end);
 	echo $rspta ? "Evento Actualizado" : "Evento no se puede Actualizado";
	break;

	case 'views':
	$idcalendar=$_GET['id'];
	$rspta=$BDobj->views($idcalendar);
	echo json_encode($rspta);
	break;


	case 'listar':

	$rspta=$BDobj->listar();
	$data= Array();

	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"id"=>$reg->idcalendar,
			"title"=>$reg->title,
			"detalle"=>$reg->tipo,
			"start"=>$reg->start,
			"end"=>$reg->end,
			"color"=>$reg->color,		
		);
	}
	echo json_encode($data);

	break;

}
?>