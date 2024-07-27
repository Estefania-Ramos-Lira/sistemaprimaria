<?php 
require_once "../models/edad.php"; 
include('../resource/phpqrcode/qrlib.php');

$edad = new edad();

$edadsiceeo = isset($_POST["edadsiceeo"]) ? limpiarCadena($_POST["edadsiceeo"]) : "";
$edadestadistica = isset($_POST["edadestadistica"]) ? limpiarCadena($_POST["edadestadistica"]) : "";

switch ($_GET["op"]) {
    case 'saveupdate':
        if (empty($idalumno)) {
            $image_location = "../resource/files/qrcodes/";
            $codigo = $idalu . '.png';
            QRcode::png($idalu, $image_location . $codigo, $calidad, $tamanio, $borde);

            $rspta = $tutor->insertarEdad($idedad, $idalumno, $edadsiceeo, $edadestadistica);
            echo $rspta ? "registro guardado" : "registro no se pudo guardar";
        } else {
            if ($idalu <> $dnimg) {
                unlink('../resource/files/qrcodes/' . $dnimg . '.png');
            } 

            $image_location = "../resource/files/qrcodes/";
            $codigo = $idalu . '.png';
            QRcode::png($idalu, $image_location . $codigo, $calidad, $tamanio, $borde);

            $rspta = $tutor->updateEdad($idedad, $idalumno, $edadsiceeo, $edadestadistica);
            echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
        }
        break;

    case 'listar':
        $rspta = $tutor->listarEdad();
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "13" => $reg->edadsiceeo,
                "14" => $reg->edadestadistica,
            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;
}
?>
