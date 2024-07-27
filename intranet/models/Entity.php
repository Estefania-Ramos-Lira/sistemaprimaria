<?php 

require "../config/Conexion.php";

Class Entity
{

	public function __construct()
	{

	}

	public function listar()
	{
		$sql="SELECT * FROM institucion";
		return ejecutarConsulta($sql);		
	}


	public function editar($idinstitucion,$nombre,$avenida,$municipio,$ciudad,$estado,$anio,$logo)
	{
		$sql="UPDATE institucion SET nombre='$nombre',avenida='$avenida',municipio='$municipio',ciudad='$ciudad',estado='$estado',anio='$anio',logo='$logo' WHERE idinstitucion='$idinstitucion'";
		return ejecutarConsulta($sql);
	}

	public function update($idinstitucion,$nombre,$avenida,$municipio,$ciudad,$estado,$anio,$logoac)
	{
		$sql="UPDATE institucion SET nombre='$nombre',avenida='$avenida',municipio='$municipio',ciudad='$ciudad',estado='$estado',anio='$anio',logo='$logoac' WHERE idinstitucion='$idinstitucion'";
		return ejecutarConsulta($sql);
	}


	public function view($idinstitucion)
	{
		$sql="SELECT * FROM institucion where idinstitucion='$idinstitucion'";
		return ejecutarConsultaSimpleFila($sql);
	}


	


}

?>