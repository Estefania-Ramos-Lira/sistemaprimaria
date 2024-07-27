<?php 

require "../config/Conexion.php";

Class List_assistance
{

	public function __construct()
	{
 
	} 


	public function listar()
{
    $sql = "SELECT a.idassistance, a.kind_id, p.tipo_alumno, p.apellidos, p.nombre, p.datos1, p.datos2, p.idalu, DATE_FORMAT(a.fecha_star, '%d-%m-%Y') as fecha, DATE_FORMAT(a.fecha_star, '%H:%i:%S') as time_star, DATE_FORMAT(a.fecha_end, '%H:%i:%S') as time_end FROM assistance a INNER JOIN alumno p ON a.idalumno = p.idalumno ORDER BY a.idassistance DESC";
    return ejecutarConsulta($sql);
}



    public function update($idassistance,$idalumno,$newdatestar)
    {
        $sql="UPDATE assistance a SET a.idalumno='$idalumno',a.fecha_star='$newdatestar',a.fecha_end=NULL WHERE a.idassistance='$idassistance'";
        return ejecutarConsulta($sql);
    }


    public function update_2($idassistance,$idalumno,$newdatestar,$newdateend)
    {
        $sql="UPDATE assistance a SET a.idalumno='$idalumno',a.fecha_star='$newdatestar',a.fecha_end='$newdateend' WHERE a.idassistance='$idassistance'";
        return ejecutarConsulta($sql);
    }


    public function vista($idassistance)
    {

        $sql="SELECT a.idassistance,p.idalumno,p.nombre,p.apellidos,DATE_FORMAT(a.fecha_star,'%H:%i') as timestar,DATE_FORMAT(a.fecha_star,'%Y-%m-%d') as datestar,DATE_FORMAT(a.fecha_end,'%H:%i') as timeend,DATE_FORMAT(a.fecha_end,'%Y-%m-%d') as dateend FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE idassistance='$idassistance'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function delete($idassistance)
    {
        $sql="DELETE FROM assistance WHERE idassistance='$idassistance'";
        return ejecutarConsulta($sql);
    }


}

?>

