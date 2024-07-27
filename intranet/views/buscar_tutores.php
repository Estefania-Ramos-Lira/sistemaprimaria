<?php
require "../config/Conexion.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nombreTutor = isset($_GET['nombreTutor']) ? trim($_GET['nombreTutor']) : '';

    if (!empty($nombreTutor)) {
        $sql = "SELECT DISTINCT nombretutor FROM tutor WHERE nombretutor LIKE '%$nombreTutor%' ORDER BY nombretutor ASC";
        $resultado = ejecutarConsulta($sql);
        $tutores = array();

        while ($row = $resultado->fetch_assoc()) {
            $tutores[] = $row['nombretutor'];
        }

        echo json_encode($tutores);
    }
}
?>