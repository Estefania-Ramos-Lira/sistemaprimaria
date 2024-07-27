<?php
require "../config/Conexion.php";
Class Import {

	public function __construct()
	{ 
	}


	public function insert($tipo_alumno,$nombre,$apellidos,$idalu,$datos1,$datos2,$nespeciales,$gpreescolar,$codigo)
	{
		$sql="INSERT INTO alumno (tipo_alumno,nombre,apellidos,idalu,datos1,datos2,nespeciales,gpreescolar,codigo,status) VALUES ('$tipo_alumno','$nombre','$apellidos','$idalu','$datos1','$datos2','$nespeciales','$gpreescolar','$codigo','1')";
		return ejecutarConsulta($sql);
	}

	// Función para insertar datos en la tabla tutor
public function insertTutor($nombretutor)
{
    $sql = "INSERT INTO tutor (nombretutor) VALUES ('$nombretutor')";
    return ejecutarConsulta($sql);
}

// Función para insertar datos en la tabla edad
public function insertEdad($edadsiceeo, $edadestadistica)
{
    $sql = "INSERT INTO edad (edadsiceeo, edadestadistica) VALUES ('$edadsiceeo', '$edadestadistica')";
    return ejecutarConsulta($sql);
}




}


?>