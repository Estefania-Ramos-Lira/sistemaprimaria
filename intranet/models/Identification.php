<?php 

require "../config/Conexion.php";

Class Identification
{

	public function __construct()
	{

	} 

	public function autocomplete($searchTerm)
	{
		$search='%'.$searchTerm.'%';
		$sql="SELECT * FROM alumno WHERE  idalu LIKE '$search' or nombre LIKE '$search' or apellidos LIKE '$search'";
		return ejecutarConsulta($sql);		
	}


		public function listar_institucion()
	{
		$sql="SELECT * FROM institucion";
		return ejecutarConsulta($sql);		
	}

	    public function list_alumno($idalumno)
    {
                $sql = "SELECT * FROM alumno p WHERE  p.idalumno='$idalumno'";
        return ejecutarConsulta($sql);
    }




	public function listarassistance($idalumno,$date_at)
    {
     $sql = "SELECT *,DATE_FORMAT(a.fecha_star,'%H:%i') as timestar from assistance a WHERE a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')='$date_at'";
        return ejecutarConsulta($sql);
    }

    public function listarholidays($date_star)
    {
        $sql="SELECT date(start) as dateholidays FROM calendar where date(start)='$date_star' and  status=1 and tipo=1";
        return ejecutarConsulta($sql);      
    }


        public function listarj($idalumno,$date_star,$date_end)
    {
     $sql = "SELECT a.idassistance,a.kind_id,a.fecha_star ,COUNT(a.idalumno) as total FROM assistance a WHERE a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and a.kind_id='2' GROUP BY a.idalumno";
        return ejecutarConsulta($sql);
    }

        public function listarf($idalumno,$date_star,$date_end)
    {
     $sql = "SELECT a.idassistance,a.kind_id,a.fecha_star ,COUNT(a.idalumno) as total FROM assistance a WHERE a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and a.kind_id='3' GROUP BY a.idalumno";
        return ejecutarConsulta($sql);
    }

    public function listar_a_total($idalumno,$date_star,$date_end)
    {
     $sql = "SELECT a.idassistance,a.kind_id,a.fecha_star ,COUNT(a.idalumno) as total FROM assistance a WHERE a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and a.kind_id='1' and a.status='0' GROUP BY a.idalumno";
        return ejecutarConsulta($sql);
    }


    public function listar_a_tem($idalumno,$date_star,$date_end,$timestar)
    {
     $sql = "SELECT a.idassistance,a.kind_id,DATE_FORMAT(a.fecha_star,'%H:%i:%S')as timestar ,COUNT(a.idalumno) as total FROM assistance a WHERE a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<'$date_end' and a.kind_id='1' and a.status='0' and DATE_FORMAT(a.fecha_star,'%H:%i')<='$timestar' GROUP BY a.idalumno";
        return ejecutarConsulta($sql);
    }

    public function listar_a_tar($idalumno,$date_star,$date_end,$timestar)
    {
     $sql = "SELECT a.idassistance,a.kind_id,DATE_FORMAT(a.fecha_star,'%H:%i:%S')as timestar ,COUNT(a.idalumno) as total FROM assistance a WHERE a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')>='$date_star' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')<='$date_end' and a.kind_id='1' and a.status='0' and DATE_FORMAT(a.fecha_star,'%H:%i')>'$timestar' GROUP BY a.idalumno";
        return ejecutarConsulta($sql);
    }

}

?>