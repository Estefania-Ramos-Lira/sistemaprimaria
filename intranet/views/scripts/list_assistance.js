var t;

function init() {


    listar();
    $("#formulario").on("submit", function(e) {
        saveupdate(e);
    });
    $('#masistencias').addClass("kt-menu__item--open kt-menu__item--here");
    $('#lasistencias').addClass("kt-menu__item--active");
}


function hidemoldal() {
    $("#kt_modal_1").modal('hide');
    $("#btnSave").prop("disabled", false);
    clear();
}

function showmoldal() {
    $("#kt_modal_1").modal('show');
    $("#btnSave").prop("disabled", false);
    $("#lblmodal").html('<i class="fa fa-clock"></i> ACTUALIZAR HORA');
}


function clear() {
    $("#idalumno").val("");
    $("#idasistance").val("");
    $("#timestar").val("");
    $("#timeend").val("");
    $("#datestar").val("");
    $("#dateend").val("");

    $("#btnSave").prop("disabled", false);
}


function saveupdate(e) {
    e.preventDefault();
    $("#btnSave").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controllers/list_assistance.php?op=saveupdate",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            swal.fire("Exito!", datos, "success");
            hidemoldal();
            t.ajax.reload();
        }

    });
    clear();
}




function listar() {
    t = $("#kt_table_1").DataTable({
        "language": {
            "url": "../resource/assets/js/Spanish.json"
        },
        responsive: !0,
        "aProcessing": true,
        "aServerSide": true,
        "ajax": {
            url: '../controllers/list_assistance.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "order": [
            [0, "asc"]
        ],
    });

    // Actualizar las opciones de paginación después de inicializar la tabla
    t.page.len(100).draw(); // Establecer la longitud de página inicial en 100
    t.settings()[0].aLengthMenu = [[100, 150, 200, 250, 300], [100, 150, 200, 250, 300]]; // Actualizar las opciones de longitud de página
}


function vista(idassistance) {
    $.post("../controllers/list_assistance.php?op=vista", { idassistance: idassistance }, function(data, status) {
        data = JSON.parse(data);
        showmoldal();

        $("#idassistance").val(data.idassistance);
        $("#idalumno").val(data.idalumno);

        $("#namelast").html(data.apellidos + ",  " + data.nombre);
        $("#timestar").val(data.timestar);
        $("#timeend").val(data.timeend);
        $("#datestar").val(data.datestar);
        $("#dateend").val(data.dateend);


    })
}


function delet(idassistance) {
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
            $.post("../controllers/list_assistance.php?op=delete", { idassistance: idassistance }, function(e) {
                swal.fire("Exito!", e, "success");
                t.ajax.reload();
            });
        }
        t.ajax.reload();
    })
}
init();