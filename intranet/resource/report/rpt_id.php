<?php 
ob_start();
require "../config/Conexion.php";
$consulta="SELECT * FROM entidad";
$resultado=mysqli_query($conexion, $consulta);
$filae=mysqli_fetch_row($resultado) ;
require_once "../modelos/Persona.php";
include('../public/phpqrcode/qrlib.php');
$persona = new People();
$rspta = $persona->unique($_REQUEST["idalu"]);

require_once __DIR__ . '/../public/domPdf/vendor/autoload.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();


$html="";
$html.="
<link rel='stylesheet' href='css/stylesin.css'>	

<table  width='100%' style='font-size:10px; 	border-collapse:collapse;'>
	<tr>";
 $w=0;
 $i=1;
    while($reg= $rspta->fetch_object()){ 
      $id = $reg->idpeople;
      $name = $reg->nombre;
      $apellidos = $reg->apellidos;
      $idalu = $reg->idalu;
      $grado = $reg->grado;
      $seccion = $reg->seccion;
      $sexo = $reg->sexo;
      $qr=$reg->qr;
    $i++;
	$html.=	"
	<td class='line_carnet' width='8.6cm' >
					<table style=''width='100%' class='sub_table'>



						<tr>
						<td class='' rowspan='5' width='33%' style='padding-left: 16.2px; text-align:left;'><img width='50px' style='border-radius: 25px 25px 25px 25px;'  src='../files/ie/".$filae[3]."'/></td>
				        <td class='' colspan='2' rowspan='2' style='font-size:16.2px; color:  #fff; padding-top: 6px;'>".$filae[1]."</td>
				        
				      	</tr>

				      	<tr>
	
				      	</tr>

					<tr>
					
				        <td class='' colspan='2'>&nbsp;</td>
				     </tr>

				      					      	<tr>
	
				        <td class='' colspan='2'  rowspan='2' style='font-size:11px; padding-bottom:6px;'><b>".$apellidos.", ".$name."</b></td>
				      	</tr>

				      	<tr>

				      	</tr>



	
				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>

				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>
				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>


				      	<tr>
				        <td class='' >&nbsp;</td>
				        <td class='' colspan='' style='text-align:left;' width='32%'>GRADO &nbsp;&nbsp;&nbsp;: ".$grado."</td>
				        <td class='' rowspan='6' style='text-align:left;  '><img class='radius_img' src='../files/qrcodes/".$qr."'/></td>
				      	</tr>
				      	<tr>
				        <td class='' >&nbsp;</td>
				        <td class='' colspan='' style='text-align:left;'>SECCION : ".$seccion."</td>

				      	</tr>
				      	<tr>
				        <td class='' >&nbsp;</td>
				        <td class='' colspan='' style='text-align:left;'>SEXO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$sexo."</td>
				      	</tr>

				      	<tr>
				        <td class='' >&nbsp;</td>
				        <td class='' style='text-align:left;'>idalu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$idalu."</td>

				      	</tr>

				      	<tr>
				        <td class='' >&nbsp;</td>
				        <td class='' colspan='' style='text-align:left;'>&nbsp;</td>

				      	</tr>
				      	<tr>
				        <td class='' ></td>
				        <td class='' colspan='' style='text-align:left;'></td>
				      	</tr>

				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>


				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>

				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>
				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>

				      	<tr>
				        <td class='' ></td>
				        <td class='' style='text-align:left;'></td>
				        <td class='' ></td>
				      	</tr>

					</table>
	</td>";
	 if($i%2==1)
		{
			$html.="</tr>";
			$w++;
			}
		}
	$html.=	"</table>";

$dompdf->setPaper( array(0,0,247,157));
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('invoice.pdf',array("Attachment"=>false));


 ?>