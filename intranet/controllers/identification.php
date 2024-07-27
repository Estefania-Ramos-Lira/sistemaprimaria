<?php 
require_once "../models/Identification.php";
$BDobj=new Identification();

switch ($_GET["op"]){

	case 'autocomplete':
		$searchTerm = $_GET['term'];
		$rspta = $BDobj->autocomplete($searchTerm);
		$datos = array();

		while ($reg=$rspta->fetch_object()){
			$idalumno = $reg->idalumno;
		    $nombre = $reg->nombre;
		    $apellidos=$reg->apellidos;
		    $idalu = $reg->idalu;
			$row_array['value'] =$idalu." | " .$nombre." ".$apellidos;
			$row_array['idalumno']=$idalumno;
			$row_array['idalu']=$idalu;
			$row_array['nombre']=$nombre;
			$row_array['apellidos']=$apellidos;
			array_push($datos,$row_array);
		}
 		echo json_encode($datos);
	break;


}
?>