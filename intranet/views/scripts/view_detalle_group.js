var t;

function init(){
    viewform(false);
    listgroup();
                
                $("#date_star").change(listar);
                $("#date_end").change(listar);
                $("#timeingreso").change(listar);

    $('#mreportl').addClass("kt-menu__item--open kt-menu__item--here"); // SE CAMBIA AL ID DE REPORTES LISTADO PORQUE ORIGINALMETE PERTENECIA AL DETALLADO (MREPORTM)
    $('#lgroup').addClass("kt-menu__item--active");
}

function limpiar()
{
    $("#tipo_alumno").val("");
    $("#datos1").val("");
    $("#datos2").val("");
    $("#date_star").val("");
    $("#date_end").val(""); 
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
        listar();
    }
    else
    {

        $("#contend_group").show();
        $("#contend_list").hide();
        $("#contend_list1").hide();
        $("#lbltitle").html("GRUPOS - REPORTE DETALLADO");
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
  }else{
     $("#lbltitle").html("Asistencia "+tipo_alumno+"s");
  }
}


function listar()
{
    var tipo_alumno = $("#tipo_alumno").val();
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var timeingreso = $("#timeingreso").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();

       $.post('../controllers/detallado.php?op=listar&date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,function(r){
                $("#kt_table_1").html(r);
        });

}

init();