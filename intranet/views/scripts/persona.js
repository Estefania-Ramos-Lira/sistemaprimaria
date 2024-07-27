var t;

function init() {

    listar();
    textupdate();
    lblupdatecard();
    $("#formulario").on("submit", function(e) {
        saveupdate(e);
    });

    $("#formulario_import").on("submit",function(e)
    {
        saveupdatecsv(e);   
    });

    $('#malumno').addClass("kt-menu__item--open kt-menu__item--here");
}

    // Agregar la funcionalidad para calcular automáticamente la edad del alumno
    $('#nacimiento').on('change', function() {
        var fechaNacimiento = new Date($(this).val());
        var fechaHoy = new Date();
        var edadSiceeo = fechaHoy.getFullYear() - fechaNacimiento.getFullYear();

        // Ajustar la edad si aún no se ha cumplido el cumpleaños este año
        if ((fechaNacimiento.getMonth() > 8) || (fechaNacimiento.getMonth() === 8 && fechaNacimiento.getDate() > 30)) {
            edadSiceeo++;
        }

        // Calcular la edad estadística
        var edadEstadistica = fechaHoy.getFullYear() - fechaNacimiento.getFullYear();
        if (fechaHoy.getMonth() >= 9) { // Si estamos en octubre o posterior
            // No hacer nada, mantener la edadEstadistica igual a la edad actual
        }

        // Establecer el valor calculado en el campo de edadsiceeo
        $('#edadsiceeo').val(edadSiceeo);

        // Establecer el valor calculado en el campo de edadestadistica
        $('#edadestadistica').val(edadEstadistica);

        // Mostrar una advertencia si la fecha de nacimiento seleccionada es menor o igual a 4 años
        var cuatroAnosAtras = new Date();
        cuatroAnosAtras.setFullYear(cuatroAnosAtras.getFullYear() - 4);
        var diferenciaEnMilisegundos = fechaHoy.getTime() - fechaNacimiento.getTime();
        var cuatroAnosEnMilisegundos = 4 * 365 * 24 * 60 * 60 * 1000; // 4 años en milisegundos
        if (diferenciaEnMilisegundos <= cuatroAnosEnMilisegundos) {
            $('#nacimiento-warning').show();
            console.log('Advertencia mostrada');
        } else {
            $('#nacimiento-warning').hide();
            console.log('Advertencia oculta');
        }
    });
    
    // Función para limpiar la advertencia de fecha de nacimiento
function limpiarAdvertenciaNacimiento() {
    $('#nacimiento-warning').hide();
}

// Evento de clic para limpiar la advertencia de fecha de nacimiento al cerrar el formulario
document.querySelector('.btn-secondary[data-dismiss="modal"]').addEventListener("click", limpiarAdvertenciaNacimiento);

// Evento de clic para limpiar la advertencia de fecha de nacimiento al guardar el formulario
document.getElementById("btnGuardar").addEventListener("click", limpiarAdvertenciaNacimiento);





 /////////////////// IDALU //////////////////////////////////
 
 
// Obtener referencias a los elementos del DOM
const idaluInput = document.getElementById('idalu');
const idaluWarning = document.getElementById('idalu-warning');


// Función para realizar la solicitud AJAX
function verificarIdalu() {
    const idalu = idaluInput.value.trim();
    if (idalu !== '') {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'verificar_idalu.php?idalu=' + idalu, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const existe = xhr.responseText === 'true';
                idaluWarning.style.display = existe ? 'inline' : 'none';
            }
        };
        xhr.send();
    } else {
        idaluWarning.style.display = 'none';
    }
}

// Agregar event listener al campo idalu
idaluInput.addEventListener('input', verificarIdalu);


/////////////////////////////////////////////////////////////////
// FUNCION PARA LIMPIAR EL IDALU (ESTA ES OTRA PARTE DEL)

// Función para limpiar el mensaje de validación de idalu
function limpiarValidacionIdalu() {
    idaluWarning.style.display = 'none'; // Ocultar el mensaje
}

// Evento de clic para limpiar la validación de idalu al cerrar el formulario
document.querySelector('.btn-secondary[data-dismiss="modal"]').addEventListener("click", limpiarValidacionIdalu);

// Evento de clic para limpiar la validación de idalu al guardar el formulario
document.getElementById("btnGuardar").addEventListener("click", limpiarValidacionIdalu);


////////////////////////////////////////



function clear() {
    $("#tipo_alumno").val(" ");
    $("#nombre").val("");
    $("#apellidos").val("");
    $("#datos1").val("");
    $("#datos2").val("");
    $("#idalu").val("");
    $("#curp").val("");
    $("#nespeciales").val("");

    // Restablecer el campo de "Necesidades Especiales"
    var textInput = document.getElementById("nespecialesText");
    var selectInput = document.getElementById("nespecialesSelect");
    selectInput.value = "";
    textInput.value = "";
    textInput.style.display = "none";
    textInput.setAttribute("disabled", true);
    selectInput.style.display = "inline-block";


    $("#gpreescolar").val("");
    $("#nombretutor").val("");
    $("#edadsiceeo").val("");
    $("#edadestadistica").val("");
    $("#nacimiento").val("");
    $("#dnimg").val("");
    $("#idalumno").val("");

    $("#lblcard1").html(".....");
    $("#lblcard2").html("......");
    $("#cboSelects").val("");
    $("#card1").val("");
    $("#card2").val("");
    $("#limport").show();

}

function clearcsv() {
    $("#customFile").val("");
    $("#custom-file-label").html("Elegir archivo");

    $("#savecsv").prop("disabled",false);
    $('#resultados').css('display','none');
}


function hidemoldal() {
    $("#kt_modal_1").modal('hide');
    $("#btnGuardar").prop("disabled", false);
    clear();
}

function showmoldal() {
    $("#kt_modal_1").modal('show');
    $("#btnGuardar").prop("disabled", false);
    lblupdates();

    
}


function listar() {
    t = $("#kt_table_1").DataTable({
        "language": {
            "url": "../resource/assets/js/Spanish.json"
        },
        responsive: !0,
        pageLength: 80,
        order: [[1, "asc"]],
        drawCallback: function(a) {
            var t = this.api(),
                e = t.rows({
                    page: "current"
                }).nodes(),
                n = null;
            t.column(1, {
                page: "current"
            }).data().each(function(a, t) {
                n !== a && ($(e).eq(t).before('<tr class="group"><td colspan="9">' + a + "</td></tr>"), n = a)
            })
        },
        columnDefs: [{
            targets: [1], // Ocultar sólo la columna 1 (Alumno)
            visible: false
        }],
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:not(.not-export)' // Excluir columnas con la clase 'not-export'
                },
                messageTop: '<div style="display: flex; justify-content: space-between;"><img src="../resource/files/logo/logosep.png" width="300" height="130"><img src="../resource/files/logo/logo2.png" width="300" height="145"></div><div style="text-align: center; font-size: 22px; margin-top: 1px; color: #19284C;">ESCUELA PRIMARIA 21 DE AGOSTO</div>',                title: ''
            
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible:not(.not-export)' // Excluir columnas con la clase 'not-export'
                },
                 },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible:not(.not-export)' // Excluir columnas con la clase 'not-export'
                },
                messageTop: '<div style="display: flex; justify-content: space-between;"><img src="../resource/files/logo/logosep.png" width="300" height="130"><img src="../resource/files/logo/logo2.png" width="300" height="145"></div>'
            }
        ],
        "aProcessing": true,
        "aServerSide": true,
        "ajax": {
            url: '../controllers/persona.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "lengthMenu": [80, 140, 200, 240, 300]
    }),

    $("#export_print").on("click", function(e) {
        e.preventDefault(), t.button(0).trigger()
    }),

    $("#export_excel").on("click", function(e) {
        e.preventDefault(), t.button(1).trigger()
    }),

    $("#export_pdf").on("click", function(e) {
        e.preventDefault(), t.button(2).trigger()
    })
}




function saveupdate(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

     // Obtener el valor seleccionado y agregarlo al formulario
    var nespecialesValue = getNespecialesValue();
    formData.append("nespeciales", nespecialesValue);

    $.ajax({
        url: "../controllers/persona.php?op=saveupdate",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            var data = JSON.parse(response);
            if (data.success) {
                swal.fire("Exito!", data.message, "success");
                var idalu = data.idalu; // Obtener el valor de idalu de la respuesta del servidor
                t.ajax.reload(function() {
                    if (idalu) {
                        var row = getRowByIdalu(idalu); // Obtener la fila del alumno por su idalu
                        if (row) {
                            highlightRow(row); // Resaltar la fila del alumno modificado
                        }
                    }
                }, false); // Agregar el parámetro "false" para evitar que se restablezca la paginación
                hidemoldal();
            } else {
                swal.fire("Error!", "Error al guardar o actualizar el registro", "error");
            }
        }
    });
    clear();
}

function getRowByIdalu(idalu) {
    var row = null;
    t.rows().every(function() {
        var rowData = this.data();
        if (rowData && rowData[2] == idalu) { // Ajusta el índice según la posición de la columna "idalu" en tu tabla
            row = $(this.node());
            return false; // Salir del bucle cuando se encuentra la fila
        }
    });
    return row;
}


function highlightRow(row) {
    row.addClass('highlighted');
    setTimeout(function() {
        row.removeClass('highlighted');
    }, 9000); // Quitar la clase después de 9 segundos
}


function saveupdatecsv(e)
{
    e.preventDefault();
    $("#savecsv").prop("disabled",true);
    var formData = new FormData($("#formulario_import")[0]);

    $.ajax({
        url: "../controllers/importCSV.php?op=saveupdate",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend : function (){                   
            $('#resultados').html('<center><img src="../resource/files/load/loader.gif" width="30" heigh="30"></center>');                  
        },
        success: function(datos)
        {   
            if (datos==1) {
                swal.fire("Error!","Seleccione un archivo para importar","error");
            }else{
               swal.fire("Exito!",datos,"success");
               t.ajax.reload();
               hidemoldal();
            } 

            clearcsv();   
        }

    });
clearcsv();

}



function inactive(idalumno) {
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
            $.post("../controllers/persona.php?op=inactive", { idalumno: idalumno }, function(e) {
                swal.fire("Exito!", e, "success");
                t.ajax.reload();
            });
        }
        t.ajax.reload();
    })
}



function active(idalumno) {
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
            $.post("../controllers/persona.php?op=active", { idalumno: idalumno }, function(e) {
                swal.fire("Exito!", e, "success");
                t.ajax.reload();
            });
        }
        t.ajax.reload();
    })
}

function mostrar(idalumno) {
    $.post("../controllers/persona.php?op=mostrar&idalumno=" + idalumno, function(data, status) {
        data = JSON.parse(data);
        showmoldal();
        $("#tipo_alumno").val("Estudiante"); // Establecer siempre el valor "Estudiante"
        $("#apellidos").val(data.apellidos);
        $("#nombre").val(data.nombre);
        $("#idalu").val(data.idalu);
        $("#dnimg").val(data.idalu);
        $("#datos1").val(data.datos1);
        $("#datos2").val(data.datos2);
        $("#curp").val(data.curp);
           
        // Modificar esta parte para mostrar la respuesta guardada en "Necesidades Especiales"
        var nespeciales = data.nespeciales;
        var textInput = document.getElementById("nespecialesText");
        var selectInput = document.getElementById("nespecialesSelect");
        if (nespeciales === "NO") {
            selectInput.value = "NO";
            textInput.style.display = "none";
            textInput.setAttribute("disabled", true);
            selectInput.style.display = "inline-block";
        } else {
            selectInput.value = "SI";
            textInput.value = nespeciales;
            textInput.style.display = "inline-block";
            textInput.removeAttribute("disabled");
            selectInput.style.display = "none";
        }

        $("#gpreescolar").val(data.gpreescolar);
        $("#nombretutor").val(data.nombretutor);
        $("#edadsiceeo").val(data.edadsiceeo);
        $("#edadestadistica").val(data.edadestadistica);
        $("#nacimiento").val(data.nacimiento);
        $("#idalumno").val(data.idalumno);
        lblupdates();
        $("#limport").hide();

    })
}


function delet(idalumno, codigo) {
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
            $.post("../controllers/persona.php?op=delete&idalumno=" + idalumno + '&codigo=' + codigo, function(e) {
                swal.fire("Exito!", e, "success");
                t.ajax.reload();
            });
        }
        t.ajax.reload();
    })
}

function textupdate() {

    $("#lbldatos1").html("Grado: *");
    $("#lbldatos2").html("Grupo: *");


    $("#tipo_alumno").change(function() {
        $("#tipo_alumno option:selected").each(function() {
            seleccion = $(this).val();

            if (seleccion == "Estudiante") {
                $("#lbldatos1").html("Grado");
                $("#lbldatos2").html("Grupo");

            } else if (seleccion == "Docente") {
                $("#lbldatos1").html("Especialidad");
                $("#lbldatos2").html("Area");

            } else if (seleccion == "Administrativo") {
                $("#lbldatos1").html("Especialidad");
                $("#lbldatos2").html("Cargo");

            } else if (seleccion == "Otros") {
                $("#lbldatos1").html("Datos 1");
                $("#lbldatos2").html("Datos 2");

            } else {
                $("#lbldatos1").html(".....");
                $("#lbldatos2").html("......");
            }

        });
    })
}

function lblupdates() {
    $("#tipo_alumno option:selected").each(function() {
        seleccion = $(this).val();

        if (seleccion == "Estudiante") {
            $("#lbldatos1").html("Grado");
            $("#lbldatos2").html("Grupo ");

        } else if (seleccion == "Docente") {
            $("#lbldatos1").html("Especialidad");
            $("#lbldatos2").html("Area");

        } else if (seleccion == "Administrativo") {
            $("#lbldatos1").html("Especialidad");
            $("#lbldatos2").html("Cargo");
        } else if (seleccion == "Otros") {
            $("#lbldatos1").html("Datos 1");
            $("#lbldatos2").html("Datos 2");

        } else {
            $("#lbldatos1").html(".....");
            $("#lbldatos2").html("......");
        }

    });
}


function lblupdatecard() {
    $(".divcard").css("display", "none");

    $("#cboSelects").change(function() {
        $("#cboSelects option:selected").each(function() {
            seleccion = $(this).val();

            if (seleccion == "Estudiante") {
                $("#lblcard1").html("Grado");
                $("#lblcard2").html("Grupo");
                $(".divcard1").css("display", "block");
                $(".divcard2").css("display", "none");

            } else if (seleccion == "Identificacion") {
                $("#lblcard3").html("IDALU");
                $(".divcard1").css("display", "none");
                $(".divcard2").css("display", "block");

            } else {
                $("#lblcard1").html(".....");
                $("#lblcard2").html(".....");
                $(".divcard").css("display", "none");
            }
        });

    });
}



function validarExt(file) {
    var archivoInput = document.getElementById('customFile');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.csv|.CSV)$/i;

    if (!extPermitidas.exec(archivoRuta)) {
        swal.fire('Error!', 'Formato incorrecto', 'error');
        archivoInput.value = '';
        return false;
    }
}


function cardpdf() {

    var cardheaderget = $("#cardheader").val();
    var cardheader = cardheaderget.substring(1);
    var cardtextheaderget = $("#cardtextheader").val();
    var cardtextheader = cardtextheaderget.substring(1);
    var cardbodyget = $("#cardbody").val();
    var cardbody = cardbodyget.substring(1);
    var cardtextbodyget = $("#cardtextbody").val();
    var cardtextbody = cardtextbodyget.substring(1);

    var cboSelects = $("#cboSelects").val();
    var card1 = $("#card1").val();
    var card2 = $("#card2").val();
    var identificacion = $("#identificacion").val();


    if (cboSelects == 0) {
        alert("seleccione alumno");
    } else {

        if (cboSelects == "Identificacion") {

            if (cboSelects == "Identificacion" && identificacion == 0) {
                alert("Digite N° de identificacion");
            } else {
                VentanaCentrada('../reports/card_id.php?&cardheader=' + cardheader + '&cardtextheader=' + cardtextheader + '&cardbody=' + cardbody + '&cardtextbody=' + cardtextbody + '&identificacion=' + identificacion, '', '1024', '768', 'true');
                clear();
            }

        } else if (cboSelects != 0 && card1 != 0 && card2 == 0) {
            alert("seleccione seccion");
        } else if (cboSelects != 0 && card1 == 0 && card2 != 0)
            alert("seleccione grado");
        else {
            VentanaCentrada('../reports/card_other.php?&cardheader=' + cardheader + '&cardtextheader=' + cardtextheader + '&cardbody=' + cardbody + '&cardtextbody=' + cardtextbody + '&cboSelects=' + cboSelects + '&card1=' + card1 + '&card2=' + card2, '', '1024', '768', 'true');
            clear();
        }

    }
}


//////// NECESIDADES SI O NO

function toggleTextInput(value) {
    var textInput = document.getElementById("nespecialesText");
    var selectInput = document.getElementById("nespecialesSelect");
    if (value === "SI") {
        textInput.style.display = "inline-block";
        textInput.removeAttribute("disabled");
        selectInput.style.display = "none";
    } else {
        textInput.style.display = "none";
        textInput.setAttribute("disabled", true);
        selectInput.style.display = "inline-block";
    }
}

function checkEmpty(input) {
    var textInput = document.getElementById("nespecialesText");
    var selectInput = document.getElementById("nespecialesSelect");
    if (input.value.trim() === "") {
        textInput.style.display = "none";
        textInput.setAttribute("disabled", true);
        selectInput.style.display = "inline-block";
        selectInput.value = "NO"; // Establecer el valor del select en "no" cuando el campo de texto esté vacío
    }
}

// Agregar esta función para obtener el valor seleccionado en el formulario antes de enviarlo
function getNespecialesValue() {
    var textInput = document.getElementById("nespecialesText");
    var selectInput = document.getElementById("nespecialesSelect");
    if (textInput.style.display === "none") {
        return selectInput.value;
    } else {
        return textInput.value;
    }
}




///////////////////TUTOR
 
$(document).ready(function() {
    $('#nombretutor').on('keyup', function() {
        var nombreTutor = $(this).val();

        if (nombreTutor.length > 0) {
            $.ajax({
                url: 'buscar_tutores.php',
                type: 'GET',
                data: { nombreTutor: nombreTutor },
                dataType: 'json',
                success: function(data) {
                    var suggestions = '';

                    if (data.length > 0) {
                        suggestions += '<ul class="list-group">';
                        $.each(data, function(index, tutor) {
                            suggestions += '<li class="list-group-item suggestion-item">' + tutor + '</li>';
                        });
                        suggestions += '</ul>';
                    }

                    $('#tutorSuggestions').html(suggestions);
                    $('.suggestion-item').click(function() {
                        $('#nombretutor').val($(this).text());
                        $('#tutorSuggestions').html('');
                    });
                },
                error: function() {
                    $('#tutorSuggestions').html('Error al cargar las sugerencias');
                }
            });
        } else {
            $('#tutorSuggestions').html('');
        }
    });
});

// Eliminar sugerencias de nombre tutor en el modal
var modal = document.getElementById('kt_modal_1');
modal.addEventListener('show.bs.modal', function() {
    document.getElementById('tutorSuggestions').innerHTML = '';
});

function hidemoldal() {
    $("#kt_modal_1").modal('hide');
    $("#btnGuardar").prop("disabled", false);
    clear();
    document.getElementById('tutorSuggestions').innerHTML = '';
}


// MENSAJE DE ADVERTENCIA

$(document).ready(function() {
    // Función para validar los campos obligatorios en orden
    function validarCamposObligatorios(campoActual) {
        // Orden de validación
        //var camposOrdenados = ['idalu', 'curp', 'nombre', 'apellidos', 'datos1', 'datos2', 'gpreescolar', 'nespecialesSelect', 'nacimiento', 'nombretutor'];
        var camposOrdenados = ['idalu', 'curp', 'nombre', 'apellidos', 'datos1', 'datos2', 'nespecialesSelect', 'nacimiento'];

        // Encontrar el índice del campo actual en el orden
        var indiceActual = camposOrdenados.indexOf(campoActual);

        for (var i = 0; i < camposOrdenados.length; i++) {
            var campoActualizado = camposOrdenados[i];
            var $campo = $('#' + campoActualizado);
            var valor = $campo.val().trim();

            if (campoActualizado === 'nacimiento' && indiceActual === 0) {
                // Si el campo actual es fecha de nacimiento y es el primer campo escrito,
                // no validar los campos anteriores
                if (i === indiceActual) {
                    if (valor === '') {
                        $campo.addClass('is-invalid');
                        $campo.attr('placeholder', 'Campo obligatorio');
                    } else {
                        $campo.removeClass('is-invalid');
                        $campo.attr('placeholder', $campo.data('placeholder'));
                    }
                }
            } else if (campoActualizado === 'nespecialesSelect') {
                var $nespecialesText = $('#nespecialesText');
                if (valor === '') {
                    if (indiceActual >= i) {
                        $campo.addClass('is-invalid');
                        $campo.attr('placeholder', 'Campo obligatorio');
                    }
                } else {
                    $campo.removeClass('is-invalid');
                    $campo.attr('placeholder', $campo.data('placeholder'));
                    if (valor === 'SI' && $nespecialesText.val().trim() === '' && indiceActual >= i) {
                        $nespecialesText.addClass('is-invalid');
                        $nespecialesText.attr('placeholder', 'Campo obligatorio');
                    } else {
                        $nespecialesText.removeClass('is-invalid');
                        $nespecialesText.attr('placeholder', $nespecialesText.data('placeholder'));
                    }
                }
            } else {
                if (i < indiceActual) {
                    // Validar los campos anteriores al campo actual
                    if (valor === '') {
                        $campo.addClass('is-invalid');
                        $campo.attr('placeholder', 'Campo obligatorio');
                    } else {
                        $campo.removeClass('is-invalid');
                        $campo.attr('placeholder', $campo.data('placeholder'));
                    }
                } else if (i === indiceActual) {
                    // Validar el campo actual
                    if (valor === '') {
                        $campo.addClass('is-invalid');
                        $campo.attr('placeholder', 'Campo obligatorio');
                    } else {
                        $campo.removeClass('is-invalid');
                        $campo.attr('placeholder', $campo.data('placeholder'));
                    }
                }
            }
        }
    }

    // Guardar los placeholders originales de los campos
    $('input[required], select[required]').each(function() {
        $(this).data('placeholder', $(this).attr('placeholder'));
    });

    // Validar campos obligatorios al escribir en un campo de texto
    $('input[type="text"][required]').on('input', function() {
        var campoActual = $(this).attr('id');
        validarCamposObligatorios(campoActual);
    });

    // Validar campos obligatorios al cambiar de campo
    $('input[required], select[required]').on('blur', function() {
        var campoActual = $(this).attr('id');
        validarCamposObligatorios(campoActual);
    });

    // Validar campos obligatorios al seleccionar una opción en un campo de selección múltiple
    $('select[required]').on('change', function() {
        var campoActual = $(this).attr('id');
        validarCamposObligatorios(campoActual);
    });

    // Validar campos obligatorios al completar la fecha de nacimiento
    $('#nacimiento').on('change', function() {
        var campoActual = $(this).attr('id');
        validarCamposObligatorios(campoActual);
    });

    // Validar campos obligatorios al enviar el formulario
    $('#formulario').on('submit', function(e) {
        validarCamposObligatorios();

        if ($('.is-invalid').length > 0) {
            e.preventDefault(); // Evitar el envío del formulario si hay campos inválidos
        }
    });
});


// LIMPIEZA DE BOTONES PARA EL MENSAJE DE ADVERTENCIA EN ROJO

function limpiarCampos() {
    // Seleccionar todos los campos del formulario
    var campos = document.querySelectorAll('#formulario input, #formulario select');

    // Recorrer cada campo y limpiar su valor
    campos.forEach(function(campo) {
        campo.value = '';
    });

    // Remover la clase 'is-invalid' de todos los campos
    var camposInvalidos = document.querySelectorAll('.is-invalid');
    camposInvalidos.forEach(function(campoInvalido) {
        campoInvalido.classList.remove('is-invalid');
    });
}


init();