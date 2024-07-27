<?php 
date_default_timezone_set('America/Regina');
require "../config/Conexion.php";

Class graphics
{
  
	public function __construct()
	{ 

	}

    public function total_alumno()
    {
        $sql="SELECT IFNULL(COUNT(p.idalumno),0) as total from  alumno p";
        return ejecutarConsulta($sql);
    }

    public function total_student()
    {
        $sql="SELECT IFNULL(COUNT(p.idalumno),0) as total from alumno p where p.tipo_alumno='Estudiante'";
        return ejecutarConsulta($sql);
    }

    public function total_teacher()
    {
        $sql="SELECT IFNULL(COUNT(p.idalumno),0) as total from alumno p where p.tipo_alumno='Docente'";
        return ejecutarConsulta($sql);
    }

        public function total_admin()
    {
        $sql="SELECT IFNULL(COUNT(p.idalumno),0) as total from alumno p where p.tipo_alumno='Administrativo'";
        return ejecutarConsulta($sql);
    }

        public function total_other()
    {
        $sql="SELECT IFNULL(COUNT(p.idalumno),0) as total from alumno p where p.tipo_alumno='Otros'";
        return ejecutarConsulta($sql);
    }

    public function studentmonth()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.datos1,' ',p.datos2) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) AND MONTH(a.fecha_star)=MONTH(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Estudiante' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10 ";
        return ejecutarConsulta($sql);
    }

    public function studentyear()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.datos1,' ',p.datos2) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Estudiante' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10";
        return ejecutarConsulta($sql);
    }


    public function teachermonth()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.apellidos) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) AND MONTH(a.fecha_star)=MONTH(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Docente' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10 ";
        return ejecutarConsulta($sql);
    }

    public function teacheryear()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.apellidos) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Docente' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10";
        return ejecutarConsulta($sql);
    }



    public function adminmonth()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.apellidos) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) AND MONTH(a.fecha_star)=MONTH(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Administrativo' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10 ";
        return ejecutarConsulta($sql);
    }

    public function adminyear()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.apellidos) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Administrativo' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10";
        return ejecutarConsulta($sql);
    }


    public function othermonth()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.apellidos) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) AND MONTH(a.fecha_star)=MONTH(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Otros' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10 ";
        return ejecutarConsulta($sql);
    }

    public function otheryear()
    {
        $sql="SELECT IFNULL(COUNT(a.idalumno),0) as total_student,CONCAT(p.nombre,' ',p.apellidos) as nombre FROM assistance a inner join alumno p on a.idalumno=p.idalumno WHERE YEAR(a.fecha_star)=YEAR(CURRENT_DATE()) and a.kind_id='3' and p.tipo_alumno='Otros' GROUP BY a.idalumno ORDER BY COUNT(a.idalumno) DESC LIMIT 0,10";
        return ejecutarConsulta($sql);
    }
}

?>
