<?php 
require_once "../models/tutor.php"; 
include('../resource/phpqrcode/qrlib.php');

$tutor = new tutor();

$nombretutor = isset($_POST["nombretutor"]) ? limpiarCadena($_POST["nombretutor"]) : "";

switch ($_GET["op"]) {
    case 'saveupdate':
        if (empty($idalumno)) {
            $image_location = "../resource/files/qrcodes/";
            $codigo = $idalu . '.png';
            QRcode::png($idalu, $image_location . $codigo, $calidad, $tamanio, $borde);

            $rspta = $tutor->insertarTutor($idtutor, $idalumno, $nombretutor, $apellido);
            echo $rspta ? "registro guardado" : "registro no se pudo guardar";
        } else {
            if ($idalu <> $dnimg) {
                unlink('../resource/files/qrcodes/' . $dnimg . '.png');
            } 

            $image_location = "../resource/files/qrcodes/";
            $codigo = $idalu . '.png';
            QRcode::png($idalu, $image_location . $codigo, $calidad, $tamanio, $borde);

            $rspta = $tutor->updateTutor($idtutor, $idalumno, $nombretutor, $apellido);
            echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
        }
        break;

    case 'listar':
        $rspta = $tutor->listarTutor();
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "12" => $reg->nombretutor,
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

