<?php 
ob_start();

$cboSelects=$_REQUEST["cboSelects"];
$card1=$_REQUEST["card1"];
$card2=$_REQUEST["card2"];

$colorheader="#".$_REQUEST["cardheader"];
$colorbody="#".$_REQUEST["cardbody"];
$letraheader="#".$_REQUEST["cardtextheader"];
$letrabody="#".$_REQUEST["cardtextbody"];

include '../models/Entity.php';
$entity=new Entity();
$obj = $entity->listar();
$rows=$obj->fetch_object();
$institucion=$rows->nombre; 

include '../models/Card.php';
$card = new Card();

if ($card1==0 and $card2==0 ) {
  $rspta = $card->card_categoria($cboSelects);
} else {
  $rspta = $card->card_study($cboSelects,$card1,$card2);
}

require_once __DIR__ . '/../resource/domPdf/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$html="";
$html.="
<link rel='stylesheet' href='css/styles.css'>	

<table width='48mm' style='font-size:9px;'>
  <tr>";

$i=1;

while($reg= $rspta->fetch_object()){ 
  $id = $reg->idalumno;
  $tipo_alumno = $reg->tipo_alumno;
  $name = $reg->nombre;
  $apellidos = $reg->apellidos;
  $idalu = $reg->idalu;
  $datos1 = $reg->datos1;
  $datos2 = $reg->datos2;

  if ($tipo_alumno=="Estudiante" and is_numeric($datos1)) {
    $datos1 = "Grado: ". $datos1;
    $datos2 = "Grupo: ". $datos2;
    $idalu = "Idalu: ". $idalu;
  } else if($tipo_alumno=="Estudiante" and is_string($datos1)){
    $datos1 =  $datos1;
    $datos2 =  $datos2;
  }

  $codigo=$reg->codigo;

  $html.= "
    <td class='line_carnet' width='48mm'>
      <table width='46.3mm' class='sub_table'>
        <tr>
          <td class='colorheader' COLSPAN='3' height='7.5mm' style='border:0.01px ".$colorheader." 0.01px solid; background-color: ".$colorheader.";color: ".$letraheader.";'>".$institucion."</td>
        </tr>
        <tr>
          <td height='10mm' style='border: 0.01px ".$colorheader." solid; background-color: ".$colorheader.";' rowspan='4'>&nbsp;</td>
          <td width='22.15mm' style='border: 0.01px #000000 solid;' rowspan='6'>&nbsp;</td>
          <td style='border: 0.01px ".$colorheader." solid; background-color: ".$colorheader.";' rowspan='4'>&nbsp;</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
          <td rowspan='2' height='12mm'>&nbsp;</td>
          <td rowspan='2'>&nbsp;</td>
        </tr>
        <tr></tr>
        <tr>
          <td class='bfont' height='2.5mm' style='background-color: ".$colorbody."; color:".$letrabody."; border: 0.01px ".$colorbody." solid; padding-top:2px' COLSPAN='3'>".$apellidos."</td>
        </tr>
        <tr>
          <td class='bfont' height='2.5mm' style='background-color: ".$colorbody."; color:".$letrabody."; border: 0.01px ".$colorbody." solid;' COLSPAN='3'>".$name."</td>
        </tr>
        <tr>
          <td COLSPAN='3'>".$datos1."</td>
        </tr>
        <tr>
          <td COLSPAN='3'>".$datos2."</td>
        </tr>
        <tr>
          <td COLSPAN='3'>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>".$idalu."</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td rowspan='4'><img class='radius_img alto' src='../resource/files/qrcodes/".$codigo."' /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>";

  if($i%5==0)
  {
    $html.="</tr><tr>";
  }

  $i++;
}

$html.= "</tr></table>";

ob_end_clean();
$dompdf->setPaper('A4', 'landscape');
$dompdf->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('invoice.pdf',array("Attachment"=>false));
?>