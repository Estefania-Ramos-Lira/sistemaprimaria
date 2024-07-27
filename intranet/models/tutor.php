<?php 

require "../config/Conexion.php";


class tutor {
    
    
    public function __construct() {   
    }
    
    public function insertarTutor($idtutor, $idalumno, $nombretutor)
    {
        $sql = "INSERT INTO tutor (idtutor, idalumno, nombretutor)
                VALUES ('$idtutor', '$idalumno', '$nombretutor')";
        return ejecutarConsulta($sql); 
    }
    
    public function updateTutor($idalumno, $nombretutor)
{
    $sql = "UPDATE tutor SET nombretutor='$nombretutor' WHERE idalumno='$idalumno'";
    return ejecutarConsulta($sql);
}

    public function mostrarTutor($idtutor)
    {
        $sql = "SELECT * FROM tutor WHERE idtutor='$idtutor'";
        return ejecutarConsultaSimpleFila($sql);
    }
    
    public function listarTutor()
    {
    $sql = "SELECT t.*, p.nombre AS nombretutor_alumno 
            FROM tutor t
            INNER JOIN alumno p ON t.idalumno = p.idalumno
            ORDER BY p.nombre ASC";
    return ejecutarConsulta($sql);
    }      

    public function deleteTutor($idtutor)
    {
        $sql = "DELETE FROM tutor WHERE idtutor='$idtutor'";
        return ejecutarConsulta($sql); 
    }

}
?>
