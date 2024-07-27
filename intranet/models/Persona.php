<?php 

require "../config/Conexion.php";

Class alumno
{

	public function __construct()
	{

	} 


	public function insertar($tipo_alumno, $nombre, $apellidos, $idalu, $datos1, $datos2, $curp, $nespeciales, $gpreescolar, $codigo)
{
    // Verificar si la CURP ya existe en la base de datos
    $sql_check_curp = "SELECT COUNT(*) AS count FROM alumno WHERE curp = '$curp'";
    $result_check_curp = ejecutarConsultaSimpleFila($sql_check_curp);
    $count_curp = $result_check_curp['count'];

    // Verificar si el idalu ya existe en la base de datos
    $sql_check_idalu = "SELECT COUNT(*) AS count FROM alumno WHERE idalu = '$idalu'";
    $result_check_idalu = ejecutarConsultaSimpleFila($sql_check_idalu);
    $count_idalu = $result_check_idalu['count'];

    if ($count_curp > 0) {
        // La CURP ya existe en la base de datos
        return "La CURP ya existe.";
    } else if ($count_idalu > 0) {
        // El idalu ya existe, no se puede insertar
        return "El idalu ya existe.";
    }

    $sql = "INSERT INTO alumno (tipo_alumno, nombre, apellidos, idalu, datos1, datos2, curp, nespeciales, gpreescolar, codigo, status)
            VALUES ('$tipo_alumno', '$nombre', '$apellidos', '$idalu', '$datos1', '$datos2', '$curp', '$nespeciales', '$gpreescolar', '$codigo', '1')";
    return ejecutarConsulta($sql);
}


public function update($idalumno, $tipo_alumno, $nombre, $apellidos, $idalu, $datos1, $datos2, $curp, $nespeciales, $gpreescolar, $codigo, $nombretutor, $edadsiceeo, $edadestadistica, $nacimiento)
{
	$tipo_alumno = "Estudiante"; // Asignar siempre el valor "Estudiante"
	
    // Verificar si el nuevo idalu ya existe en la base de datos (excepto para el registro actual)
    $sql_check_idalu = "SELECT COUNT(*) AS count FROM alumno WHERE idalu = '$idalu' AND idalumno != '$idalumno'";
    $result_check_idalu = ejecutarConsultaSimpleFila($sql_check_idalu);
    $count_idalu = $result_check_idalu['count'];

    if ($count_idalu > 0) {
        // El nuevo idalu ya existe en otro registro, no se puede actualizar
        return "El idalu ya existe en otro registro.";
    }

    // Verificar si la nueva CURP ya existe en la base de datos (excepto para el registro actual)
    $sql_check_curp = "SELECT COUNT(*) AS count FROM alumno WHERE curp = '$curp' AND idalumno != '$idalumno'";
    $result_check_curp = ejecutarConsultaSimpleFila($sql_check_curp);
    $count_curp = $result_check_curp['count'];

    if ($count_curp > 0) {
        // La nueva CURP ya existe en otro registro
        return "La CURP ya existe en otro registro.";
    }

    $sql = "UPDATE alumno SET tipo_alumno='$tipo_alumno', nombre='$nombre', apellidos='$apellidos', idalu='$idalu', datos1='$datos1', datos2='$datos2', curp = '$curp', nespeciales='$nespeciales', gpreescolar='$gpreescolar', codigo='$codigo' WHERE idalumno='$idalumno'";
    $rspta = ejecutarConsulta($sql);

    // Actualizar el nombre del tutor
    $tutor = new tutor();
    $tutor->updateTutor($idalumno, $nombretutor);

    // Formatear la fecha de nacimiento
    $nacimiento_formateada = date('Y-m-d', strtotime($nacimiento));

    // Actualizar las edades
    $sql_edad = "UPDATE edad SET edadsiceeo='$edadsiceeo', edadestadistica='$edadestadistica', nacimiento='$nacimiento_formateada' WHERE idalumno='$idalumno'";
    $rspta_edad = ejecutarConsulta($sql_edad);

    // Verificar si las consultas fueron exitosas
    if ($rspta && $rspta_edad) {
        return true; // Éxito
    } else {
        return false; // Error
    }
}


	public function inactive($idalumno)
	{
		$sql="UPDATE alumno SET status='0' WHERE idalumno='$idalumno'";
		return ejecutarConsulta($sql);
	}


	public function active($idalumno)
	{
		$sql="UPDATE alumno SET status='1' WHERE idalumno='$idalumno'";
		return ejecutarConsulta($sql);
	}

/*
		public function mostrar($idalumno)
	{
		$sql="SELECT * FROM alumno WHERE idalumno='$idalumno'";
		return ejecutarConsultaSimpleFila($sql);
	}
 */

 /*public function mostrar($idalumno)
 {
	 $sql = "SELECT alumno.*, tutor.nombretutor 
			 FROM alumno 
			 LEFT JOIN tutor ON alumno.idalumno = tutor.idalumno 
			 WHERE alumno.idalumno = '$idalumno'";
	 return ejecutarConsultaSimpleFila($sql);
 }*/

	public function mostrar($idalumno)
	{
		$sql = "SELECT alumno.*, tutor.nombretutor, edad.edadsiceeo, edad.edadestadistica, edad.nacimiento
				FROM alumno
				LEFT JOIN tutor ON alumno.idalumno = tutor.idalumno
				LEFT JOIN edad ON alumno.idalumno = edad.idalumno
				WHERE alumno.idalumno = '$idalumno'";
		$resultado = ejecutarConsultaSimpleFila($sql);
	
		// Formatear la fecha de nacimiento al formato YYYY-MM-DD
		$resultado['nacimiento'] = date('Y-m-d', strtotime($resultado['nacimiento']));
	
		return $resultado;
	}
 

	/*public function listar()
	{
		$sql="SELECT e.*, tutor.nombretutor FROM alumno e left join tutor on tutor.idalumno=e.idalumno order by e.datos1,e.datos2,e.apellidos asc";
		return ejecutarConsulta($sql);		
	}*/

	public function listar()
{
	$sql = "SELECT e.*, t.nombretutor, DATE_FORMAT(edad.nacimiento, '%d-%m-%Y') AS nacimiento_formateada, edad.edadsiceeo, edad.edadestadistica
	FROM alumno e
	LEFT JOIN tutor t ON t.idalumno = e.idalumno
	LEFT JOIN edad ON edad.idalumno = e.idalumno
	ORDER BY e.datos1, e.datos2, e.apellidos ASC";
    return ejecutarConsulta($sql);        
}

/*
	public function delete($idalumno)
	{
		$sql="DELETE FROM alumno WHERE idalumno='$idalumno'";
		return ejecutarConsulta($sql);
	}
*/

/*
	public function delete($idalumno)
	{
		// Eliminar primero el registro del tutor asociado al alumno
		$sqlDeleteTutor = "DELETE FROM tutor WHERE idalumno='$idalumno'";
		ejecutarConsulta($sqlDeleteTutor);

		// Luego, eliminar el registro del alumno
		$sqlDeleteAlumno = "DELETE FROM alumno WHERE idalumno='$idalumno'";
		return ejecutarConsulta($sqlDeleteAlumno);

		// Luego, eliminar el registro del alumno
		$sqlDeleteAlumno = "DELETE FROM edad WHERE idalumno='$idalumno'";
		return ejecutarConsulta($sqlDeleteAlumno);
	}

	*/

	/* ESTA TAMBIEN FUNCIONA QUE SIRVE PARA ELIMINAR
	
	public function delete($idalumno) {
		$sql = "DELETE alumno, tutor, edad 
				FROM alumno
				LEFT JOIN tutor ON alumno.idalumno = tutor.idalumno
				LEFT JOIN edad ON alumno.idalumno = edad.idalumno
				WHERE alumno.idalumno = '$idalumno'";
	
		return ejecutarConsulta($sql);
	}
	*/

	public function delete($idalumno)
{
    // Eliminar el registro del alumno, esto automáticamente eliminará los registros en tutor y edad debido a ON DELETE CASCADE
    $sqlDeleteAlumno = "DELETE FROM alumno WHERE idalumno='$idalumno'";
    return ejecutarConsulta($sqlDeleteAlumno);
}


	public function insert_id()
	{
		$sql="SELECT MAX(idalumno) AS id_alumno FROM alumno";
		return ejecutarConsulta($sql);
	}

	public function existeIdalu($idalu)
	{
		$sql = "SELECT COUNT(*) AS count FROM alumno WHERE idalu = '$idalu'";
		$result = ejecutarConsultaSimpleFila($sql);
		$count = $result['count'];
	
		return ($count > 0);
	}

	public function existeCurp($curp) {
		$sql = "SELECT COUNT(*) AS count FROM alumno WHERE curp = '$curp'";
		$result = ejecutarConsultaSimpleFila($sql);
		$count = $result['count'];
		return $count > 0;
	}

}

?>
