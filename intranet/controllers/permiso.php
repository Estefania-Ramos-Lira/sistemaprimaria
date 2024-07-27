<?php 

require_once "../models/Permiso.php";

$BDobj=new Permiso();

switch ($_GET["op"]){
	
	case 'listar':
		$rspta=$BDobj->listar();
 		$data= Array();
 		$i=1;
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$i,
 				"1"=>$reg->nombre,
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