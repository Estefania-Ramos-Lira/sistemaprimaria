<?php
// verificar_idalu.php
require_once "../models/Persona.php";

$persona = new alumno();

$idalu = isset($_GET['idalu']) ? limpiarCadena($_GET['idalu']) : "";

if (!empty($idalu)) {
    $existe = $persona->existeIdalu($idalu);
    echo $existe ? "true" : "false";
} else {
    echo "false";
}