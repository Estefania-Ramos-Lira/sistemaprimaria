
function init(){
         
} 

function reportExceltime() {
    
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();
        VentanaCentrada('../reports/rpt_detalleexcel.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,'Reporte','','1024','768','true');  
}

function reportPdftime() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();
      VentanaCentrada('../reports/rpt_detallepdf.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,'Reporte','','1024','768','true');  
}
 

 function reportWordtime() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();
      VentanaCentrada('../reports/rpt_detalleword.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,'Reporte','','1024','768','true');  
}

function reportPrinttime() {
    var date_star = $("#date_star").val();
    var date_end = $("#date_end").val();
    var tipo_alumno = $("#tipo_alumno").val();
    var datos1 = $("#datos1").val();
    var datos2 = $("#datos2").val();
    var timeingreso = $("#timeingreso").val();


if (date_star==0 || date_end==0) {
alert('seleccione fecha');

}else{

    
$('#divprint').load('../reports/rpt_detalleprint.php?date_star='+date_star+'&date_end='+date_end+'&tipo_alumno='+tipo_alumno+'&datos1='+datos1+'&datos2='+datos2+'&timeingreso='+timeingreso,function(){
            var printContent = document.getElementById('divprint');
            var WinPrint = window.open('', '', 'width=1024,height=768');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });

}
}        




init();