<?php 
require_once "../models/Graphics.php";
$DBobj=new graphics();

switch ($_GET["op"]){

	case 'viewsstudentmonth':
	$rspta=$DBobj->studentmonth();
	$data= Array();

	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->nombre,
			"1"=>intval($reg->total_student)
		);
	}
	echo json_encode($data);


	break;


	case 'viewsstudentmontha':
	$rspta=$DBobj->studentmonth();
	$data= [];

	while ($reg=$rspta->fetch_object()){

		extract($data);
		$data[]=["0"=>$reg->nombre,"1"=>$reg->total_student];
	}
	echo json_encode($data);


	break;
}
?>