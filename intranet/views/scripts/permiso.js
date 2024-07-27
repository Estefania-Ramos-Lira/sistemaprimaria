var t;

function init() {
    listar();
    $('#macceso').addClass("kt-menu__item--open kt-menu__item--here");
    $('#lpermiso').addClass("kt-menu__item--active");
}


function listar() {
    t = $("#kt_table_2").DataTable({
        "language": {
            "url": "../resource/assets/js/Spanish.json"
        },
        responsive: !0,
        "aProcessing": true,
        "aServerSide": true,
        "lengthMenu": [5, 10, 25, 75, 100],

        "ajax": {
            url: '../controllers/permiso.php?op=listar',
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
    })
}


init();