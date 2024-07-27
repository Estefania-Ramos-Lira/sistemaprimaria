<?php 

require "../config/Conexion.php";

Class Detallado
{

	public function __construct()
	{
 
	} 

    public function listaralumno($tipo_alumno)
    {
     $sql = "SELECT * FROM alumno p where p.tipo_alumno='$tipo_alumno' and tipo_alumno<>'Estudiante'  order by p.apellidos  asc ";
        return ejecutarConsulta($sql);
    }

        public function listarstudent($tipo_alumno,$datos1,$datos2)
    {
     $sql = "SELECT * FROM alumno p  where p.tipo_alumno='$tipo_alumno' and datos1='$datos1' and datos2='$datos2' order by p.apellidos  asc ";
        return ejecutarConsulta($sql);
    }
 

	public function listarassistance($idalumno,$date_at)
    {
     $sql = "SELECT *,DATE_FORMAT(a.fecha_star,'%H:%i') as time_star from assistance a where a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')='$date_at'";
        return ejecutarConsulta($sql);
    }




    public function listarholidays($date_star,$date_end)
    {
        $sql="SELECT date(start) as dateholidays,title as descripcion FROM calendar where date(start)>='$date_star' and date(start)<='$date_end' and  status=1 and tipo=1";
        return ejecutarConsulta($sql);      
    }

}

?>

