var t;

function init() {
    /*    buscar(); */
    listar();
    viewform(false);
    listgroup();

    $("#date_star").change(listar);
    $("#date_end").change(listar);
    $("#timeingreso").change(listar);
    $('#mreportl').addClass("kt-menu__item--open kt-menu__item--here");
    $('#ldgrouptime').addClass("kt-menu__item--active");
}

function limpiar() {
    $("#tipo_alumno").val("");
    $("#datos1").val("");
    $("#datos2").val("");
    $("#date_star").val("");
    $("#date_end").val("");
}


function listgroup() {
    $.post("../controllers/check_out.php?op=listgroup", function(r) {
        $("#kt_table_group").html(r);
    });
}


function viewform(flag) {

    if (flag) {

        $("#contend_group").hide();
        $("#contend_list").show();
        $("#contend_list1").show();
        $("#btnreturn").show();
        listar();
        getinput();

    } else {

        $("#contend_group").show();
        $("#contend_list").hide();
        $("#contend_list1").hide();
        $("#lbltitle").html("GRUPOS - REPORTE LISTADO");
        $("#kt_table_1").html("");
        $("#btnreturn").hide();

    }
}


function cancelform() {
    viewform(false);
    limpiar();

}

function getinput(tipo_alumno, datos1, datos2) {


    $("#tipo_alumno").val(tipo_alumno);
    $("#datos1").val(datos1);
    $("#datos2").val(datos2);

    if (tipo_alumno == 'Estudiante') {
        $("#lbltitle").html("Asistencia Estudiantes" + " / " + datos1 + " - " + datos2);
    } else {
        $("#lbltitle").html("Asistencia " + tipo_alumno + "s");
    }
}



function listar() {
    var tipo_alumno = $("#tipo_alumno").val();
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();



    t = $("#kt_table_1").DataTable({
        "language": {
            "url": "../resource/assets/js/Spanish.json"
        },
        responsive: !0,
        dom: "<'row'<'col-sm-6 text-left'><'col-sm-6 text-right'>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>",
        buttons: [],
        "aProcessing": true,
        "aServerSide": true,
        "lengthMenu": [5, 10, 25, 75, 100],

        "ajax": {
            url: '../controllers/list.php?op=listar_time',
            data: { date_star: date_star, date_end: date_end, tipo_alumno: tipo_alumno, datos1: datos1, datos2: datos2, timeingreso: timeingreso },
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5,

    })
}

init();