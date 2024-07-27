<?php
ob_start();
require('PDF_MC_Table.php');

$pdf=new PDF_MC_Table();
$pdf->AddPage();
$y_axis_initial = 25;
 

$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTADO DE ASISTENCIAS',1,0,'C'); 
$pdf->Ln(10);
 
$pdf->SetFillColor('#1F4279');
/*$pdf->SetTextColor('#ffffff');*/
$pdf->SetDrawColor('#1F4279'); 
$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,6,'NIVEL',1,0,'C',1);
$pdf->Cell(40,6,'APELLIDOS',1,0,'C',1);
$pdf->Cell(30,6,'NOMBRE',1,0,'C',1);
$pdf->Cell(12,6,'GRADO',1,0,'C',1);
$pdf->Cell(15,6,'SECCION',1,0,'C',1);
$pdf->Cell(16,6,'FECHA',1,0,'C',1);
$pdf->Cell(16,6,'ENTRADA',1,0,'C',1);
$pdf->Cell(16,6,'SALIDA',1,0,'C',1);
$pdf->Cell(16,6,'TARDANZA',1,0,'C',1);

 
$pdf->Ln(7);

require_once "../modelos/Rptworking.php";
$consultas = new Consultas();
		$nivel= $_REQUEST['nivel'];
		$grado= $_REQUEST['grado'];	
		$seccion= $_REQUEST['seccion'];	
		$fecha_inicio= $_REQUEST['fecha_inicio'];	
		$fecha_fin= $_REQUEST['fecha_fin'];	
		$diferencia= $_REQUEST['diferencia'];	
    	$f2=new DateTime($diferencia);

if ($nivel<>"" and $grado=="" and $seccion=="") {
	$rspta = $consultas->nivelr($nivel,$fecha_inicio,$fecha_fin,$diferencia);
} else {
	$rspta = $consultas->level($nivel,$grado,$seccion,$fecha_inicio,$fecha_fin,$diferencia);
}

$pdf->SetDrawColor('#565B5F');
$pdf->SetTextColor('black');
$pdf->SetWidths(array(30,40,30,12,15,16,16,16,16));

while($reg= $rspta->fetch_object())
{  
    $nivel = $reg->nivel;
    $apellidos = $reg->apellidos;
    $nombre = $reg->nombre;
    $grado = $reg->grado;
    $seccion = $reg->seccion;
    $fecha = $reg->fecha;
    $entrada = $reg->entrada;
    $salida = $reg->salida;
    $diferencia = $reg->diferencia;

    $f1=new DateTime($entrada);
    $tdd=$f1->diff($f2);
    $td=$tdd->format('%H:%I:%S');


 	$pdf->SetFont('Arial','',7);

 		    $pdf->Row(
    	array($nivel,
    		 $apellidos,
    		 $nombre,
    		 $grado,
    		 $seccion,
    		 $fecha,
    		 $entrada,
    		 $salida,
    		 $diferencia)
    );

 	



}

$pdf->Output();
ob_end_flush();

?>