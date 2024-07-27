var t;

function init(){
	autocomplet();
    $('#mreportd').addClass("kt-menu__item--open kt-menu__item--here");
    $('#ldni').addClass("kt-menu__item--active");
}


function viewpdf()
{
	var idalumno = $("#idalumno").val();
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var timeingreso = $("#timeingreso").val();
      
      
    if (idalumno==0) {
    	alert("SELECCIONE alumno");
        $("#view_pdf").html("");
     }else if (date_star==0) {
        alert("SELECCIONE FECHA STAR");
        $("#view_pdf").html("");
      }else if(date_end==0){
        alert("SELECCIONE FECHA END");
        $("#view_pdf").html("");
      }else{
	      $("#view_pdf").html('<embed src="../reports/rpt_identification.php?&date_star='+date_star+'&date_end='+date_end+'&idalumno='+idalumno+'&timeingreso='+timeingreso+'" type="application/pdf" width="100%" height="100%"></embed>');
	     }
}


function autocomplet()
{
					$("#idalu").autocomplete({
							source: "../controllers/identification.php?op=autocomplete",
							minLength: 1,

							select: function(event, ui) {
								event.preventDefault();
								$('#idalumno').val(ui.item.idalumno);
								$('#idalu').val(ui.item.idalu);
								$('#names').val(ui.item.nombre);
								$('#apellidos').val(ui.item.apellidos);
							}
						});

					$("#idalu" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#idalumno" ).val("");
							$('#names').val("");
							$('#apellidos').val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#idalu" ).val("");
							$("#idalumno" ).val("");
							$('#names').val("");
							$('#apellidos').val("");

						}
					});	
}



init(); 