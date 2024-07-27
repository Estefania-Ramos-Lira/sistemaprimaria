var t;

function init(){

    viewform(false);
    listgroup();  
    $('#mreportl').addClass("kt-menu__item--open kt-menu__item--here");
    $('#ldgroupid').addClass("kt-menu__item--active");
} 

function limpiar()
{
    $("#tipo_alumno").val("");
    $("#datos1").val("");
    $("#datos2").val("");
    $("#date_star").val("");
    $("#date_end").val(""); 
    $("#view_pdf").html("");
}


function listgroup()
{
    $.post("../controllers/check_out.php?op=listgroup",function(r){
            $("#kt_table_group").html(r);
    });
}


function viewform(flag)
{

    if (flag)
    {
        
        $("#contend_group").hide();
        $("#contend_list").show();
        $("#contend_list1").show();
        $("#btnreturn").show();
        getinput();

    }
    else
    {

        $("#contend_group").show();
        $("#contend_list").hide();
        $("#contend_list1").hide();
        $("#lbltitle").html("GRUPOS - REPORTE GROUP");
        $("#kt_table_1").html("");

        $("#btnreturn").hide();

    }
}


function cancelform()
{
    viewform(false);
    limpiar();

}

function getinput(tipo_alumno,datos1,datos2)
{

    $("#tipo_alumno").val(tipo_alumno);
    $("#datos1").val(datos1);
    $("#datos2").val(datos2);

  if (tipo_alumno=='Estudiante') {
    $("#lbltitle").html("Asistencia Estudiantes"+" / "+ datos1 + " - " +datos2);
    $(".datos").show();
  }else{
     $("#lbltitle").html("Asistencia "+tipo_alumno+"s");
     $(".datos").hide();
  }
}


function viewpdf()
{
    var tipo_alumno = $("#tipo_alumno").val();
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
      
      if (date_star==0) {
        alert("SELECCIONE FECHA STAR");
        $("#view_pdf").html("");
      }else if(date_end==0){
        alert("SELECCIONE FECHA END");
        $("#view_pdf").html("");
      }else{
     $("#view_pdf").html('<embed src="../reports/rpt_list_group_id_pdf.php?&date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'" type="application/pdf" width="100%" height="100%"></embed>');
     }
}


init();