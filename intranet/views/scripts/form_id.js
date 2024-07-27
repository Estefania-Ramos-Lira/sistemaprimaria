var t;

function init() {

    clear();
    listar();
    $("#form_identification").on("submit", function(e) {
        saveupdate(e);
    });
}


function clear() {
    $("#identificacion").val("");
    $("#btnSave").prop("disabled", false);
}


function saveupdate(e) {
    e.preventDefault();
    $("#btnSave").prop("disabled", true);
    var formData = new FormData($("#form_identification")[0]);

    $.ajax({
        url: "intranet/controllers/form_id.php?op=saveupdate",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {

            if (datos == 1) {
                Swal.fire({ type: 'success', title: 'Exito', text: 'Entrada registrada correctamente', showConfirmButton: false, timer: 1500 })
                var audio = document.getElementById("entrada");
                audio.play();
            } else if (datos == 2) {
                Swal.fire({ type: 'error', title: 'Error', text: 'Entrada no registrada', showConfirmButton: false, timer: 1500 })
                var audio = document.getElementById("error");
                audio.play();

            } else if (datos == 3) {
                swal.fire({ type: 'error', title: 'Adventencia!', text: 'Entrada ya Resgidrada, Espere un momento', showConfirmButton: false, timer: 1600 });
                var audio = document.getElementById("yamarco");
                audio.play();
            } else if (datos == 4) {
                Swal.fire({ type: 'success', title: 'Exito', text: 'Salida registrada correctamente', showConfirmButton: false, timer: 1500 })
                var audio = document.getElementById("salida");
                audio.play();
            } else if (datos == 5) {
                Swal.fire({ type: 'error', title: 'Error', text: 'Salida no registrada', showConfirmButton: false, timer: 1500 })
                var audio = document.getElementById("error");
                audio.play();
            } else if (datos == 6) {
                Swal.fire({ type: 'error', title: 'Error', text: 'Codigo Desonocido', showConfirmButton: false, timer: 1500 })
                var audio = document.getElementById("desconocido");
                audio.play();
            } else if (datos == 7) {
                Swal.fire({ type: 'error', title: 'Error', text: 'El alumno ya fue registrado con justificacion', showConfirmButton: false, timer: 2000 })
                 var audio=document.getElementById("justificacion");
                 audio.play();  
            } else if (datos == 8) {
                Swal.fire({ type: 'error', title: 'Error', text: 'El alumno ya fue registrado con falta', showConfirmButton: false, timer: 1500 })
                var audio=document.getElementById("falta");
                 audio.play();  
            } else if (datos == 9) {
                Swal.fire({ type: 'success', title: 'Exito', text: 'Entrada registrada correctamente', showConfirmButton: false, timer: 1500 })
            } else {
                Swal.fire({ type: 'error', title: 'Error', text: 'Digite codigo de Identificación', showConfirmButton: false, timer: 1500 })
                var audio = document.getElementById("idden");
                audio.play();

            }

            t.ajax.reload();
        }

    });
    clear();
}

function listar() {

    t = $("#kt_table_1").DataTable({
        "language": {
            "sEmptyTable": "No se encontro ningun registro de asistencia",
        },
        responsive: !0,
        buttons: ["print", "excelHtml5", "pdfHtml5"],
        "aProcessing": true,
        "aServerSide": true,
        "lengthMenu": [5, 10, 25, 75, 100],

        "ajax": {
            url: 'intranet/controllers/form_id.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },

        paging: false,
        searching: false,
        scrollY: '42vh',
        scrollCollapse: true,
        "ordering": false,
        "info": false,
        "bDestroy": true,

    })

}


init();