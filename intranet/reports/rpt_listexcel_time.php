<?php
ob_start();
require_once __DIR__ . '/../resource/phpspreadsheet/vendor/autoload.php';

    $get_date_star= $_REQUEST['date_star'];
    
    if ($get_date_star==0) {
        $date_star=0;
    } else {
    $newstar=explode('/',$get_date_star);
    $getdaystar=$newstar[0];
    $getmonthstar=$newstar[1];
    $getyearstar=$newstar[2];
    $date_star= $getyearstar.'-'.$getmonthstar.'-'.$getdaystar;
    }


    $get_date_end= $_REQUEST['date_end'];

    if ($get_date_end==0) {
        $date_end=0;
    } else {
    $newend=explode('/',$get_date_end);
    $getdayend=$newend[0];
    $getmonthend=$newend[1];
    $getyearend=$newend[2];
    $date_end= $getyearend.'-'.$getmonthend.'-'.$getdayend;
    }

    
    $tipo_alumno= $_REQUEST['tipo_alumno']; 
    $datos1= $_REQUEST['datos1'];
    $datos2= $_REQUEST['datos2'];
    $timeingreso= $_REQUEST['timeingreso'];
     if ($timeingreso!=0) {
        $timeingreso;
    } else {
        $timeingreso='00:00';
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
    
require_once '../models/Reportsheet_time.php';
$DBobj=new Reportsheet();


$obj = $DBobj->listar();
$rows=$obj->fetch_object();
$institucion=$rows->nombre; 
$logo=$rows->logo;
$IMG = '../resource/files/logo/'.$logo; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\style\Alignment;
use PhpOffice\PhpSpreadsheet\style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

$spreadsheet = new Spreadsheet();
$sharedStyle1 = new Style();
$sharedStyle2 = new Style();
$sharedStyle3 = new Style();
$sharedStyle4 = new Style();

$sharedStyleimg = new Style();

$fontred = new Style();
$fontgreen = new Style();
$fontblue = new Style();
$fontorange = new Style();

$fontred->applyFromArray(
    ['font' => [
                  'color' => [
                      'rgb' => 'FF0000'
                  ]
              ],
      'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
     ]
);
$fontgreen->applyFromArray(
    ['font' => [
                  'color' => [
                      'rgb' => '008200'
                  ]
              ],
      'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
     ]
);

$fontblue->applyFromArray(
    ['font' => [
                  'color' => [
                      'rgb' => '1139D0'
                  ]
              ],
      'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
     ]
);

$fontorange->applyFromArray(
    ['font' => [
                  'color' => [
                      'rgb' => 'FFFFCC'
                  ]
              ],
      'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
     ]
);


$sharedStyle1->applyFromArray(
    ['fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '006B3D'],
            	],
     'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
             ],
      'font' => [
                  'color' => [
                      'rgb' => 'FFFFFF'
                  ]
              ]
     ]
);
 
$sharedStyle2->applyFromArray(
    ['fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFFFCC'],
              ],
     'alignment' => [
                  'horizontal' => Alignment::HORIZONTAL_CENTER,
                  'vertical' => Alignment::VERTICAL_CENTER,
                  'wrapText' => true,
              ],
     'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
    ]
);

$sharedStyle3->applyFromArray(
    ['borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
    ]

);

$sharedStyle4->applyFromArray(
    ['borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
    ]
);


$sharedStyleimg->applyFromArray(
    [
      'alignment' => [
                  'horizontal' => Alignment::HORIZONTAL_CENTER,
                  'vertical' => Alignment::VERTICAL_CENTER,
                  'wrapText' => true,
              ],
      'borders' => [
                'bottom' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'top' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'right' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]],
                'left' => ['borderStyle' => Border::BORDER_THIN,'color' => [
                          'rgb' => '92D050'
                      ]]
             ]
    ]
);
$drawing = new Drawing();
$drawing->setName('PhpSpreadsheet logo');
$drawing->setDescription('PhpSpreadsheet logo');
$drawing->setPath(__DIR__ . '/'.$IMG.'');
$drawing->setHeight(36);
$drawing->setCoordinates('A2');
$drawing->setOffsetY(-5);
$drawing->setOffsetX(10);
$drawing->setWorksheet($spreadsheet->getActiveSheet());



$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, 'A6:J6');


$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

$spreadsheet->getActiveSheet()->mergeCells("A1:A3");
$spreadsheet->getActiveSheet()->mergeCells("B1:J1");
$spreadsheet->getActiveSheet()->mergeCells("B2:J2");

$spreadsheet->getActiveSheet()->mergeCells("B3:D3");
$spreadsheet->getActiveSheet()->mergeCells("E3:J3");

$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyleimg, 'A1:A3');
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle2, 'B1:J2');
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle4, 'B3:J3');


$spreadsheet->getActiveSheet()->setCellValue('B1', $institucion);
$spreadsheet->getActiveSheet()->setCellValue('B2', "LISTADO DE ASISTENCIAS");

if ($datos1=="" and $datos2=="") {
     $rspta = $DBobj->listarall($date_star,$date_end,$tipo_alumno,$timeingreso);
        $spreadsheet->getActiveSheet()->setCellValue('B3', "GRADO: ". $tipo_alumno);
        $spreadsheet->getActiveSheet()->setCellValue('E3', "GRUPO: ". $tipo_alumno);
} else {
  $rspta = $DBobj->listarstudent($date_star,$date_end,$tipo_alumno,$datos1,$datos2,$timeingreso);

      $spreadsheet->getActiveSheet()->setCellValue('B3', "GRADO: ". $datos1);
      $spreadsheet->getActiveSheet()->setCellValue('E3', "GRUPO: ". $datos2);
}

$spreadsheet->getActiveSheet()->mergeCells("A5:E5");
$spreadsheet->getActiveSheet()->mergeCells("F5:J5");
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, 'A5:E5');
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle1, 'F5:J5');

$spreadsheet->getActiveSheet()->setCellValue('A5', "ALUMNO");
$spreadsheet->getActiveSheet()->setCellValue('F5', $diastar.' '.$fecha_star.' - '.$diaend.' '.$fecha_end);


$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A6', 'Item')
    ->setCellValue('B6', 'IDALU')
    ->setCellValue('C6', 'APELLIDOS')
    ->setCellValue('D6', 'NOMBRES')
    ->setCellValue('E6', 'DATOS1')
    ->setCellValue('F6', 'DATOS2')
    ->setCellValue('G6', 'FECHA')
    ->setCellValue('H6', 'H. ENTRADA')
    ->setCellValue('I6', 'H. SALIDA')
    ->setCellValue('J6', 'STATUS');

$tardanza= "";
$contentStartRow=1;
$currentContentRow=7;
while ($reg=$rspta->fetch_object()){

        if ($reg->kind_id==1) {

                if ($reg->time_star<$timeingreso) {
                    $tardanza= "Temprano"; 
                } elseif($reg->time_star>$timeingreso) { 
                   if ($timeingreso=="00:00") {
                        $tardanza= "Asistio";
                    }elseif($reg->time_star>$timeingreso) {
                        $tardanza= "Tarde";
                    }
                }elseif($reg->tardanza=$timeingreso){
                    $tardanza= "Temprano"; 
                }


        }else if($reg->kind_id==2){
          $tardanza=  "Justificado";
        }else if($reg->kind_id==3){                                              
           $tardanza=  "Faltó";
        }

         
        if ($reg->kind_id==2 or $reg->kind_id==3) {
           $time_star="";
        } else {
          $time_star=$reg->time_star;
        }


$spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1,1);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'A'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'B'.$currentContentRow); 
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'C'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'D'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'E'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'F'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'G'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'H'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'I'.$currentContentRow);
$spreadsheet->getActiveSheet()->duplicateStyle($sharedStyle3, 'J'.$currentContentRow);


if ($tardanza=="Temprano") {
  $spreadsheet->getActiveSheet()->duplicateStyle($fontgreen, 'J'.$currentContentRow);
} elseif($tardanza=="Tarde") {
  $spreadsheet->getActiveSheet()->duplicateStyle($fontorange, 'J'.$currentContentRow);
} elseif($tardanza=="Justificado") {
  $spreadsheet->getActiveSheet()->duplicateStyle($fontblue, 'J'.$currentContentRow);
}elseif($tardanza=="Faltó") {
  $spreadsheet->getActiveSheet()->duplicateStyle($fontred, 'J'.$currentContentRow);
}else{
  $spreadsheet->getActiveSheet()->duplicateStyle($fontgreen, 'J'.$currentContentRow);
}


$spreadsheet->getActiveSheet()->setCellValue('A'.$currentContentRow,$contentStartRow);
$spreadsheet->getActiveSheet()->setCellValue('B'.$currentContentRow,$reg->idalu);
$spreadsheet->getActiveSheet()->setCellValue('C'.$currentContentRow,$reg->apellidos);
$spreadsheet->getActiveSheet()->setCellValue('D'.$currentContentRow,$reg->nombre);
$spreadsheet->getActiveSheet()->setCellValue('E'.$currentContentRow,$reg->datos1);
$spreadsheet->getActiveSheet()->setCellValue('F'.$currentContentRow,$reg->datos2);
$spreadsheet->getActiveSheet()->setCellValue('G'.$currentContentRow,$reg->fecha);
$spreadsheet->getActiveSheet()->setCellValue('H'.$currentContentRow,$reg->time_star);
$spreadsheet->getActiveSheet()->setCellValue('I'.$currentContentRow,$reg->time_end);

if ($tardanza=="Tarde") {
      $spreadsheet->getActiveSheet()->setCellValue('j'.$currentContentRow,'Tarde '.$reg->tardanza);
}else{
  $spreadsheet->getActiveSheet()->setCellValue('j'.$currentContentRow,$tardanza);
}


$currentContentRow++;
$contentStartRow++;
}

$spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow,1);

$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
$spreadsheet->getActiveSheet()->setTitle('DATA');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=reportevotos.xlsx');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
ob_end_clean();
$writer->save('php://output');
Exit;
