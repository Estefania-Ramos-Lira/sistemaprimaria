
function init() {
    $("#btnDownload").on("click", function() {
        downloadQR();
    });

    $("#formulario").on("submit", function(e) {
        QR_code(e);
    });

    $('#mqr').addClass("kt-menu__item--open kt-menu__item--here");
}


function clear() {
    var dataContent = $("#dataContent").val(); // Obtener el valor del campo de texto dataContent
    $(".qrdiv").addClass('loading');
    // $("#dataContent").val(""); // Comentar o eliminar esta línea
    $("#imj").attr("src", "");
    $("#btnSave").prop("disabled", false);
    return dataContent; // Devolver el valor almacenado
}



function QR_code(e) {
    e.preventDefault();
    $("#btnSave").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    var dataContent = $("#dataContent").val(); // Obtener el valor del campo de texto

    // Realizar una consulta AJAX para verificar si el IDALU existe
    $.ajax({
        url: '../controllers/check_idalu.php',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.trim() === "exists") {
                // El IDALU existe, generar el código QR
                generateQR(formData, dataContent); // Pasar el valor almacenado a generateQR
            } else {
                // El IDALU no existe, mostrar un mensaje de error
                $(".qrdiv").html("<div class='alert alert-danger'>El IDALU del alumno no se encuentra registrado</div>");
                $(".qrdiv").removeClass('loading');
                $("#btnSave").prop("disabled", false);
                // No limpiar el campo de texto
            }
        }
    });
}


function generateQR(formData, dataContent) {
    $.ajax({
        url: '../controllers/qr-code.php?op=generateqr',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".qrdiv").addClass('loading');
        },
        success: function(resp) {
            $(".qrdiv").html(resp);
        },
        complete: function() {
            $(".qrdiv").removeClass('loading');
            $("#btnSave").prop("disabled", false); // Habilitar el botón "Generar"
        },
        error: function() {
            $(".qrdiv").removeClass('loading');
            $("#btnSave").prop("disabled", false); // Habilitar el botón "Generar" en caso de error
        }
    });
}

function downloadUrl(url, fileName) {
    var link = document.createElement("a");
    link.href = url;
    link.download = fileName;
    link.style.display = "none";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function downloadQR() {
    var idalu = $("#dataContent").val();
    var size = $("#size").val();
    var currentDate = new Date().toISOString().slice(0, 10);
    var fileName = "codeqr_" + size + "-" + idalu + "-" + currentDate + ".png";
    var imgElement = document.getElementById("imj");
    var imgUrl = imgElement.src;
    downloadUrl(imgUrl, fileName);
}


init();