<?php 

require "../config/Conexion.php";

Class Reportsheet
{

	public function __construct()
	{

	}

	public function listar()
	{
		$sql="SELECT * FROM institucion";
		return ejecutarConsulta($sql);		
	}


//SE MODIFICO PARA INCLUIR IDALU PARA EL REPORTE LISTADO DE IDALU
//PERTENECE A LOS REPORTES DE LISTADO (IDALU)

//SE MODIFICO PARA INCLUIR CURP PARA EL REPORTE LISTADO DE IDALU

	public function listarall($date_star, $date_end, $idalumno)
	{
		$sql = "SELECT a.idassistance, a.kind_id, p.idalu, p.curp, p.apellidos, p.nombre, p.datos1, p.datos2, DATE_FORMAT(a.fecha_star, '%d-%m-%Y') as fecha, DATE_FORMAT(a.fecha_star, '%H:%i') as time_star, DATE_FORMAT(a.fecha_end, '%H:%i') as time_end FROM assistance a INNER JOIN alumno p ON a.idalumno = p.idalumno WHERE DATE(a.fecha_star) >= '$date_star' AND DATE(a.fecha_star) <= '$date_end' AND a.idalumno = '$idalumno' ORDER BY p.apellidos, a.fecha_star ASC";
		return ejecutarConsulta($sql);
	}
	


}

?>