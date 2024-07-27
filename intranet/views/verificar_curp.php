<?php
// verificar_curp.php
require_once "../models/Persona.php";

$persona = new alumno();

$curp = isset($_GET['curp']) ? limpiarCadena($_GET['curp']) : "";

if (!empty($curp)) {
    $existe = $persona->existeCurp($curp);
    echo $existe ? "true" : "false";
} else {
    echo "false";
}