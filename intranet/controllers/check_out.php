<?php 
require_once "../models/Check_out.php";
$DBobj=new Check_out();
switch ($_GET["op"]){

	case 'listgroup':

		$rspta_student = $DBobj->listgroup_student();
		$rspta_other = $DBobj->listgroup_other();
		echo '<thead>
                                <tr>
                                    <th class="dt-right sorting_disabled" rowspan="1" colspan="1" style="width: 200px;">
                                    </th>
                                    <th style="width: 200px;">
                                        
                                    </th>
                                    <th >GRADO - GRUPO
 									</th>
                                </tr>
               </thead><tbody>';

		while ($reg = $rspta_student->fetch_object())
				{
					echo '<tr>
							<td><button type="button" class="btn btn-secondary btn-sm" onclick="viewform(true);  getinput('.'\''.$reg->tipo_alumno.'\',\''.$reg->datos1.'\',\''.$reg->datos2.'\')">Seleccionar <i class="fa fa-arrow-right"></i></button></td>
							<td><a onclick="viewform(true);  getinput('.'\''.$reg->tipo_alumno.'\',\''.$reg->datos1.'\',\''.$reg->datos2.'\')" href="#">'.$reg->tipo_alumno.'</a></td>
							<td><a onclick="viewform(true);  getinput('.'\''.$reg->tipo_alumno.'\',\''.$reg->datos1.'\',\''.$reg->datos2.'\')" href="#">'.$reg->datos1.' - '.$reg->datos2.'</a></td>
						</tr>';	
				}


		while ($row = $rspta_other->fetch_object())
				{
					echo '<tr>
							<td><button type="button" class="btn btn-secondary btn-sm" onclick="viewform(true);  getinput('.'\''.$row->tipo_alumno.'\')">Seleccionar <i class="fa fa-arrow-right"></i></button></td>
							<td><a onclick="viewform(true);  getinput('.'\''.$row->tipo_alumno.'\',\''.$row->datos1.'\',\''.$row->datos2.'\')" href="#">'.$row->tipo_alumno.'</a></td>
							<td></td>
						</tr>';	
				}
			echo '</tbody>';
	break;


	case 'listassistance':
		$i=1;
		if ($_GET['datos1']==0 and $_GET['datos2']==0) {
			$rspta_student = $DBobj->listother($_GET['tipo_alumno']);
		} else {
			$rspta_student = $DBobj->liststudent($_GET['tipo_alumno'],$_GET['datos1'],$_GET['datos2']);
		}
		
		
		echo '<thead>
                                    <th>ID</th>
                                    <th>APELLIDOS Y NOMBRES</th>
                                    <th>STATUS</th>
                                    <th>DESCRIPCION</th>
               
              </thead><tbody>';

		while ($reg = $rspta_student->fetch_object()){
				$values = array("0"=>"Sin Seleccionar","2"=>"Justificacion"); 
				$rspta_assistance=$DBobj->listarassistance($reg->idalumno,$_GET['datesearch']);
                $rows=$rspta_assistance->fetch_object();		
				

			echo 		'<tr>
							<td><input type="hidden" name="idassistance[]" value="'.$rows->idassistance.'">
								<input type="hidden" name="idalumno[]" value="'.$reg->idalumno.'">'.$i.'</td>
							<td>'.$reg->apellidos.', '.$reg->nombre.'</td>';

							if ($rows->kind_id==1) {
			echo 		'<td>
							<select  style="color:green;" class="form-control form-control-sm"  name="kind_id[]" id="cbo'.$reg->idalumno.'" onclick="cbstatus('.$reg->idalumno.',\''.$rows->descripcion.'\');">

									<option value="1" selected>Asistio</option>
							</select></td>';
						
			echo 		'<td><textarea name="descripcion[]" class="form-control form-control-sm" id="txt'.$reg->idalumno.'" style="height:30px" disabled>'.$rows->descripcion.'</textarea></td>';								
			

							} else if ($rows->kind_id==3) {
			echo 		'<td>
							<select style="color:red;" class="form-control form-control-sm"  name="kind_id[]" id="cbo'.$reg->idalumno.'" onclick="cbstatus('.$reg->idalumno.',\''.$rows->descripcion.'\');">

									<option value="3" selected>Falto</option>
							</select></td>';
						
			echo 		'<td><textarea name="descripcion[]" class="form-control form-control-sm" id="txt'.$reg->idalumno.'" style="height:30px" disabled>'.$rows->descripcion.'</textarea></td>';								
							
							}else if ($rows->kind_id==2) {
								echo 		'<td>
							<select style="color:blue;" class="form-control form-control-sm"  name="kind_id[]" id="cbo'.$reg->idalumno.'" onclick="cbstatus('.$reg->idalumno.',\''.$rows->descripcion.'\');">';

						foreach($values as $k=>$v):

			echo 				'<option value="'.$k.'"';
							if($rows!=null && $rows->kind_id==$k){ 
								echo "selected"; 
								}
			echo 				'>'.$v.'</option>';		
						endforeach;	

			echo 			'</select>
						</td>';
						

			echo 		'<td><textarea name="descripcion[]" class="form-control form-control-sm" id="txt'.$reg->idalumno.'" style="height:30px" >'.$rows->descripcion.'</textarea></td>';
							} 
							 else  {

								echo 		'<td>
							<select  class="form-control form-control-sm"  name="kind_id[]" id="cbo'.$reg->idalumno.'" onclick="cbstatus('.$reg->idalumno.',\''.$rows->descripcion.'\');">';

						foreach($values as $k=>$v):

			echo 				'<option value="'.$k.'"';
							if($rows!=null && $rows->kind_id==$k){ 
								echo "selected"; 
								}
			echo 				'>'.$v.'</option>';		
						endforeach;	

			echo 			'</select>
						</td>';
						

			echo 		'<td><textarea name="descripcion[]" class="form-control form-control-sm" id="txt'.$reg->idalumno.'" style="height:30px" disabled>guardar como falta</textarea></td>';
								
							}
					echo'
						</tr>';
					$i++;	
				}
			echo '</tbody>';
	break;



case 'saveupdate':

for($i=0; $i<count($_POST['kind_id']); $i++){
    $kind_id = $_POST['kind_id'][$i];
    $idalumno = $_POST['idalumno'][$i];
    if ($kind_id==0) {
    	$rspta=$DBobj->insert($idalumno,$_POST['datesearch']);
    }elseif ($kind_id==2) {
    	$descripcion = $_POST['descripcion'][$i];
    	$idassistance = $_POST['idassistance'][$i];
    	if ($idassistance==0) {
    		$rspta=$DBobj->insertjustification($idalumno,$_POST['datesearch'],$descripcion);
    	} else {

    		$rspta=$DBobj->update($idassistance,$descripcion);
    	}
    }      
}

break;

}
?>