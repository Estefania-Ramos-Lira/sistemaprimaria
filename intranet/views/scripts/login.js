$("#frmAcceso").on('submit', function(e) {
    e.preventDefault();
    logina = $("#logina").val();
    clavea = $("#clavea").val();

    if (logina == 0) {
        swal.fire("Error!", "ingrese usuario", "error");
    } else if (clavea == 0) {
        swal.fire("Error!", "ingrese contraseña", "error");
    } else {



        $.post("../controllers/usuario.php?op=verificar", { "logina": logina, "clavea": clavea }, function(data) {
            if (data != "null") {
                $(location).attr("href", "escritorio.php");
            } else {

                    $.post("../controllers/usuario.php?op=verificaralumno", { "logina": logina, "clavea": clavea }, function(data) {
                        if (data != "null") {
                            $(location).attr("href", "viewpersonal.php");
                        } else {
                            swal.fire("Error!", "Usuario y/o contraseña incorrecto", "error");
                            $("#logina").val("");
                            $("#clavea").val("");
                        }
                    });
            }
        });



/*        $.post("../controllers/usuario.php?op=verificar", { "logina": logina, "clavea": clavea }, function(data) {
            if (data != "null") {
                $(location).attr("href", "escritorio.php");
            } else {
                swal.fire("Error!", "Usuario y/o contraseña incorrecto", "error");
                $("#logina").val("");
                $("#clavea").val("");
            }
        });
*/



    }
})