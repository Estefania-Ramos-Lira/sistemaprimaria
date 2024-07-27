
function init(){
         
} 

function reportWord(){
    
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();
      VentanaCentrada('../reports/rpt_listword_time.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,'Reporte','','1024','768','true');  
}

function reportTime() {
    
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();
      VentanaCentrada('../reports/rpt_listexcel_time.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,'Reporte','','1024','768','true');  
}

function reportPdftime() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();
      VentanaCentrada('../reports/rpt_listpdf_time.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,'Reporte','','1024','768','true');  
}


function reportPrinttime() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();

        $('#divprint').load('../reports/rpt_listprint_time.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,function(){
            var printContent = document.getElementById('divprint');
            var WinPrint = window.open('', '', 'width=1024,height=768');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
}



init();