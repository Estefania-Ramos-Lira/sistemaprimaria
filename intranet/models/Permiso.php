<?php 
require "../config/Conexion.php";

Class Permiso
{
	public function __construct()
	{

	}


	//public function listar()
	//{
	//	$sql="SELECT * FROM permiso";
	//	return ejecutarConsulta($sql);		
	//}



	// APARECER LISTADO DE PERMISOS PARA EL USUARIO

//public function listar()
//{
  //  $sql = "SELECT * FROM permiso WHERE idpermiso NOT IN (3, 6)";
    //return ejecutarConsulta($sql);        
//}


public function listar()
{
    $sql = "SELECT idpermiso, 
                   CASE 
                       WHEN nombre = 'Escritorio' THEN 'Escritorio'
                       WHEN nombre = 'calendario' THEN 'Calendario'
                       WHEN nombre = 'Alumno' THEN 'Listado de Alumnos'
                       WHEN nombre = 'Asistencias' THEN 'Asistencias'
                       WHEN nombre = 'Reportes Listado' THEN 'Reportes'
                       WHEN nombre = 'Acceso' THEN 'Usuarios y Permisos'
                       WHEN nombre = 'Code Qr' THEN 'Consultar QR'
                       ELSE nombre
                   END AS nombre
            FROM permiso 
            WHERE idpermiso NOT IN (3, 6, 9)";
    return ejecutarConsulta($sql);        
}




}

?>