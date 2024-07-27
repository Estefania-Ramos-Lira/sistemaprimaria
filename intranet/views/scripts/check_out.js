var t;

function init(){
	viewform(false);
	listgroup();
	listassistance();
	$("#datesearch").change(listassistance);
	cbstatus();

    $('#masistencias').addClass("kt-menu__item--open kt-menu__item--here");
    $('#lcheckout').addClass("kt-menu__item--active");


	$("#formulario").on("submit",function(e)
	{

		swal.fire({
			title: 'Advertencia',
			text: "Los registros 'sin seleccionar' se guardaran como falta",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancel',
			confirmButtonText: 'Ok'
		}).then((result) => {
			if (result.value) {
				saveupdate(e);
			}
		})
	});
}


function limpiar()
{
	$("#tipo_alumno").val("");
	$("#datos1").val("");
	$("#datos2").val("");

		//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#datesearch').val(today);

}


function listgroup()
{
 	$.post("../controllers/check_out.php?op=listgroup",function(r){
	        $("#kt_table_group").html(r);
	});
}

function viewform(flag)
{
	/*limpiar();*/
	if (flag)
	{
		
		$("#contend_group").hide();
		$("#lbltitle").html("ASISTENCIA");
		$("#contend_list").show();
		$("#btnreturn").show();
		getinput();
		
/*		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();*/
	}
	else
	{
		$("#contend_group").show();
		$("#contend_list").hide();
		$("#lbltitle").html("GRUPOS");
		$("#btnreturn").hide();

		
/*		$("#btnagregar").show();*/
	}
}


function cancelform()
{
	/*limpiar();*/
	viewform(false);
	limpiar();
}

function getinput(tipo_alumno,datos1,datos2)
{
	$("#tipo_alumno").val(tipo_alumno);
	$("#datos1").val(datos1);
	$("#datos2").val(datos2);
	var datesearch= $("#datesearch").val();

		$.post("../controllers/check_out.php?op=listassistance&datesearch="+datesearch+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2,function(r){
	        $("#kt_table_assistance").html(r);
	});
}





function listassistance()

{
	var tipo_alumno= $("#tipo_alumno").val();
	var datos1= $("#datos1").val();
	var datos2= $("#datos2").val();
	var datesearch= $("#datesearch").val();

	

 	$.post("../controllers/check_out.php?op=listassistance&datesearch="+datesearch+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2,function(r){
	        $("#kt_table_assistance").html(r);
	});
}



function saveupdate(e)
{
	e.preventDefault();
	$("#btnsave").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controllers/check_out.php?op=saveupdate",
	    type: "POST",
	    data: formData,
	    contentType: false, 
	    processData: false,

	    success: function(datos)
	    {                
	         toastr.success("Dia cerrado con exito"); 	
	    }

	});
cancelform();
}



function bntcopy()
{
      $("#btnsave").submit();
}


function cbstatus($idealumno,$txtdescripcion){
	var cbostatus=$("#cbo"+$idealumno).val();
	 $("#cbo"+$idealumno).change(function () {
        $("#cbo"+$idealumno+" option:selected").each(function () {
          seleccion=$(this).val();
          if (seleccion==0) {
          	$("#txt"+$idealumno).val("Guardar como falta"); 
          	 $("#txt"+$idealumno).prop("disabled", true); 
              

          }else{
            
            $("#txt"+$idealumno).prop("disabled", false); 
          	$("#txt"+$idealumno).val($txtdescripcion); 
          }


     });

      });
}


init();