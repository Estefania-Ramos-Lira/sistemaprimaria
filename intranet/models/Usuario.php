<?php 

require "../config/Conexion.php";

Class Usuario
{

	public function __construct()
	{

	}


	public function insertar($nombre,$cargo,$login,$clave,$imagen,$permisos)
	{
		$sql="INSERT INTO usuario (nombre,cargo,login,clave,imagen,condicion)
		VALUES ('$nombre','$cargo','$login','$clave','$imagen','1')";
		$idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	public function editar($idusuario,$nombre,$cargo,$login,$clave,$imagen,$permisos)
	{
		$sql="UPDATE usuario SET nombre='$nombre',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);

		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	public function update($idusuario,$nombre,$cargo,$login,$clave,$imagen,$permisos)
	{
		$sql="UPDATE usuario SET nombre='$nombre',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);

		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}
		return $sw;
	}
	

	public function inactive($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}


	public function active($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function delete($idusuario)
	{


		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$sql="DELETE FROM usuario WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);	

		$sw=true;
		return $sw;	
	}


	public function view($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}

	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}




	public function verificar($login,$clave)
    {
    	$sql="SELECT idusuario,nombre,cargo,imagen,login FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'"; 
    	return ejecutarConsulta($sql);  
    }

	public function verificarpersonal($login,$clave)
    {
    	$sql="SELECT idpersonal,tipo_personal,nombre,apellidos,dni FROM personal WHERE dni='$login' AND dni='$clave' AND status='1'"; 
    	return ejecutarConsulta($sql);  
    }

}

?>