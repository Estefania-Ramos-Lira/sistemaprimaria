var t;

function init() {
    listar();
    $("#formulario").on("submit", function(e) {
        saveupdate(e);
    });

    $.post("../controllers/usuario.php?op=permisos&id=", function(r) {
        $("#permisos").html(r);
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
    $('#macceso').addClass("kt-menu__item--open kt-menu__item--here");
    $('#lusuario').addClass("kt-menu__item--active");
    $("#htitle").html("AGREGAR");
}



function clear() {
    $("#idusuario").val("");
    $("#nombre").val("");
    $("#cargo").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#logo").val("");
    $("#logoactual").val("");
    $(".permisocheck").prop("checked", false);
    $("#htitle").html("AGREGAR");
    $("#logovisor").css("background-image", "url(https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1024px-Circle-icons-profile.svg.png)");
}


function hidemoldal() {
    $("#kt_modal_1").modal('hide');
    $("#btnSave").prop("disabled", false);
    clear();
}


function showmoldal() {
    $("#kt_modal_1").modal('show');
    $("#btnSave").prop("disabled", false);

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
            url: '../controllers/usuario.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [
                [0, "asc"]
            ] //Ordenar (columna,orden)
    })

}



function saveupdate(e) {
    e.preventDefault();
    $("#btnSave").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controllers/usuario.php?op=saveupdate",
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


function view(idusuario) {
    $.post("../controllers/usuario.php?op=view", { idusuario: idusuario }, function(data, status) {
        showmoldal();
        data = JSON.parse(data);
        $("#nombre").val(data.nombre);
        $("#cargo").val(data.cargo);
        $("#login").val(data.login);
        $("#clave").val(data.clave);
        $("#logoactual").val(data.imagen);
        $("#idusuario").val(data.idusuario);
        $("#logovisor").css("background-image", "url(../resource/files/usuarios/" + data.imagen + ")");
        $("#htitle").html("ACTUALIZAR");

    });

    $.post("../controllers/usuario.php?op=permisos&id=" + idusuario, function(r) {
        $("#permisos").html(r);
    });
}

function inactive(idusuario) {
    swal.fire({
        title: 'Advertencia',
        text: "¿Está Seguro de desactivar este registro?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            $.post("../controllers/usuario.php?op=inactive", { idusuario: idusuario}, function(e) {
                swal.fire("Exito!", e, "success");
                t.ajax.reload();
            });
        }
        t.ajax.reload();
    })
}



function active(idusuario) {
    swal.fire({
        title: 'Advertencia',
        text: "¿Está Seguro de activar este registro?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            $.post("../controllers/usuario.php?op=active", { idusuario: idusuario }, function(e) {
                swal.fire("Exito!", e, "success");
                t.ajax.reload();
            });
        }
        t.ajax.reload();
    })
}


function delet(idusuario) {
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
            $.post("../controllers/usuario.php?op=delete&idusuario=" + idusuario, function(e) {
                swal.fire("Exito!", e, "success");
                t.ajax.reload();
            });
        }
        t.ajax.reload();
    })
}

function validarPermisos() {
    const checkboxes = document.querySelectorAll('.permisocheck:checked');
    if (checkboxes.length === 0) {
      alert('Debe seleccionar al menos un permiso.');
      return false;
    }
    return true;
  }
  
  // Agrega un evento submit al formulario
  document.getElementById('formulario').addEventListener('submit', function(event) {
    if (!validarPermisos()) {
      event.preventDefault(); // Evita el envío del formulario si no se selecciona al menos un permiso
    }
  });



  // VALIDACIÓN PARA QUE SELECCIONE PERMISOS

  function validarPermisos() {
    var permisos = document.querySelectorAll('input.permisocheck:checked');
    return permisos.length > 0;
}

document.getElementById('btnSave').addEventListener('click', function(event) {
    if (!validarPermisos()) {
        event.preventDefault(); // Evita el envío del formulario
        alert('Debe seleccionar al menos un permiso para el usuario');
    }
});

init();