<?php 

date_default_timezone_set('America/Regina');
    include('../resource/phpqrcode/qrlib.php'); 

    $dataContent = $_POST['dataContent'];
    $image_location = "../resource/files/generate_qr/";
    $image_name = $dataContent." ".date('d-m-Y-h-i-s').'.png';
    $calidad = $_POST['calidad'];
    $size = $_POST['size'];
    $frameSize = 1;

switch ($_GET["op"]){

    case 'generateqr':
        if (empty($dataContent)){
            foreach (glob($image_location.'*.*') as $v) {
               unlink($v);
            }

        }else{ 
        QRcode::png($dataContent, $image_location.$image_name, $calidad, $size,$frameSize); 
        echo '<img id="imj" download class="img-thumbnail" src="'.$image_location.$image_name.'" />';
        }

    break;
}

?>