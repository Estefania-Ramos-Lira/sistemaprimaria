<?php 

require "../config/Conexion.php";

Class Form_id
{

	public function __construct()
	{
 
	} 


	public function listar_assistance($identificacion)
    {
     $sql = "SELECT a.idassistance,a.idalumno,a.fecha_star,a.fecha_end,a.kind_id, a.status FROM assistance a inner join alumno p on a.idalumno=p.idalumno where DATE(a.fecha_star)=curdate() and p.idalu='$identificacion' ORDER by a.fecha_star desc limit 1";
        return ejecutarConsulta($sql);
    }


    public function listar_alumno($identificacion)
    {
    $sql = "SELECT idalumno,idalu FROM  alumno where idalu='$identificacion' and status='1'";
        return ejecutarConsulta($sql);
    }


    public function insert($idalumno,$hoy,$status)
    {
        $sql="INSERT INTO assistance (idalumno,kind_id,fecha_star,fecha_end,descripcion,status)
        VALUES ('$idalumno',1,'$hoy',null,null,'$status')";
        return ejecutarConsulta($sql);
    }



     public function listartemeend()
    {
        $sql="SELECT DATE_FORMAT(a.fecha_star,'%H:%i:%S') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i:%S') as time_end,p.apellidos,p.nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')=curdate() and a.kind_id='1' order by DATE_FORMAT(a.fecha_end,'%H:%i:%S') desc";
        return ejecutarConsulta($sql);      
    }

     public function listartimestar()
    {
        $sql="SELECT DATE_FORMAT(a.fecha_star,'%H:%i:%S') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i:%S') as time_end,p.apellidos,p.nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')=curdate() and a.kind_id='1' order by DATE_FORMAT(a.fecha_star,'%H:%i:%S') desc";
        return ejecutarConsulta($sql);      
    }

    public function listar()
    {
        $sql="SELECT DATE_FORMAT(a.fecha_star,'%H:%i:%S') as time_star, DATE_FORMAT(a.fecha_end,'%H:%i:%S') as time_end,p.apellidos,p.nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE DATE_FORMAT(a.fecha_star,'%Y-%m-%d')=curdate() and a.kind_id='1'  order by a.idassistance desc";
        return ejecutarConsulta($sql);      
    }



    public function update($idassistance,$hoy)
    {
        $sql="UPDATE assistance SET fecha_end='$hoy' WHERE idassistance='$idassistance'";
        return ejecutarConsulta($sql);
    }


    public function max_timestar()
    {
    $sql = "SELECT a.idassistance,DATE_FORMAT(fecha_star,'%H:%i:%S') as time_star,max(DATE_FORMAT(fecha_end,'%H:%i:%S'))as time_end FROM  assistance a where DATE_FORMAT(fecha_star,'%Y-%m-%d')=curdate() order by DATE_FORMAT(fecha_star,'%H:%i:%S') desc";
        return ejecutarConsulta($sql);
    }


    public function max_timeend()
    {
    $sql = "SELECT a.idassistance,max(DATE_FORMAT(fecha_star,'%H:%i:%S')) as time_star, DATE_FORMAT(fecha_end,'%H:%i:%S')as time_end FROM  assistance a where DATE_FORMAT(fecha_star,'%Y-%m-%d')=curdate() order by DATE_FORMAT(fecha_end,'%H:%i:%S') desc";
        return ejecutarConsulta($sql);
    }


}

?>

