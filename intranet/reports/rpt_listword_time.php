<?php
ob_start();
date_default_timezone_set('America/Regina');
require_once __DIR__ . '/../resource/phpword/vendor/autoload.php';

    $date_star= $_REQUEST['date_star']; 
    $date_end= $_REQUEST['date_end']; 
    $tipo_alumno= $_REQUEST['tipo_alumno']; 
    $datos1= $_REQUEST['datos1'];
    $datos2= $_REQUEST['datos2'];
    $timeingreso= $_REQUEST['timeingreso']; 
     if ($timeingreso!=0) {
        $timeingreso;
    } else {
        $timeingreso='';
    } 

	$aniostar= date("Y", strtotime($date_star));
	$messtar= date("m", strtotime($date_star));
	$diastar= date("d", strtotime($date_star));

	$anioend= date("Y", strtotime($date_end));
	$mesend= date("m", strtotime($date_end));
	$diaend= date("d", strtotime($date_end));


	$meses = array('ENERO',"FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$mes_star= date("m", strtotime($date_star));
	$mes_end= date("m", strtotime($date_end));


	$fecha_star=$meses[date($mes_star)-1];
	$fecha_end=$meses[date($mes_end)-1];

	$status_a=0;
	$status_tem=0;
	$status_tar=0;
	$status_f=0;
	$status_j=0;
	$newholidays=0;

	$range = 0;
	$ii=1;

require_once '../models/Reportsheet_time.php';
$obj=new Reportsheet(); 


$DBobj = $obj->listar();
$rows=$DBobj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;
$IMG ='../Resource/files/logo/'.$logo; 

        if($date_star<=$date_end){
                    $range= ((strtotime($date_end)-strtotime($date_star))+(24*60*60)) /(24*60*60);

                    if($range>31){

                        echo "<script>alert('El Rango Maximo es 31 Dias')</script>";
                        echo "<script>window.close();</script>";
                        exit;
                    }
        }else{
            echo "<script>alert('Rango Invalido')</script>";
            echo "<script>window.close();</script>";
                        exit;
        }

if($date_star==null and $date_end==null){
echo "<script>alert('Seleccione fecha')</script>";
            echo "<script>window.close();</script>";
                        exit;
}



use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
use PhpOffice\PhpWord\SimpleType\DocProtect;
use PhpOffice\PhpWord\Element\Section;

$phpWord = new  PhpOffice\PhpWord\PhpWord();
$phpWord->setDefaultFontSize(9);

$languageEsGb = new PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES);
$phpWord ->getSettings()->setThemeFontLang($languageEsGb);

$documentProtection = $phpWord->getSettings()->getDocumentProtection();
$documentProtection->setEditing(DocProtect::READ_ONLY);
$documentProtection->setPassword('report');

/*$section = $phpWord->addSection();*/
$section = $phpWord->addSection(array("orientation" => "landscape"));
/*$section = $phpWord->addSection( array("orientation" => "landscape", "marginLeft" => 600, "marginRight" => 600, "marginTop" => 600, "marginBottom" => 600) );*/



$fancyTableStyle = array('borderSize' => 6,'borderColor' => '92D050','alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => '#FFFFFF');
$cellRowContinue = array('vMerge' => 'continue');
$cellColSpan = array('gridSpan' => 2);
$cellColSpan3 = array('gridSpan' => 3);
$cellColSpan4 = array('gridSpan' => 4,'bgColor' => 'FFFFCC');

$cellColSpanrange = array('gridSpan' => $range,'bgColor' => '006B3D');
$cellHCentered = array('spaceBefore'=>5,'spaceAfter'=>5,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
$dafault = array('spaceBefore'=>5,'spaceAfter'=>5);
$cellVCentered = array('valign' => 'center');


if ($datos1=="" and $datos2=="") {
     $rspta = $obj->listarall($date_star,$date_end,$tipo_alumno,$timeingreso);
} else {
  $rspta = $obj->listarstudent($date_star,$date_end,$tipo_alumno,$datos1,$datos2,$timeingreso);
}


		    $ii = 1;
			if ($rows>0) {

			$table = $section->addTable("tables");
			$table->setWidth ( 100 * 50 );
			$phpWord->addTableStyle('tables', $fancyTableStyle);

			$table->addRow();
			$cell1 = $table->addCell(2000, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$textrun1->addImage($IMG, array(
			        'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(1),
			        'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(0.8),
			        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
			        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER,
			        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
			        'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
			        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
			    ));

			$cell2 = $table->addCell(4000, $cellColSpan4);
			$textrun2 = $cell2->addTextRun($cellHCentered);
			$textrun2->addText($institucion, null,$cellHCentered);


			$table->addRow();
			$table->addCell(null, $cellRowContinue);
			$cell2 = $table->addCell(4000, $cellColSpan4);
			$textrun2 = $cell2->addTextRun($cellHCentered);

			$textrun2->addText('LISTADO DE ASISTENCIAS', null,$cellHCentered);

			$table->addRow();
			$table->addCell(null, $cellRowContinue);
			$table->addCell(2000,array('bgColor' => 'FFFFCC'), $cellVCentered)->addText('GRADO ', null,$cellHCentered);
			$table->addCell(6000)->addText($datos1, null,$cellHCentered);
			$table->addCell(2000,array('bgColor' => 'FFFFCC'), $cellVCentered)->addText('GRUPO', null, $cellHCentered);
			$table->addCell(6000)->addText($datos2, null,$cellHCentered);

			$section->addTextBreak(1);

			$styleTable = array('borderSize' => 6, 'borderColor' => '92D050','size' => 8, 'cellMargin' => 30,'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
			$styleFirstRow = array('borderBottomColor' => 'FFFFFF', 'bgColor' => 'FFFFCC');

			$cell2 = array('gridSpan' => 2);
			$cellColor2 = array('gridSpan' => 2,'bgColor' => '006B3D');
			$cellColor4 = array('gridSpan' => 4,'bgColor' => '006B3D');
			$cellColor3 = array('gridSpan' => 3,'bgColor' => '006B3D');
			$cellColor5 = array('gridSpan' => 5,'bgColor' => '006B3D');
			$cellHCentered = array('spaceBefore'=>5,'spaceAfter'=>5,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);


			$table = $section->addTable("table");
			$table->setWidth ( 100 * 50 );


            $table->addRow();
            $table->addCell(null, $cellColor5)->addText('ALUMNO',array('color' => 'FFFFFF'),$cellHCentered);
			$table->addCell(null, $cellColor5)->addText('INFORMACIÓN',array('color' => 'FFFFFF'),$cellHCentered);
            //$table->addCell(null, $cellColor4)->addText($diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end,array('color' => 'FFFFFF'),$cellHCentered);

            $table->addRow();
            $table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('ID',array('color' => 'FFFFFF','size' => 8),$cellHCentered);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('IDALU',array('color' => 'FFFFFF','size' => 8),$dafault);; // Nueva columna "IDALU"
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('APELLIDOS',array('color' => 'FFFFFF','size' => 8),$dafault);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('NOMBRES',array('color' => 'FFFFFF','size' => 8),$dafault);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('GRADO',array('color' => 'FFFFFF','size' => 8),$dafault);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('GRUPO',array('color' => 'FFFFFF','size' => 8),$dafault);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('FECHA',array('color' => 'FFFFFF','size' => 8),$cellHCentered);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('H. ENTRADA',array('color' => 'FFFFFF','size' => 8),$cellHCentered);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('H. SALIDA',array('color' => 'FFFFFF','size' => 8),$cellHCentered);
			$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText('STATUS',array('color' => 'FFFFFF','size' => 8),$cellHCentered);


			$time_star= "";
			$tardanza= "";
			$i = 1;
			while ($reg=$rspta->fetch_object()){

			        if ($reg->kind_id==1) {
			                if ($reg->time_star<$timeingreso) {
			                    $tardanza="Temprano";
			                } elseif($reg->time_star>$timeingreso) { 
			                   if ($timeingreso=="00:00") {
			                        $tardanza= "Asistio";
			                    }elseif($reg->time_star>$timeingreso) {
			                           $tardanza= "Tarde ". $reg->tardanza;
			                    }
			                }elseif($reg->tardanza=$timeingreso){
			                    $tardanza="Temprano";
			                }

			        }else if($reg->kind_id==2){
			          $tardanza=  "Justificado";
			        }else if($reg->kind_id==3){                                              
			           $tardanza='Faltó';
			        }

			        if ($reg->kind_id==2 or $reg->kind_id==3) {
			            $time_star="";
			        } else {
			             $time_star=$reg->time_star;
			        }


            $table->addRow();
            $table->addCell()->addText($i,null,$cellHCentered);
			$table->addCell()->addText($reg->idalu,array('color' => '#000000'),$dafault); // Mostrar IDALU
            $table->addCell()->addText($reg->apellidos,array('color' => '000000'),$dafault);
            $table->addCell()->addText($reg->nombre,array('color' => '000000'),$dafault);
            $table->addCell()->addText($reg->datos1,array('color' => '#000000'),$dafault);
            $table->addCell()->addText($reg->datos2,array('color' => '#000000'),$dafault);
            $table->addCell()->addText($reg->fecha,array('color' => '#000000'),$cellHCentered);
            $table->addCell()->addText($time_star,array('color' => '#000000'),$cellHCentered);
            $table->addCell()->addText($time_end,array('color' => '#000000'),$cellHCentered);

            if ($tardanza=="Temprano") {
            	$table->addCell()->addText($tardanza,array('color' => '#087505'),$cellHCentered);
            }else if ($tardanza=="Asistio") {
				$table->addCell()->addText($tardanza,array('color' => '#087505'),$cellHCentered);
			}else if($tardanza=="Tarde ". $reg->tardanza){
				$table->addCell()->addText($tardanza,array('color' => '#EF870D'),$cellHCentered);
            }else if($tardanza=="Faltó"){
            	$table->addCell()->addText($tardanza,array('color' => '#FF0000'),$cellHCentered);
            }else if($tardanza=="Justificado"){
            	$table->addCell()->addText($tardanza,array('color' => '#1313D3'),$cellHCentered);
            }else{
            	$table->addCell()->addText($$tardanza,array('color' => '#000000'),$cellHCentered);
            }


			  $i++;
			  }

	}else{
            echo "<script>alert('No hay alumno seleccionado')</script>";
                        echo "<script>window.close();</script>";
                        exit;         
     }

$phpWord->addTableStyle('table', $styleTable,$styleFirstRow);



$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=DATA.docx");
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
ob_end_clean();
$objWriter->save('php://output');
Exit;


