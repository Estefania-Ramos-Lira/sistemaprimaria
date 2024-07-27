/*var t;
var calendar;
function init(){
	
	listar();
	cbcondition();

	$("#formulario").on("submit",function(e)
	{
		saveupdate(event);

	});
calendar.refetchEvents();	
    $('#mcalendar').addClass("kt-menu__item--open kt-menu__item--here");
}



function clear()
{
	$("#idcalendar").val("");
	$("#idcalendar_delete").val("");
	$("#start").val("");
	$("#end").val("");
	$("#tipo").val("1");
	$("#title").val("FERIADO");
	$("#color").val("#FF0000"); 
}


function hidemoldal()
{
	$("#kt_modal_add").modal('hide');
	$("#btnSave").prop("disabled",false);
	clear();
}

function showmoldal()
{
	$("#kt_modal_add").modal('show');
	$("#btnSave").prop("disabled",false);
}


function listar() {

    var initialLocaleCode = 'es';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      locale: initialLocaleCode,
      selectable: true,
      selectHelper:true,
      buttonIcons: true, 
      weekNumbers: true,
      navLinks: true, 
      editable: true,
      dayMaxEvents: true, 
      events: '../controllers/calendar.php?op=listar',

    select: function(info) {

        $('#kt_modal_add #start').val(info.start.toLocaleString());
        $('#kt_modal_add #end').val(info.end.toLocaleString());
        showform(true);
        $("#ModalLabel").html('AGREGAR EVENTO');
        $("#tipo").val("1");
		$("#title").val("FERIADO");
		$("#color").val("#FF0000");   
        $('#kt_modal_add #cbstatus').hide();
        $('#kt_modal_add').modal('show');
    },
    eventDrop: function(info) {
	    var start = info.event.start.toLocaleString();
	    var end = info.event.end.toLocaleString();
	    var idcalendar =  info.event.id;

         $.ajax({
          url:'../controllers/calendar.php?op=updateDrop',
          type:"get",
          data:{start:start, end:end, idcalendar:idcalendar},
          success:function(data){
            swal.fire("Exito!",data,"success"); 
            calendar.refetchEvents();
          }
         });
    },

    eventClick: function(info) {
    var id = info.event.id;

		$.post("../controllers/calendar.php?op=views&id="+id, function(data, status){
			data = JSON.parse(data);

	    	$('#kt_modal_add #idcalendar').val(data.idcalendar);
	    	$('#kt_modal_add #title').val(info.event.title);
	        $('#kt_modal_add #start').val(info.event.start.toLocaleString());
	        $('#kt_modal_add #end').val(info.event.end.toLocaleString());
	        $('#kt_modal_add #color').val(data.color);
	        $('#kt_modal_add #tipo').val(data.tipo);
	        $('#kt_modal_add #status').val(data.status);
       		
       		var tipo
	        if (data.tipo==1) {
	        	tipo="Feriado / Celebracion";
	        }else{
	        	tipo="Nota";
	        }

	        if (data.status==1) {
	        	status="Activo";
	        }else{
	        	status="Inactivo";
	        }

	    	$('#kt_modal_add #idcalendar_delete').val(data.idcalendar);
	    	$('#kt_modal_add #td_title').html(info.event.title);
	        $('#kt_modal_add #td_start').html(info.event.start.toLocaleString());
	        $('#kt_modal_add #td_end').html(info.event.end.toLocaleString());
	        $('#kt_modal_add #td_condition').html(status);
	        $('#kt_modal_add #td_tipo').html(tipo);

	        $('#kt_modal_add #cbstatus').show();
	        showform(false);
	        $('#kt_modal_add').modal('show');

	 	})

    },

    eventResize: function(info) {

	    var start = info.event.start.toLocaleString();
	    var end = info.event.end.toLocaleString();
	    var idcalendar =  info.event.id;

         $.ajax({
          url:'../controllers/calendar.php?op=updateResize',
          type:"get",
          data:{start:start, end:end, idcalendar:idcalendar},
          success:function(data){
            swal.fire("Exito!",data,"success"); 
            calendar.refetchEvents();
          }
    });
  },


    });

    calendar.render();    
}


function saveupdate(event)
{
	event.preventDefault();
	$("#btnSave").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controllers/calendar.php?op=saveupdate",
	    type: "POST",
	    data: formData,
	    contentType: false, 
	    processData: false,
	    success: function(datos)
	    {                
	          swal.fire("Exito!",datos,"success");	         
	          hidemoldal();
	          calendar.refetchEvents();
	    }
	});
	clear();
}



function delet()
{
	var idcalendar=$("#idcalendar_delete").val();
	swal.fire({
		title: 'Advertencia',
		text: "¿Está Seguro de eliminar este registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../controllers/calendar.php?op=delete&idcalendar="+idcalendar, function(e){						        		
				swal.fire("Exito!",e,"success");
				hidemoldal();
				
			});
		}
	})
}




function cbcondition(){
	var cbostatus=$("#tipo").val();

	if (cbostatus==1) {
		$("#title").val("FERIADO");
		$("#color").val("#FF0000");  
	}


	 $("#tipo").change(function () {
        $("#tipo option:selected").each(function () {
          seleccion=$(this).val();
          if (seleccion==1) {
          	$("#title").val("FERIADO");
          	$("#color").val("#FF0000");                

          }else{
			$("#title").val("");
			$("#color").val("#2372BC");   
          }
     });

      });
}


function showform(flag)
{

    if (flag){
       $("#formulario_delete").hide();
       $("#formulario").show();  
       $("#ModalLabel").html('EDITAR EVENTO');       	       

    }else{
       $("#formulario_delete").show();
       $("#formulario").hide();
       $("#ModalLabel").html('VISTA EVENTO'); 

    }
}


init();*/



document.addEventListener('DOMContentLoaded', function() {
 $('#mcalendar').addClass("kt-menu__item--open kt-menu__item--here");
 cbcondition();   


    var initialLocaleCode = 'es';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      locale: initialLocaleCode,
      selectable: true,
      selectHelper:true,
      buttonIcons: true, 
      weekNumbers: true,
      navLinks: true, 
      editable: true,
      dayMaxEvents: true, 
      events: '../controllers/calendar.php?op=listar',

    select: function(info) {

        $('#kt_modal_add #start').val(info.start.toLocaleString());
        $('#kt_modal_add #end').val(info.end.toLocaleString());
        showform(true);
        $("#ModalLabel").html('AGREGAR EVENTO');
        $("#tipo").val("1");
		$("#title").val("FERIADO");
		$("#color").val("#FF0000");   
        $('#kt_modal_add #cbstatus').hide();
        $('#kt_modal_add').modal('show');
    },
    eventDrop: function(info) {
	    var start = info.event.start.toLocaleString();
	    var end = info.event.end.toLocaleString();
	    var idcalendar =  info.event.id;

         $.ajax({
          url:'../controllers/calendar.php?op=updateDrop',
          type:"get",
          data:{start:start, end:end, idcalendar:idcalendar},
          success:function(data){
            swal.fire("Exito!",data,"success"); 
            calendar.refetchEvents();
          }
         });
    },


    eventResize: function(info) {

	    var start = info.event.start.toLocaleString();
	    var end = info.event.end.toLocaleString();
	    var idcalendar =  info.event.id;

         $.ajax({
          url:'../controllers/calendar.php?op=updateResize',
          type:"get",
          data:{start:start, end:end, idcalendar:idcalendar},
          success:function(data){
            swal.fire("Exito!",data,"success"); 
            calendar.refetchEvents();
          }
	    });
	 },


    eventClick: function(info) {
    var id = info.event.id;

		$.post("../controllers/calendar.php?op=views&id="+id, function(data, status){
			data = JSON.parse(data);

	    	$('#kt_modal_add #idcalendar').val(data.idcalendar);
	    	$('#kt_modal_add #title').val(info.event.title);
	        $('#kt_modal_add #start').val(info.event.start.toLocaleString());
	        $('#kt_modal_add #end').val(info.event.end.toLocaleString());
	        $('#kt_modal_add #color').val(data.color);
	        $('#kt_modal_add #tipo').val(data.tipo);
	        $('#kt_modal_add #status').val(data.status);
       		
       		var tipo
	        if (data.tipo==1) {
	        	tipo="Feriado / Celebracion";
	        }else{
	        	tipo="Nota";
	        }

	        if (data.status==1) {
	        	status="Activo";
	        }else{
	        	status="Inactivo";
	        }

	    	$('#kt_modal_add #idcalendar_delete').val(data.idcalendar);
	    	$('#kt_modal_add #td_title').html(info.event.title);
	        $('#kt_modal_add #td_start').html(info.event.start.toLocaleString());
	        $('#kt_modal_add #td_end').html(info.event.end.toLocaleString());
	        $('#kt_modal_add #td_condition').html(status);
	        $('#kt_modal_add #td_tipo').html(tipo);

	        $('#kt_modal_add #cbstatus').show();
	        showform(false);
	        $('#kt_modal_add').modal('show');

	 	});

	 	    $('body').on('click', '#delet', function() {

					var idcalendar=$("#idcalendar_delete").val();
					swal.fire({
						title: 'Advertencia',
						text: "¿Está seguro de eliminar este registro?",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						cancelButtonText: 'No',
						confirmButtonText: 'Si'
					}).then((result) => {
						if (result.value) {
							$.post("../controllers/calendar.php?op=delete&idcalendar="+idcalendar, function(e){						        		
								swal.fire("Exito!",e,"success");
								hidemoldal();
								calendar.refetchEvents();
							});

							  
						}
					});
            });
            
            calendar.refetchEvents();
  		  },
    });

    calendar.render();   




    $('#formulario').submit(function(event) {
        event.preventDefault();
		$("#btnSave").prop("disabled",true);
		var formData = new FormData($("#formulario")[0]);
		$.ajax({

			url: "../controllers/calendar.php?op=saveupdate",
		    type: "POST",
		    data: formData,
		    contentType: false, 
		    processData: false,
		    success: function(datos)
		    {       
		          swal.fire("Exito!",datos,"success");	         
		          hidemoldal();
		          calendar.refetchEvents();
		    }
		});

		clear();
    });


});


	function clear()
	{
		$("#idcalendar").val("");
		$("#idcalendar_delete").val("");
		$("#start").val("");
		$("#end").val("");
		$("#tipo").val("1");
		$("#title").val("FERIADO");
		$("#color").val("#FF0000"); 
	}


	function hidemoldal()
	{
		$("#kt_modal_add").modal('hide');
		$("#btnSave").prop("disabled",false);
		clear();
	}

	function showmoldal()
	{
			$("#kt_modal_add").modal('show');
		$("#btnSave").prop("disabled",false);
	}


function showform(flag)
{

    if (flag){
       $("#formulario_delete").hide();
       $("#formulario").show();  
       $("#ModalLabel").html('EDITAR EVENTO');       	       

    }else{
       $("#formulario_delete").show();
       $("#formulario").hide();
       $("#ModalLabel").html('VISTA EVENTO'); 

    }
}


function cbcondition(){
	var cbostatus=$("#tipo").val();

	if (cbostatus==1) {
		$("#title").val("FERIADO");
		$("#color").val("#FF0000");  
	}


	 $("#tipo").change(function () {
        $("#tipo option:selected").each(function () {
          seleccion=$(this).val();
          if (seleccion==1) {
          	$("#title").val("FERIADO");
          	$("#color").val("#FF0000");                

          }else{
			$("#title").val("");
			$("#color").val("#2372BC");   
          }
     });

      });
}