var t;

function init() {
    listar();
    autocomplet();

    $("#date_star").change(listar);
    $("#date_end").change(listar);
    $('#mreportl').addClass("kt-menu__item--open kt-menu__item--here");
    $('#lddni').addClass("kt-menu__item--active");
}

function autocomplet() {
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

    $("#idalu").on("keydown", function(event) {
        if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
            $("#idalumno").val("");
            $('#names').val("");
            $('#apellidos').val("");

        }
        if (event.keyCode == $.ui.keyCode.DELETE) {
            $("#idalu").val("");
            $("#idalumno").val("");
            $('#names').val("");
            $('#apellidos').val("");

        }
    });
}



function listar() {
    var idalumno = $("#idalumno").val();
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();

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
            url: '../controllers/list.php?op=listar_id',
            data: { date_star: date_star, date_end: date_end, idalumno: idalumno },
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 4,

    })
}

function reportExcel() {

    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var idalumno = $("#idalumno").val();

    VentanaCentrada('../reports/rpt_listexcel_id.php?date_star=' + date_star + '&date_end=' + date_end + '&idalumno=' + idalumno, 'Reporte', '', '1024', '768', 'true');
}

function reportPdf() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var idalumno = $("#idalumno").val();

    VentanaCentrada('../reports/rpt_listpdf_id.php?date_star=' + date_star + '&date_end=' + date_end + '&idalumno=' + idalumno, 'Reporte', '', '1024', '768', 'true');
}


function reportWord() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var idalumno = $("#idalumno").val();

    VentanaCentrada('../reports/rpt_listword_id.php?date_star=' + date_star + '&date_end=' + date_end + '&idalumno=' + idalumno, 'Reporte', '', '1024', '768', 'true');
}

function reportPrint() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var idalumno = $("#idalumno").val();



    if (date_star == 0 || date_end == 0) {
        alert('seleccione fecha');

    } else {


        $('#divprint').load('../reports/rpt_listprint_id.php?date_star=' + date_star + '&date_end=' + date_end + '&idalumno=' + idalumno, function() {       var printContent = document.getElementById('divprint');       var WinPrint = window.open('', '', 'width=1024,height=768');      
            WinPrint.document.write(printContent.innerHTML);      
            WinPrint.document.close();      
            WinPrint.focus();      
            WinPrint.print();      
            WinPrint.close();     });

    }
} 
init();