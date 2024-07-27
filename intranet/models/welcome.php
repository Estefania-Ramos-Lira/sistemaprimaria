<?php 

require "intranet/config/Conexion.php";

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
}

?>