<?php 
require_once "../models/Persona.php";
require_once "../models/tutor.php";
require_once "../models/edad.php";
include('../resource/phpqrcode/qrlib.php');
$persona=new alumno();



$idalumno=isset($_POST["idalumno"])? limpiarCadena($_POST["idalumno"]):"";
$tipo_alumno=isset($_POST["tipo_alumno"])? limpiarCadena($_POST["tipo_alumno"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$idalu=isset($_POST["idalu"])? limpiarCadena($_POST["idalu"]):"";
$datos1=isset($_POST["datos1"])? limpiarCadena($_POST["datos1"]):"";
$datos2=isset($_POST["datos2"])? limpiarCadena($_POST["datos2"]):"";
$curp=isset($_POST["curp"])? limpiarCadena($_POST["curp"]):"";
$nespeciales=isset($_POST["nespeciales"])? limpiarCadena($_POST["nespeciales"]):"";
$gpreescolar=isset($_POST["gpreescolar"])? limpiarCadena($_POST["gpreescolar"]):"";
$nombretutor=isset($_POST["nombretutor"])? limpiarCadena($_POST["nombretutor"]):"";
$edadsiceeo=isset($_POST["edadsiceeo"])? limpiarCadena($_POST["edadsiceeo"]):"";
$edadestadistica=isset($_POST["edadestadistica"])? limpiarCadena($_POST["edadestadistica"]):"";
$nacimiento=isset($_POST["nacimiento"])? limpiarCadena($_POST["nacimiento"]):"";
$dnimg=isset($_POST["dnimg"])? limpiarCadena($_POST["dnimg"]):"";

$year=date("Y-m-d");
$calidad='H';
$tamanio=5;
$borde=1;


switch ($_GET["op"]){
	case 'saveupdate':
		$tipo_alumno = "Estudiante"; // Asignar siempre el valor "Estudiante"


		if (empty($idalumno)) {
			$image_location = "../resource/files/qrcodes/";
			$codigo = $idalu . '.png';
			QRcode::png($idalu, $image_location . $codigo, $calidad, $tamanio, $borde);
	
			$rspta = $persona->insertar($tipo_alumno, $nombre, $apellidos, $idalu, $datos1, $datos2, $curp, $nespeciales, $gpreescolar, $codigo);
	
			if ($rspta === "La CURP ya existe.") {
				echo $rspta . ", no se puede insertar el registro.";
			} else if ($rspta === "El idalu ya existe.") {
				echo $rspta . ", no se puede insertar el registro.";
			} else if ($rspta === false) {
				echo "Error al insertar el registro.";
			} else {
				// Continuar con el resto de la lógica
				$idalumno = $persona->insert_id();
				$alumno = $idalumno->fetch_object();
				$tutor = new tutor();
				$tutor->insertarTutor(0, $alumno->id_alumno, $nombretutor);
	
				$edad = new edad();
				$edad->insertarEdad(0, $alumno->id_alumno, $edadsiceeo, $edadestadistica, $nacimiento);
	
				echo json_encode(array("success" => true, "message" => "Registro guardado", "idalu" => $idalu));

			}
		}	

		
		else {
			// Generar la imagen de código QR
			$image_location = "../resource/files/qrcodes/";
			$codigo = $idalu . '.png';
			QRcode::png($idalu, $image_location . $codigo, $calidad, $tamanio, $borde);
		
			// Verificar si el nuevo idalu ya existe en la base de datos (excepto para el registro actual)
			$sql_check = "SELECT COUNT(*) AS count FROM alumno WHERE idalu = '$idalu' AND idalumno != '$idalumno'";
			$result_check = ejecutarConsultaSimpleFila($sql_check);
			$count = $result_check['count'];
		
			if ($count > 0) {
				// El nuevo idalu ya existe en otro registro, no se puede actualizar
				echo "El idalu ya existe en otro registro, no se puede actualizar.";
			} else {
				// Eliminar la imagen anterior solo si el idalu ha cambiado
				if ($idalu != $dnimg) {
					unlink('../resource/files/qrcodes/' . $dnimg . '.png');
				}
		
				$rspta = $persona->update($idalumno, $tipo_alumno, $nombre, $apellidos, $idalu, $datos1, $datos2, $curp, $nespeciales, $gpreescolar, $codigo, $nombretutor, $edadsiceeo, $edadestadistica, $nacimiento);
		
				if ($rspta === "La CURP ya existe en otro registro.") {
					echo $rspta . ", no se puede actualizar el registro.";
				} else if ($rspta === false) {
					echo "Error al actualizar el registro.";
				} else {
					echo json_encode(array("success" => true, "message" => "Registro actualizado", "idalu" => $idalu));
				}
			}
		}
		break;	



	case 'inactive':
		$rspta=$persona->inactive($idalumno);
 		echo $rspta ? "alumno Desactivado" : "alumno no se puede desactivar";
	break;

	case 'active':
		$rspta=$persona->active($idalumno);
 		echo $rspta ? "alumno activado" : "alumno no se puede activar";
	break;

	case 'mostrar':
	$idalumno=$_GET['idalumno'];
	$rspta=$persona->mostrar($idalumno);
	echo json_encode($rspta);
	break;

	//case 'delete':
	//	$idalumno=$_GET['idalumno'];
	//	$codigo=$_GET['codigo'];
	//	unlink('../resource/files/qrcodes/'.$codigo);
	//	$rspta=$persona->delete($idalumno);

 	//	echo $rspta ? "registro eliminado" : "registro no se puede eliminar";
	//break;

	case 'delete':
		$idalumno = $_GET['idalumno'];
		$codigo = $_GET['codigo'];
	
		// Intenta eliminar el registro del alumno
		$rspta = $persona->delete($idalumno);
	
		// Si la eliminación es exitosa, elimina el archivo codigoqr
		if ($rspta) {
			unlink('../resource/files/qrcodes/' . $codigo);
			echo "registro eliminado";
		} else {
			echo "registro no se puede eliminar";
		}
		break;
	


	case 'listar':
		$rspta=$persona->listar();
		$data= Array();
		$i = 1;
		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>$i,
				"1"=>$reg->tipo_alumno,
				"2"=>$reg->idalu,
				"3"=>$reg->curp,
				"4"=>$reg->nombre,
				"5"=>$reg->apellidos,
				"6"=>$reg->datos1,
				"7"=>$reg->datos2,
				"8"=>$reg->gpreescolar,
				"9"=>$reg->nacimiento_formateada,	
				"10"=>$reg->edadestadistica,
				"11"=>$reg->edadsiceeo,
				"12"=>$reg->nespeciales,
				"13"=>$reg->nombretutor,
				"14"=>"<a href='../resource/files/qrcodes/".$reg->codigo."' data-lighter>
				<img src='../resource/files/qrcodes/".$reg->codigo."' height='35px' width='35px' > </a>",
				"15"=>($reg->status)?'<span class="btn btn-success btn-sm" onclick="inactive('.$reg->idalumno.')"> Activo</span>':
					 '<span class="btn btn-danger btn-sm" onclick="active('.$reg->idalumno.')">Inactivo</span>',
			    "16"=>
				' <div style="text-align: center;">'.
			    '<a href="#" class="vies" onclick="mostrar('.$reg->idalumno.');">'.
				'<i data-toggle="tooltip" title="Modificar" class="fla flaticon-edit" style="color: rgb(0, 166, 90);"></i>'
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




