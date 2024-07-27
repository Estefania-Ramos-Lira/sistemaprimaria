<?php 

require "../config/Conexion.php";

Class Identification_group
{

	public function __construct()
	{

	} 



		public function listar_institucion()
	{
		$sql="SELECT * FROM institucion";
		return ejecutarConsulta($sql);		
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
     $sql = "SELECT *,DATE_FORMAT(a.fecha_star,'%Y-%m-%d') as fecha,DATE_FORMAT(a.fecha_star,'%H:%i') as timestar, DATE_FORMAT(a.fecha_end,'%H:%i') as timeend from assistance a WHERE a.idalumno='$idalumno' and DATE_FORMAT(a.fecha_star,'%Y-%m-%d')='$date_at'";
        return ejecutarConsulta($sql);
    }

    public function listarassistance_all($idalumno,$date_at)
    {
     $sql = "SELECT date(a.fecha_star) as fecha,DATE(a.fecha_end) as fechafin,time(a.fecha_star) as timestar, time(a.fecha_end) as timeend,a.status from assistance a WHERE a.idalumno='$idalumno' and DATE(a.fecha_star)='$date_at' and a.kind_id='1'";
        return ejecutarConsulta($sql);
    }

    public function listarassistance_all_day($idalumno,$date_at,$i)
    {
     $sql = "SELECT date(a.fecha_star) as fecha,DATE(a.fecha_end) as fechafin,DATE_FORMAT(a.fecha_star,'%H:%i') as timestar, DATE_FORMAT(a.fecha_end,'%H:%i') as timeend,a.status from assistance a WHERE a.idalumno='$idalumno' and DATE(a.fecha_star)='$date_at'and a.status='$i' and a.kind_id='1'";
        return ejecutarConsulta($sql);
    }

    public function listarassistance_today($idalumno,$date_at,$date_end)
    {

     $sql = "SELECT max(a.status) as numbertotal from assistance a WHERE a.idalumno='$idalumno' and date(a.fecha_star)>='$date_at' and Date(a.fecha_star)<='$date_end' and a.kind_id=1";
        return ejecutarConsulta($sql);
    }


/*    public function listarholidays($date_star)
    {
        $sql="SELECT dateholidays FROM holidays where DATE_FORMAT(dateholidays,'%Y-%m-%d') ='$date_star' and status=1 ";
        return ejecutarConsulta($sql);      
    }*/

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