<?php 
require_once "../models/Entity.php";
$entity=new Entity();


$idinstitucion=isset($_POST["idinstitucion"])? limpiarCadena($_POST["idinstitucion"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$avenida=isset($_POST["avenida"])? limpiarCadena($_POST["avenida"]):"";
$municipio=isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$anio=isset($_POST["anio"])? limpiarCadena($_POST["anio"]):"";
$logo=isset($_POST["logo"])? limpiarCadena($_POST["logo"]):"";
$logoactual=isset($_POST["logoactual"])? limpiarCadena($_POST["logoactual"]):"";



switch ($_GET["op"]){

	case 'saveupdate':


	if (!file_exists($_FILES['logo']['tmp_name']) || !is_uploaded_file($_FILES['logo']['tmp_name']))
	{
		$logoac=$_POST["logoactual"];
	}
	else 
	{
		$ext = explode(".", $_FILES["logo"]["name"]);
		if ($_FILES['logo']['type'] == "image/jpg" || $_FILES['logo']['type'] == "image/jpeg" || $_FILES['logo']['type'] == "image/png")
		{
			$logo = round(microtime(true)) . '.' . end($ext);
			move_uploaded_file($_FILES["logo"]["tmp_name"], "../resource/files/logo/" . $logo);
		}
	}



	if ($logo!="") {
		$ruta=is_file('../resource/files/logo/'.$logoactual);
		if ($ruta<>NULL) {
		unlink('../resource/files/logo/'.$logoactual);
		$rspta=$entity->editar($idinstitucion,$nombre,$avenida,$municipio,$ciudad,$estado,$anio,$logo);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
		}else{
		$rspta=$entity->editar($idinstitucion,$nombre,$avenida,$municipio,$ciudad,$estado,$anio,$logo);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
		}

	}else{
		$rspta=$entity->update($idinstitucion,$nombre,$avenida,$municipio,$ciudad,$estado,$anio,$logoac);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
	}

break;

	case 'view':
	$idinstitucion=$_GET['idinstitucion'];
	$rspta=$entity->view($idinstitucion);
	echo json_encode($rspta);
	break;


	case 'listar':
	$rspta=$entity->listar();
	$data= Array();

	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->nombre,
			"1"=>$reg->avenida,
			"2"=>$reg->municipio,	
			"3"=>$reg->ciudad,
			"4"=>$reg->estado,
			"5"=>$reg->anio,
			"6"=>"<a href='../resource/files/logo/".$reg->logo."' data-lighter>
			<img src='../resource/files/logo/".$reg->logo."' height='35px' width='35px' > </a>",
			"7"=>
			' <a href="#"  data-toggle="modal" data-target="#kt_modal_1" onclick="view('.$reg->idinstitucion.');"><i data-toggle="tooltip" title="Modificar" class="fla flaticon-edit" style="color: rgb(0, 166, 90);"></i></a>',
		);
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