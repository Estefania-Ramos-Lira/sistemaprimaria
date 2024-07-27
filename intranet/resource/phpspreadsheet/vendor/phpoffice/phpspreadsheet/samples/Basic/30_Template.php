<?php

case 'libros_existentes_Excel':
                $query = "select r1.titulo,r1.id_libro,r1.stock,r2.autor,r1.codigo,r3.editorial,r1.isbn from libro r1 inner join autor r2 on r1.autor = r2.id_autor inner join editorial r3 on r1.editorial = r3.id_editorial where r1.estado <> 0";;
                $r = mysqli_query($connection,$query);
                    $info=array();
                    while( $datos = mysqli_fetch_array($r)){
                        $info[]=$datos; 
                    }
                    $info = json_decode( json_encode( $info ), true );
                    $tamaño = count($info);
                    $gdImage = imagecreatefrompng('img/rioja.png');
                    $c = 6;
                    require('Classes/PHPExcel.php');

                    $PHPExcel = new PHPExcel();
                    $PHPExcel->getProperties()->setCreator('Usuario')->setDescription('Libros Existentes');

                    $PHPExcel->setActiveSheetIndex(0);
                    $PHPExcel->getActiveSheet()->setTitle('Libros Existentes');

                    $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
                    $objDrawing->setName('Logotipo');
                    $objDrawing->setDescription('Logotipo');
                    $objDrawing->setImageResource($gdImage);
                    $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
                    $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
                    $objDrawing->setHeight(100);
                    $objDrawing->setCoordinates('A1');
                    $objDrawing->setWorksheet($PHPExcel->getActiveSheet());

                    $estiloTituloReporte = array(
                      'font' => array(
                      'name'      => 'Arial',
                      'bold'      => true,
                      'italic'    => false,
                      'strike'    => false,
                      'size' =>13
                        ),

                      'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID
                        ),

                      'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_NONE
                         )
                      ),

                      'alignment' => array(
                         'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                      )
                    );





                    $estiloTituloColumnas = array(
                      'font' => array(
                      'name'  => 'Arial',
                      'bold'  => true,
                      'size' =>10,
                      'color' => array(
                      'rgb' => 'FFFFFF'
                      )
                    ),
                      'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '538DD5')
                      ),
                      'borders' => array(
                      'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                      ),
                      'alignment' =>  array(
                      'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
                      )
                    );

                    $estiloInformacion = new PHPExcel_Style();

                    $estiloInformacion->applyFromArray( array(
                      'font' => array(
                      'name'  => 'Arial',
                      'color' => array(
                      'rgb' => '000000'
                      ),
                      'size' =>9
                    ),
                      'fill' => array(
                      'type'  => PHPExcel_Style_Fill::FILL_SOLID
                    ),
                      'borders' => array(
                      'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                      )
                    ),
                      'alignment' =>  array(
                      'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
                      )
                    ));

                    $PHPExcel->getActiveSheet()->getStyle('A1:F4')->applyFromArray($estiloTituloReporte);
                    $PHPExcel->getActiveSheet()->getStyle('A6:F6')->applyFromArray($estiloTituloColumnas);
                    
                    $PHPExcel->getActiveSheet()->setCellValue('C3', 'LIBROS EXISTENTES');
                    $PHPExcel->getActiveSheet()->mergeCells('C3:E3');

                    $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                    $PHPExcel->getActiveSheet()->setCellValue('A6', 'ITEM');
                    $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
                    $PHPExcel->getActiveSheet()->setCellValue('B6', 'TÍTULO');
                    $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
                    $PHPExcel->getActiveSheet()->setCellValue('C6', 'AUTOR');
                    $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
                    $PHPExcel->getActiveSheet()->setCellValue('D6', 'EDITORIAL');
                    $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
                    $PHPExcel->getActiveSheet()->setCellValue('E6', 'ISBN');
                    $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                    $PHPExcel->getActiveSheet()->setCellValue('F6', 'STOCK');

                    if($tamaño > 0){
                       foreach ($info as $v) {
                            $c = $c +1;

                                    $PHPExcel->getActiveSheet()->setCellValue('A'.$c,$c - 6);
                                    $PHPExcel->getActiveSheet()->setCellValue('B'.$c,$v['titulo']);
                                    $PHPExcel->getActiveSheet()->setCellValue('C'.$c,$v['autor']);
                                    $PHPExcel->getActiveSheet()->setCellValue('D'.$c,$v['editorial']);
                                    $PHPExcel->getActiveSheet()->setCellValue('E'.$c,$v['isbn']);
                                    $PHPExcel->getActiveSheet()->setCellValue('F'.$c,$v['stock']);  
                        }
                    }

                    $PHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:F".$c);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                     header('Content-Disposition: attachment;filename="Libros_existentes.xlsx"');
                     header('Cache-Control: max-age=0');
                     $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
                     $objWriter->save('php://output');
                     exit;
                break;
