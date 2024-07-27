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

    public function listarall($date_star, $date_end, $tipo_alumno, $timeingreso)
    {
        $sql = "SELECT a.idassistance, a.kind_id, p.tipo_alumno, p.apellidos, p.nombre, p.datos1, p.datos2, p.idalu, DATE_FORMAT(a.fecha_star, '%Y-%m-%d') as fecha, DATE_FORMAT(a.fecha_star, '%H:%i') as time_star, DATE_FORMAT(a.fecha_end, '%H:%i') as time_end, SUBTIME(time('$timeingreso'), time(DATE_FORMAT(a.fecha_star, '%H:%i'))) as tardanza FROM assistance a INNER JOIN alumno p ON a.idalumno = p.idalumno WHERE DATE_FORMAT(a.fecha_star, '%Y-%m-%d') >= '$date_star' AND DATE_FORMAT(a.fecha_star, '%Y-%m-%d') <= '$date_end' AND p.tipo_alumno = '$tipo_alumno' GROUP BY a.idalumno, DATE(a.fecha_star) ORDER BY p.apellidos, a.fecha_star ASC";
        return ejecutarConsulta($sql);
    }
    


    public function listarstudent($date_star, $date_end, $tipo_alumno, $datos1, $datos2, $timeingreso)
{
    $sql = "SELECT a.idassistance, a.kind_id, p.tipo_alumno, p.apellidos, p.nombre, p.datos1, p.datos2, p.idalu, DATE_FORMAT(a.fecha_star, '%Y-%m-%d') as fecha, DATE_FORMAT(a.fecha_star, '%H:%i') as time_star, DATE_FORMAT(a.fecha_end, '%H:%i') as time_end, SUBTIME(time('$timeingreso'), time(DATE_FORMAT(a.fecha_star, '%H:%i'))) as tardanza FROM assistance a INNER JOIN alumno p ON a.idalumno = p.idalumno WHERE DATE_FORMAT(a.fecha_star, '%Y-%m-%d') >= '$date_star' AND DATE_FORMAT(a.fecha_star, '%Y-%m-%d') <= '$date_end' AND p.tipo_alumno = '$tipo_alumno' AND p.datos1 = '$datos1' AND p.datos2 = '$datos2' GROUP BY a.idalumno, DATE(a.fecha_star) ORDER BY p.apellidos, a.fecha_star ASC";
    return ejecutarConsulta($sql);
}



}

?>