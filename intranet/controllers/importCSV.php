<?php
require_once "../models/ImportCSV.php";
$DBobj=new Import();

include('../resource/phpqrcode/qrlib.php');
$calidad='H';
$tamanio=5;
$borde=1;
$image_location = "../resource/files/qrcodes/";

switch ($_GET["op"]) {
    case 'saveupdate':
        $csv = isset($_POST["customFile"]) ? limpiarCadena($_POST["customFile"]) : "";
        $csv = $_FILES['customFile']['tmp_name'];

        if ($csv == null) {
            echo $rspta = 1;
        } else {
            $handle = fopen($csv, 'r');
            while ($data = fgetcsv($handle, 10000, ",", "'")) {
                $linea[] = array(
                    'tipo_alumno' => $data[0],
                    'nombre' => $data[1],
                    'apellidos' => $data[2],
					'idalu' => $data[3],
                    'datos1' => $data[4],
                    'datos2' => $data[5],
					'nespeciales' => $data[6],
                    'gpreescolar' => $data[7],
                    'edadsiceeo' => $data[8],
                    'edadestadistica' => $data[9],
                    'nombretutor' => $data[10]
                );
            }

            foreach ($linea as $indice) {
                $tipo_alumno = $indice["tipo_alumno"];

                $nombre = $indice["nombre"];
                $apellidos = $indice["apellidos"];
				$idalu = $indice["idalu"];
                $datos1 = $indice["datos1"];
                $datos2 = $indice["datos2"];
				$nespeciales = $indice["nespeciales"];
                $gpreescolar = $indice["gpreescolar"];
                $edadsiceeo = $indice["edadsiceeo"];
                $edadestadistica = $indice["edadestadistica"];
                $nombretutor = $indice["nombretutor"];
                $codigo = $idalu . ".png";
                QRcode::png($idalu, $image_location . $codigo, $calidad, $tamanio, $borde);
                $rspta_alumno = $DBobj->insert($tipo_alumno, $nombre, $apellidos, $idalu,$datos1, $datos2, $nespeciales, $gpreescolar, $codigo);

				// Llamar a las funciones de inserción para el tutor y la edad
                $rspta_tutor = $DBobj->insertTutor($nombretutor);
                $rspta_edad = $DBobj->insertEdad($edadsiceeo, $edadestadistica);
            }
				// Comprobar si todas las inserciones fueron exitosas
				echo $rspta = $rspta_alumno && $rspta_tutor && $rspta_edad ? "registros importados Satisfactoriamente" : "registros no se pudieron importar";
            //echo $rspta ? "registros importados Satisfactoriamente" : "registros no se pudieron importar";
        }
        break;
}

?> 