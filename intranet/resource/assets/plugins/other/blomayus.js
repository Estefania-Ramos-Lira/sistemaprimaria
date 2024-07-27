function init(){
	mayus();
	soloNumeros();
	soloLetras();
    validarCURP();
}


function mayus(e)
{
e.value=e.value.toUpperCase();
}


function soloNumeros(e)
{
  var key=window.Event ? e.which:e.keyCode
  return (key>=48 && key<=57) ||(key==8)
}



//function soloLetras(e)
//{
//	key=e.keycode||e.which;
//	teclado=String.fromCharCode(key).toLowerCase();
//	letras=" abcdefghijklmñopqrstuvwxyzáéíóú";
//	especiales="8-37-38-46-164";
//	teclado_especial=false;
//	for (var i in especiales) {
//		if (key==especiales[i]) {
//			teclado_especial=true;
//			break;
//		} 
//
//		if (letras.indexOf(teclado)==-1&& !teclado_especial) {
//				return false;
//
//		}
//	}
//}

function soloLetras(e) {
    var key = e.keyCode || e.which;
    var teclado = String.fromCharCode(key).toLowerCase();
    var letras = "abcdefghijklmnñopqrstuvwxyzáéíóú ";
    var especiales = "8-37-38-46-164";
    var teclado_especial = false;

    // Manejar todas las teclas especiales
    if (especiales.indexOf(key) !== -1) {
        teclado_especial = true;
    }

    // Manejar el caso de las letras y el espacio
    if (letras.indexOf(teclado) === -1 && !teclado_especial) {
        return false;
    }
}

// Obtener la referencia al elemento donde se mostrará el resultado de la validación
var curpValidacion = document.getElementById("curp-validacion");

// Agregar un evento para validar la CURP cuando se pierde el foco del input
document.getElementById("curp").addEventListener("blur", validarCURP);

function validarCURP() {
    var curp = document.getElementById("curp").value;
    var regex = /^[A-Z]{4}\d{6}[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9][0-9]$/;

    // Realizar una solicitud AJAX para verificar si la CURP ya existe en la base de datos
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "verificar_curp.php?curp=" + curp, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var respuesta = xhr.responseText;
            if (respuesta === "true") {
                curpValidacion.innerHTML = "La CURP ya se encuentra registrada";
                curpValidacion.style.color = "orange";
            } else if (regex.test(curp)) {
                curpValidacion.innerHTML = "La CURP ingresada es válida";
                curpValidacion.style.color = "green";
            } else {
                curpValidacion.innerHTML = "La CURP ingresada es inválida";
                curpValidacion.style.color = "red";
            }
        }
    };
    xhr.send();
}

// Función para limpiar el contenido de la validación de CURP
function limpiarValidacionCURP() {
    curpValidacion.innerHTML = ""; // Limpiar el contenido
}

// Evento de clic para limpiar la validación de CURP al cerrar el formulario
document.querySelector('.btn-secondary[data-dismiss="modal"]').addEventListener("click", limpiarValidacionCURP);

// Evento de clic para limpiar la validación de CURP al guardar el formulario
document.getElementById("btnGuardar").addEventListener("click", limpiarValidacionCURP);


init();