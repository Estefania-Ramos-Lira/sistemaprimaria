<?php 

require "../config/Conexion.php";

Class Check_out
{

	public function __construct()
	{

	} 

	public function listgroup_student()
	{
		//$sql="SELECT p.idalumno,p.tipo_alumno,p.datos1,p.datos2 FROM alumno p where p.tipo_alumno='Estudiante' group by p.datos2 order by p.datos1,p.datos2 asc";
		$sql="SELECT p.idalumno, p.tipo_alumno, p.datos1, p.datos2 
		FROM alumno p
		WHERE p.tipo_alumno = 'Estudiante'
		GROUP BY p.datos1, p.datos2
		ORDER BY p.datos1, p.datos2 ASC";
		return ejecutarConsulta($sql);		
	}

	public function listgroup_other()
	{
		$sql="SELECT p.idalumno,p.tipo_alumno,p.datos1,p.datos2 FROM  alumno p  where p.tipo_alumno<>'Estudiante' group by p.tipo_alumno order by p.tipo_alumno asc";
		return ejecutarConsulta($sql);		
	}



	public function liststudent($tipo_alumno,$datos1,$datos2)
	{
		$sql="SELECT p.idalumno,p.apellidos,p.nombre FROM alumno p where p.tipo_alumno='$tipo_alumno' and p.datos1='$datos1' and p.datos2='$datos2' order by p.apellidos asc";
		return ejecutarConsulta($sql);		
	}

	public function listother($tipo_alumno)
	{
		$sql="SELECT p.idalumno,p.apellidos,p.nombre FROM alumno p where p.tipo_alumno='$tipo_alumno' order by p.apellidos asc";
		return ejecutarConsulta($sql);		
	}

	public function listarassistance($idalumno,$date_at)
    {
     $sql = "SELECT * from assistance a where a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')='$date_at'";
        return ejecutarConsulta($sql);
    }


        public function insert($idalumno,$date)
    {
			$sql = "INSERT INTO assistance (idalumno,kind_id,fecha_star) VALUES ('$idalumno','3','$date')";
			return ejecutarConsulta($sql);
    }


        public function insertjustification($idalumno,$date,$descripcion)
    {
			$sql = "INSERT INTO assistance (idalumno,kind_id,fecha_star,descripcion) VALUES ('$idalumno','2','$date','$descripcion')";
			return ejecutarConsulta($sql);
    }
   public function update($idassistance,$descripcion)
    {


    	$sql="UPDATE assistance SET descripcion='$descripcion' WHERE idassistance='$idassistance'";
		return ejecutarConsulta($sql);

	}



	public function listcurdate($date)
    {
     $sql = "SELECT * from assistance a where DATE_FORMAT(a.fecha_star,'%Y-%m-%d')='$date'";
        return ejecutarConsulta($sql);
    }


}

?>