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

require_once "../models/Reportsheetdetalle.php";
$obj=new Reportsheetdetalle();

$DBobj = $obj->listar();
$rows=$DBobj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;
$IMG ='../resource/files/logo/'.$logo; 

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

//$documentProtection = $phpWord->getSettings()->getDocumentProtection();
//$documentProtection->setEditing(DocProtect::READ_ONLY);
//$documentProtection->setPassword('report');

/*$section = $phpWord->addSection();*/
$section = $phpWord->addSection(array("orientation" => "landscape"));
/*$section = $phpWord->addSection( array("orientation" => "landscape", "marginLeft" => 600, "marginRight" => 600, "marginTop" => 600, "marginBottom" => 600) );*/





$table = $section->addTable();
$table->addRow();

// Celda izquierda para el primer logo
$cell1 = $table->addCell(3333, array('valign' => 'center', 'vMerge' => 'restart'));
$cell1->addImage("../resource/files/logo/logosep.png", array('width' => 130, 'height' => 60));

// Celda central vacía
$cell2 = $table->addCell(25000, array('valign' => 'center'));
$cell2->addText('');

// Celda derecha para el segundo logo
$cell3 = $table->addCell(3333, array('valign' => 'center', 'vMerge' => 'restart'));
$cell3->addImage("../resource/files/logo/logo2.png", array('width' => 155, 'height' => 70));



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
	$rspta=$obj->listaralumno($tipo_alumno);
    $rows = $rspta->num_rows;
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
$table->addCell(2000,array('bgColor' => 'FFFFCC'), $cellVCentered)->addText('GRADO: ', null,$cellHCentered);
$table->addCell(6000)->addText($tipo_alumno, null,$cellHCentered);
$table->addCell(2000,array('bgColor' => 'FFFFCC'), $cellVCentered)->addText('GRUPO:', null, $cellHCentered);
$table->addCell(6000)->addText($tipo_alumno, null,$cellHCentered);

$section->addTextBreak(1);

$styleTable = array('borderSize' => 6, 'borderColor' => '92D050','size' => 8, 'cellMargin' => 30,'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
$styleFirstRow = array('borderBottomColor' => 'FFFFFF', 'bgColor' => 'FFFFCC');

$cellColor2 = array('gridSpan' => 2,'bgColor' => '006B3D');
$cellColor4 = array('gridSpan' => 4,'bgColor' => '006B3D');
$cellHCentered = array('spaceBefore'=>5,'spaceAfter'=>5,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);

$table = $section->addTable("table");
$table->setWidth ( 100 * 50 );


            $table->addRow();
            $table->addCell(null, $cellColor2)->addText('DATOS ALUMNOS',array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(null, $cellColSpanrange)->addText($diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end,array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(null, $cellColor4)->addText('ESTADO',array('color' => 'FFFFFF'),$cellHCentered);


			$table->addRow();
			$table->addCell(NULL,array('vMerge' => 'restart','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText("IDALU",array('color' => 'FFFFFF'),$cellHCentered);
			$table->addCell(NULL,array('vMerge' => 'restart','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText("APELLIDOS Y NOMBRES",array('color' => 'FFFFFF'),$dafault);

			for($i=0;$i<$range;$i++){ 
				$table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText(date("d",strtotime($date_star)+($i*(24*60*60))),array('color' => 'FFFFFF','size' => 8),$cellHCentered);
			}

			$table->addCell(NULL,array('vMerge' => 'restart','bgColor' => '16903E'))->addText("A",array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'restart','bgColor' => 'FF0000'))->addText("F",array('color' => 'FFFFFF'),$cellHCentered);
			$table->addCell(NULL,array('vMerge' => 'restart','bgColor' => '0000FF'))->addText("J",array('color' => 'FFFFFF'),$cellHCentered);

            $table->addRow();
            $table->addCell(NULL,array('vMerge' => 'continue','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'));
            $table->addCell(NULL,array('vMerge' => 'continue','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'));

            for($i=0;$i<$range;$i++): 
                $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                $newdia= date("w",strtotime($newdate));
                                if ($newdia==1) {
                                   $newdia="L";
                                } else if($newdia==2 or $newdia==3) {
                                    $newdia="M";
                                }elseif ($newdia==4) {
                                   $newdia="J";
                                }elseif($newdia==5){
                                    $newdia="V";
                                }elseif ($newdia==6) {
                                    $newdia="S";
                                }elseif ($newdia==0) {
                                    $newdia="D";
                                }

                $table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText($newdia,array('color' => 'FFFFFF','size' => 8),$cellHCentered);
           endfor;

            $table->addCell(NULL,array('vMerge' => 'continue','bgColor' => '16903E'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'continue','bgColor' => 'FF8400'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'continue','bgColor' => '0000FF'),$cellHCentered);
			

			 while ($regss=$rspta->fetch_object()) {

				$table->addRow();
				$table->addCell()->addText($ii,null,$cellHCentered);
                $table->addCell(4000)->addText($regss->apellidos." ".$regss->nombre."", array('color' => '000000'),$dafault);

                        for($i=0;$i<$range;$i++):
                            $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                            $newdate_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                            $new_date= date("d",strtotime($newdate_at));

                            $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at,$tipo_alumno);
                            $reg=$rspta_assistance->fetch_object();

                            $rspta_holidays=$obj->listarholidays($newdate_at);
                            $row=$rspta_holidays->fetch_object();
                            $newholidays= date("Y-m-d",strtotime($row->dateholidays));

                            $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                        $newdia= date("w",strtotime($newdate));
                                        if ($newdia==1) {
                                           $newdia="L";
                                        } else if($newdia==2 or $newdia==3) {
                                            $newdia="M";
                                        }elseif ($newdia==4) {
                                           $newdia="J";
                                        }elseif($newdia==5){
                                            $newdia="V";
                                        }elseif ($newdia==6) {
                                            $newdia="S";
                                        }elseif ($newdia==0) {
                                            $newdia="D";
                                        }

                                $v = "";

                                    if($reg!=null){
                                         if ($reg->kind_id==1) {
                                            if($reg->time_star==$timeingreso){
                                                $v="A";
                                            }elseif ($reg->time_star<$timeingreso) {
                                                 $v="A";
                                            } elseif($reg->time_star>$timeingreso) {
                                               if ($timeingreso==null) {
                                                      $v="A";
                                                }
                                            }
                                        }else if($reg->kind_id==2){                                                     
                                             $v="J";
                                        }else if($reg->kind_id==3){                                                     
                                             $v="F";
                                        }                         

                                     } else {
                                        if($newdate_at==$newholidays){
                                            $v="C";
                                        } else{
                                            $v="";
                                        }
                                    }


                                    if($v=="A"){
                                                $table->addCell()->addText('√',array('color' => '06810F'),$cellHCentered);
                                    }elseif($v=="J"){
                                                $table->addCell()->addText($v,array('color' => '043EFA'),$cellHCentered);
                                    }elseif($v=="F"){
                                                $table->addCell()->addText($v,array('color' => 'FA0404'),$cellHCentered);
                                    }else{

                                        if ($newdia=="S") {
                                                 $table->addCell(null,array('bgColor' => '#FFD966'))->addText('',array('color' => '#000000'),$cellHCentered);              
                                        }elseif($newdia=="D"){
                                                    $table->addCell(null,array('bgColor' => '#FFD966'))->addText('',array('color' => '#000000'),$cellHCentered); 
                                        }else{
                                            if ($v == "C") {
                                                // Obtener el color de la base de datos para la fecha actual
                                                $query = "SELECT color FROM calendar WHERE start = '$date_at'";
                                                $result = $conexion->query($query);
                                                
                                                if ($result->num_rows > 0) {
                                                    $row = $result->fetch_assoc();
                                                    $color = $row['color'];
                                                } else {
                                                    // Color predeterminado si no se encuentra un registro para la fecha actual
                                                    $color = '#C65911';
                                                }
                                                
                                                $table->addCell(null, array('bgColor' => $color))->addText($v, array('color' => 'FFFFFF'), $cellHCentered);
                                            } else{
                                                      $table->addCell()->addText($v,null,$cellHCentered); 
                                            }
                                        }
                                    }

                        endfor;  $ii++;

                                    $rspt_j=$obj->listarj($regss->idalumno,$date_star,$date_end);
                                    $result_j=$rspt_j->fetch_object();
                                    if($result_j!=null){
                                        $status_j=$result_j->total;
                                    }else{
                                      $status_j='0';  
                                    }


                                    $rspt_f=$obj->listarf($regss->idalumno,$date_star,$date_end);
                                    $result_f=$rspt_f->fetch_object();
                                    if($result_f!=null){
                                        $status_f=$result_f->total;
                                    }else{
                                      $status_f='0';  
                                    }


                                    $rspt_a=$obj->listar_a_total($regss->idalumno,$date_star,$date_end);
                                    $result_a=$rspt_a->fetch_object();

                                    if ($timeingreso==null) {
                                        if ($result_a!=null) {
                                                         $status_a=$result_a->total;
                                        $table->addCell()->addText($status_a,array('color' => '000000'),$cellHCentered);
                                        } else {
                                        
                                        $table->addCell()->addText('0',array('color' => '000000'),$cellHCentered);
                                        }

                                    }else{

                                        $rspt_tem=$obj->listar_a_tem($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tem=$rspt_tem->fetch_object();

                                        
                                        if ($result_tem==null) {
                                        $table->addCell()->addText('0',array('color' => '000000'),$cellHCentered);
                                        } else {
                                           $status_tem=$result_tem->total;
                                        $table->addCell()->addText($status_tem,array('color' => '000000'),$cellHCentered);
                                        }
                                                                              

                                        
                                    }

                $table->addCell()->addText($status_f,array('color' => '000000'),$cellHCentered);
                $table->addCell()->addText($status_j,array('color' => '000000'),$cellHCentered);
                
            }
	}else{
            echo "<script>alert('No hay alumno seleccionado')</script>";
                        echo "<script>window.close();</script>";
                        exit;         
     }



} else {

    $rspta=$obj->listarstudent($tipo_alumno,$datos1,$datos2);
    $rows = $rspta->num_rows;
 
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
$table->addCell(2000,array('bgColor' => 'FFFFCC'), $cellVCentered)->addText('GRADO: ', null,$cellHCentered);
$table->addCell(6000)->addText($datos1, null,$cellHCentered);
$table->addCell(2000,array('bgColor' => 'FFFFCC'), $cellVCentered)->addText('GRUPO:', null, $cellHCentered);
$table->addCell(6000)->addText($datos2, null,$cellHCentered);

$section->addTextBreak(1);

$styleTable = array('borderSize' => 6, 'borderColor' => '92D050','size' => 8, 'cellMargin' => 30,'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
$styleFirstRow = array('borderBottomColor' => 'FFFFFF', 'bgColor' => 'FFFFCC');

$cellColor2 = array('gridSpan' => 2,'bgColor' => '006B3D');
$cellColor4 = array('gridSpan' => 4,'bgColor' => '006B3D');
$cellHCentered = array('spaceBefore'=>5,'spaceAfter'=>5,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);

$table = $section->addTable("table");
$table->setWidth ( 100 * 50 );
 
            $table->addRow();
            $table->addCell(null, $cellColor2)->addText('DATOS ALUMNOS',array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(null, $cellColSpanrange)->addText($diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end,array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(null, $cellColor4)->addText('ESTADO',array('color' => 'FFFFFF'),$cellHCentered);


            $table->addRow();
            $table->addCell(NULL,array('vMerge' => 'restart','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText("IDALU",array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'restart','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText("APELLIDOS Y NOMBRES",array('color' => 'FFFFFF'),$dafault);

            for($i=0;$i<$range;$i++){ 
                $table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText(date("d",strtotime($date_star)+($i*(24*60*60))),array('color' => 'FFFFFF','size' => 8),$cellHCentered);
            }

            $table->addCell(NULL,array('vMerge' => 'restart','bgColor' => '16903E'))->addText("A",array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'restart','bgColor' => 'FF0000'))->addText("F",array('color' => 'FFFFFF'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'restart','bgColor' => '0000FF'))->addText("J",array('color' => 'FFFFFF'),$cellHCentered);

            $table->addRow();
            $table->addCell(NULL,array('vMerge' => 'continue','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'));
            $table->addCell(NULL,array('vMerge' => 'continue','borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'));

            for($i=0;$i<$range;$i++): 
                $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                $newdia= date("w",strtotime($newdate));
                                if ($newdia==1) {
                                   $newdia="L";
                                } else if($newdia==2 or $newdia==3) {
                                    $newdia="M";
                                }elseif ($newdia==4) {
                                   $newdia="J";
                                }elseif($newdia==5){
                                    $newdia="V";
                                }elseif ($newdia==6) {
                                    $newdia="S";
                                }elseif ($newdia==0) {
                                    $newdia="D";
                                }

                $table->addCell(NULL,array('borderBottomColor' => 'FFFFFF', 'bgColor' => '006B3D'))->addText($newdia,array('color' => 'FFFFFF','size' => 8),$cellHCentered);
           endfor;

            $table->addCell(NULL,array('vMerge' => 'continue','bgColor' => '16903E'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'continue','bgColor' => 'FF8400'),$cellHCentered);
            $table->addCell(NULL,array('vMerge' => 'continue','bgColor' => '0000FF'),$cellHCentered);
            

             while ($regss=$rspta->fetch_object()) {

                $table->addRow();
                $table->addCell()->addText($regss->idalu,null,$cellHCentered);
                $table->addCell(4000)->addText($regss->apellidos." ".$regss->nombre."", array('color' => '000000'),$dafault);

                        for($i=0;$i<$range;$i++):
                            $date_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));

                            $newdate_at= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                            $new_date= date("d",strtotime($newdate_at));

                            $rspta_assistance=$obj->listarassistance($regss->idalumno,$date_at);
                            $reg=$rspta_assistance->fetch_object();
                            
                            $rspta_holidays=$obj->listarholidays($newdate_at);
                            $row=$rspta_holidays->fetch_object();
                            $newholidays= date("Y-m-d",strtotime($row->dateholidays));
                            

                            $newdate= date("Y-m-d",strtotime($date_star)+($i*(24*60*60)));
                                        $newdia= date("w",strtotime($newdate));
                                        if ($newdia==1) {
                                           $newdia="L";
                                        } else if($newdia==2 or $newdia==3) {
                                            $newdia="M";
                                        }elseif ($newdia==4) {
                                           $newdia="J";
                                        }elseif($newdia==5){
                                            $newdia="V";
                                        }elseif ($newdia==6) {
                                            $newdia="S";
                                        }elseif ($newdia==0) {
                                            $newdia="D";
                                        }

                                $v = "";

                                    if($reg!=null){
                                         if ($reg->kind_id==1) {
                                            if($reg->time_star==$timeingreso){
                                                $v="A";
                                            }elseif ($reg->time_star<$timeingreso) {
                                                 $v="A";
                                            } elseif($reg->time_star>$timeingreso) {
                                               if ($timeingreso==null) {
                                                      $v="A";
                                                }
                                            }
                                        }else if($reg->kind_id==2){                                                     
                                             $v="J";
                                        }else if($reg->kind_id==3){                                                     
                                             $v="F";
                                        }                         

                                     } else {
                                        if($newdate_at==$newholidays){
                                            $v="C";
                                        } else{
                                            $v="";
                                        }
                                    }


                                    if($v=="A"){
                                                $table->addCell()->addText('√',array('color' => '06810F'),$cellHCentered);
                                    }elseif($v=="J"){
                                                $table->addCell()->addText($v,array('color' => '043EFA'),$cellHCentered);
                                    }elseif($v=="F"){
                                                $table->addCell()->addText($v,array('color' => 'FA0404'),$cellHCentered);
                                    }else{

                                        if ($newdia=="S") {
                                                 $table->addCell(null,array('bgColor' => '#FFD966'))->addText('',array('color' => '#000000'),$cellHCentered);              
                                        }elseif($newdia=="D"){
                                                    $table->addCell(null,array('bgColor' => '#FFD966'))->addText('',array('color' => '#000000'),$cellHCentered); 
                                        }else{
                                            if ($v == "C") {
                                                // Obtener el color de la base de datos para la fecha actual
                                                $query = "SELECT color FROM calendar WHERE start = '$date_at'";
                                                $result = $conexion->query($query);
                                                
                                                if ($result->num_rows > 0) {
                                                    $row = $result->fetch_assoc();
                                                    $color = $row['color'];
                                                } else {
                                                    // Color predeterminado si no se encuentra un registro para la fecha actual
                                                    $color = '#C65911';
                                                }
                                                
                                                $table->addCell(null, array('bgColor' => $color))->addText($v, array('color' => 'FFFFFF'), $cellHCentered);
                                            } else{
                                                      $table->addCell()->addText($v,null,$cellHCentered); 
                                            }
                                        }
                                    }

                            endfor;  $ii++;

                                    $rspt_j=$obj->listarj($regss->idalumno,$date_star,$date_end);
                                    $result_j=$rspt_j->fetch_object();
                                    if($result_j!=null){
                                        $status_j=$result_j->total;
                                    }else{
                                      $status_j='0';  
                                    }


                                    $rspt_f=$obj->listarf($regss->idalumno,$date_star,$date_end);
                                    $result_f=$rspt_f->fetch_object();
                                    if($result_f!=null){
                                        $status_f=$result_f->total;
                                    }else{
                                      $status_f='0';  
                                    }


                                    $rspt_a=$obj->listar_a_total($regss->idalumno,$date_star,$date_end);
                                    $result_a=$rspt_a->fetch_object();

                                    if ($timeingreso==null) {
                                        if ($result_a!=null) {
                                                         $status_a=$result_a->total;
                                        $table->addCell()->addText($status_a,array('color' => '000000'),$cellHCentered);
                                         } else {
                                       $table->addCell()->addText('0',array('color' => '000000'),$cellHCentered);
                                        }

                                    }else{

                                        $rspt_tem=$obj->listar_a_tem($regss->idalumno,$date_star,$date_end,$timeingreso);
                                        $result_tem=$rspt_tem->fetch_object();

                                        
                                        
                                        if ($result_tem==null) {
                                        $table->addCell()->addText('0',array('color' => '000000'),$cellHCentered);
                                        } else {
                                           $status_tem=$result_tem->total;
                                        $table->addCell()->addText($status_tem,array('color' => '000000'),$cellHCentered);
                                        }
                                                                              

                                        
                                    }

                $table->addCell()->addText($status_f,array('color' => '000000'),$cellHCentered);
                $table->addCell()->addText($status_j,array('color' => '000000'),$cellHCentered);
                
            }
    }else{
            echo "<script>alert('No hay alumno seleccionado')</script>";
                        echo "<script>window.close();</script>";
                        exit;         
     }

}

$phpWord->addTableStyle('table', $styleTable,$styleFirstRow);


$section->addTextBreak(1);
$style = array('borderSize' => 6, 'borderColor' => '92D050','size' => 7, 'cellMargin' => 30);
$Row = array('borderBottomColor' => 'FFFFFF', 'bgColor' => 'FFFFCC');

$Color2 = array('bgColor' => '006B3D');
$Color4 = array('bgColor' => 'FFFFFF');
$HCentered = array('spaceBefore'=>3,'spaceAfter'=>3,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);

$Centered = array('spaceBefore'=>3,'spaceAfter'=>3);
$table = $section->addTable("table_legenda");

$table->addRow();
        $table->addCell(1500, $Color2)->addText('√',array('color' => 'FFFFFF'),$HCentered);
        $table->addCell(3000, $Color4)->addText('Asistio',array('color' => '000000'),$Centered);
$table->addRow();
        $table->addCell(null, $Color2)->addText('F',array('color' => 'FFFFFF'),$HCentered);
        $table->addCell(null, $Color4)->addText('Faltó',array('color' => '000000'),$Centered);
$table->addRow();
        $table->addCell(null, $Color2)->addText('J',array('color' => 'FFFFFF'),$HCentered);
        $table->addCell(null, $Color4)->addText('Justificación',array('color' => '000000'),$Centered);
$table->addRow();
        $table->addCell(null, $Color2)->addText('C',array('color' => 'FFFFFF'),$HCentered);
        $table->addCell(null, $Color4)->addText('Celebracion/Feriado',array('color' => '000000'),$Centered);

$phpWord->addTableStyle('table_legenda', $style);


/*$section = $phpWord->addSection( array("marginLeft" => 600, "marginRight" => 600, "marginTop" => 600, "marginBottom" => 600) );*/
/*$section= $phpWord->addSection(array("orientation" => "landscape"));*/

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=DATA.docx");
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
ob_end_clean();
$objWriter->save('php://output');
Exit;
