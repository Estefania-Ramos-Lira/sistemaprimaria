<?php 

require "../config/Conexion.php";

Class Listado
{
 
	public function __construct()
	{
 
	} 


public function listar($date_star,$date_end,$tipo_alumno)
    {
     $sql = "SELECT a.idassistance,a.kind_id,p.tipo_alumno ,p.apellidos,p.nombre,p.datos1,p.datos2,DATE_FORMAT(a.fecha_star,'%Y-%m-%d') as fecha,DATE_FORMAT(a.fecha_star,'%H:%i') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i') as time_end FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and  DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and  p.tipo_alumno='$tipo_alumno' order by p.apellidos,a.fecha_star asc";
        return ejecutarConsulta($sql);
    }


    public function listarstudent($date_star,$date_end,$tipo_alumno,$datos1,$datos2)
    {
     $sql = "SELECT a.idassistance,a.kind_id,p.tipo_alumno ,p.apellidos,p.nombre,p.datos1,p.datos2,DATE_FORMAT(a.fecha_star,'%Y-%m-%d') as fecha,DATE_FORMAT(a.fecha_star,'%H:%i') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i') as time_end FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and  DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and  p.tipo_alumno='$tipo_alumno' and p.datos1='$datos1' and p.datos2='$datos2' order by p.apellidos,a.fecha_star asc";
        return ejecutarConsulta($sql);
    }


    public function listar_time($date_star,$date_end,$tipo_alumno,$timeingreso)
    {
     $sql = "SELECT a.idassistance,a.kind_id,p.tipo_alumno ,p.apellidos,p.nombre,p.datos1,p.datos2,DATE_FORMAT(a.fecha_star,'%Y-%m-%d') as fecha,DATE_FORMAT(a.fecha_star,'%H:%i') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i') as time_end, SUBTIME(time('$timeingreso'),time(DATE_FORMAT(a.fecha_star,'%H:%i'))) as tardanza FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and  DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and  p.tipo_alumno='$tipo_alumno' and tipo_alumno<>'Estudiante' group by a.idalumno,date(a.fecha_star) order by p.apellidos,a.fecha_star asc";
        return ejecutarConsulta($sql);
    }


    public function listarstudent_time($date_star,$date_end,$tipo_alumno,$datos1,$datos2,$timeingreso)
    {
     $sql = "SELECT a.idassistance,a.kind_id,p.tipo_alumno ,p.apellidos,p.nombre,p.datos1,p.datos2,DATE_FORMAT(a.fecha_star,'%Y-%m-%d') as fecha,DATE_FORMAT(a.fecha_star,'%H:%i') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i') as time_end, SUBTIME(time('$timeingreso'),time(DATE_FORMAT(a.fecha_star,'%H:%i'))) as tardanza FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and  DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and  p.tipo_alumno='$tipo_alumno' and p.datos1='$datos1' and p.datos2='$datos2' group by a.idalumno,date(a.fecha_star) order by p.apellidos,a.fecha_star asc";
        return ejecutarConsulta($sql);
    }



    public function listarentity()
    {
        $sql="SELECT * FROM institucion";
        return ejecutarConsulta($sql);      
    }


    public function listar_id($date_star,$date_end,$idalumno){
     $sql = "SELECT a.idassistance,a.kind_id,p.tipo_alumno ,p.apellidos,p.nombre,p.datos1,p.datos2,DATE_FORMAT(a.fecha_star,'%Y-%m-%d') as fecha,DATE_FORMAT(a.fecha_star,'%H:%i') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i') as time_end FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and  DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and  p.idalumno='$idalumno' order by p.apellidos,a.fecha_star asc";
        return ejecutarConsulta($sql);
    }
}

?>

