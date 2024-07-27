var t;

function init() {
    listar();
    $("#formulario").on("submit", function(e) {
        saveupdate(e);
    });

    $("#logo").change(function() {
        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;

        if (fileSize > 1000000) {
            toastr.error("Error, Tamaño maximo permitido 1 MB");
            $("#logovisor").css("background-image", "url(https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1024px-Circle-icons-profile.svg.png)");
            this.value = '';
            this.files[0].name = '';

        }
    });

    $('#mentity').addClass("kt-menu__item--open kt-menu__item--here");
}



function clear() {
    $("#idinstitucion").val("");
    $("#nombre").val("");
    $("avenida").val("");
    $("#municipio").val("");
    $("#ciudad").val("");
    $("#estado").val("");
    $("#anio").val("");
    $("#logo").val("");
    $("#logoactual").val("");
    /*	$("#dnimg").val("");*/

}


function hidemoldal() {
    $("#kt_modal_1").modal('hide');
    $("#btnGuardar").prop("disabled", false);
    clear();
}

function showmoldal() {
    $("#kt_modal_1").modal('show');
    $("#btnGuardar").prop("disabled", false);
}


function listar() {

    t = $("#kt_table_1").DataTable({
        "language": {
            "url": "../resource/assets/js/Spanish.json"
        },
        responsive: !0,
        buttons: ["print", "excelHtml5", "pdfHtml5"],
        "aProcessing": true,
        "aServerSide": true,
        "lengthMenu": [5, 10, 25, 75, 100],

        "ajax": {
            url: '../controllers/entity.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "asc"]
        ],
        "lengthChange": false,
        "filter": false,
        paging: false,
        info: false,
    })

}



function saveupdate(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controllers/entity.php?op=saveupdate",
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


function view(idinstitucion) {
    $.post("../controllers/entity.php?op=view&idinstitucion=" + idinstitucion, function(data, status) {
        showmoldal();
        data = JSON.parse(data);
        $("#nombre").val(data.nombre);
        $("#avenida").val(data.avenida);
        $("#municipio").val(data.municipio);
        $("#ciudad").val(data.ciudad);
        $("#estado").val(data.estado);
        $("#anio").val(data.anio);
        $("#logoactual").val(data.logo);
        $("#idinstitucion").val(data.idinstitucion);
        $("#logovisor").css("background-image", "url(../resource/files/logo/" + data.logo + ")");

    })
}


init();