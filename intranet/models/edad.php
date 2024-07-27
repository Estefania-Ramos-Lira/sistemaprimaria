<?php 

require "../config/Conexion.php";

class edad {
    
    public function __construct() {   
    }
    
    public function insertarEdad($idedad, $idalumno, $edadsiceeo, $edadestadistica, $nacimiento)
    {
        $sql = "INSERT INTO edad (idedad, idalumno, edadsiceeo, edadestadistica, nacimiento)
                VALUES ('$idedad', '$idalumno', '$edadsiceeo', '$edadestadistica','$nacimiento')";
        return ejecutarConsulta($sql); 
    }


    public function updateEdad($idalumno, $edadsiceeo, $edadestadistica, $nacimiento)
    {
        $sql = "UPDATE edad SET edadsiceeo='$edadsiceeo', edadestadistica='$edadestadistica', nacimiento='$nacimiento' WHERE idalumno='$idalumno'";
        return ejecutarConsulta($sql);
    }
    
    public function mostrarEdad($idedad)
    {
        $sql = "SELECT * FROM edad WHERE idedad='$idedad'";
        return ejecutarConsultaSimpleFila($sql);
    }
    
    public function listarEdad()
    {
        $sql = "SELECT e.*, t.nombretutor, t.apellido
                FROM edad e
                INNER JOIN tutor t ON e.idalumno = t.idalumno
                ORDER BY e.idedad ASC";
        
        return ejecutarConsulta($sql);
    }      

    public function deleteEdad($idedad)
    {
        $sql = "DELETE FROM edad WHERE idedad='$idedad'";
        return ejecutarConsulta($sql); 
    }

}
?>
