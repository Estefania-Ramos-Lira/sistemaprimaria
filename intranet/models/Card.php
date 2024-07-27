<?php 

require "../config/Conexion.php";

Class Card
{

	public function __construct()
	{

	} 




	public function card_study($category_estudy,$datos1,$datos2)
    {
     $sql = "SELECT * FROM alumno pe WHERE  pe.tipo_alumno='$category_estudy' and pe.datos1='$datos1'and pe.datos2='$datos2'";
        return ejecutarConsulta($sql);
    }


    public function card_categoria($category)
    {
                $sql = "SELECT * FROM alumno pe WHERE  pe.tipo_alumno='$category'";
        return ejecutarConsulta($sql);
    }


    public function identificacion($identificacion)
    {
                $sql = "SELECT * FROM alumno pe WHERE  pe.idalu='$identificacion'";
        return ejecutarConsulta($sql);
    }

    

}

?>