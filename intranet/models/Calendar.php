<?php 

require "../config/Conexion.php";

Class Calendar
{

	public function __construct()
	{

	} 


	public function insert($title,$color,$start,$end,$tipo)
	{
		$sql="INSERT INTO calendar (title,color,start,end,tipo,status)
		VALUES ('$title','$color','$start','$end','$tipo','1')";
		return ejecutarConsulta($sql);
	}


	public function update($idcalendar,$title,$color,$start,$end,$tipo,$status)
	{
		$sql="UPDATE calendar SET title='$title', color='$color',start='$start',end='$end',tipo='$tipo',status='$status'  WHERE idcalendar='$idcalendar'";
		return ejecutarConsulta($sql);
	}
	
	public function views($idcalendar)
	{
		$sql="SELECT * FROM calendar WHERE idcalendar='$idcalendar'";
		return ejecutarConsultaSimpleFila($sql);
	}


	public function updateDrop($idcalendar,$start,$end)
	{
		$sql="UPDATE calendar SET start='$start',end='$end'  WHERE idcalendar='$idcalendar'";
		return ejecutarConsulta($sql);
	}

	public function updateResize($idcalendar,$start,$end)
	{
		$sql="UPDATE calendar SET start='$start',end='$end'  WHERE idcalendar='$idcalendar'";
		return ejecutarConsulta($sql);
	}

		public function listar()
	{
		$sql="SELECT * FROM calendar";
		return ejecutarConsulta($sql);		
	}

	public function delete($idcalendar)
	{
		$sql="DELETE FROM calendar WHERE idcalendar='$idcalendar'";
		return ejecutarConsulta($sql);
	}

}

?>