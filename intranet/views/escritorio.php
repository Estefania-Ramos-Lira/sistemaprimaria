<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
    header("Location: login.html");
}else{

include 'header.php';

    if ($_SESSION['escritorio']==1)
    {

 require_once "../models/Graphics.php";
  $DBobj = new graphics();
  $rsptatp = $DBobj->total_alumno();
  $regtp=$rsptatp->fetch_object();
  $totaltp=$regtp->total;

  $rsptats = $DBobj->total_student();
  $regts=$rsptats->fetch_object();
  $totalts=$regts->total;

  $rsptatt = $DBobj->total_teacher();
  $regtt=$rsptatt->fetch_object();
  $totaltt=$regtt->total;

  $rsptata = $DBobj->total_admin();
  $regta=$rsptata->fetch_object();
  $totalta=$regta->total;

  $rsptato = $DBobj->total_other();
  $regto=$rsptato->fetch_object();
  $totalto=$regto->total;



  $rsptastmonth= $DBobj->studentmonth();
  $rsptastyear= $DBobj->studentyear();  

  $rsptateamonth= $DBobj->teachermonth();
  $rsptateayear= $DBobj->teacheryear();

  $rsptaadmonth= $DBobj->adminmonth();
  $rsptaadyear= $DBobj->adminyear();  

  $rsptaothmonth= $DBobj->othermonth();
  $rsptaothyear= $DBobj->otheryear();
?>

<style>
.chartdiv{
  width: 100%;
  height: 320px;
}
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-6">
            <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
            	<div class="kt-portlet__body">
            		<div class="kt-widget25" style="margin:0;">
            			<span class="kt-widget25__stats m-font-brand" style="font-size: 1.8rem;"><?php echo $totaltp; ?></span>
            			<span class="kt-widget25__subtitle">Total de alumnos registrados</span>
            			<div class="kt-widget25__items">
            				<div class="kt-widget25__item">
            					<span class="kt-widget25__number" style="font-size: 1.2rem;">
            						<?php echo $totalts; ?>
            				    </span>					 
            					<div class="progress kt-progress--sm">
            						<div class="progress-bar kt-bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            					</div>
            					<span class="kt-widget25__desc">
            						Estudiantes
            					</span>
            				</div>

            					       
                           	

            			</div>					
            		</div>			 
            	</div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14" style="padding: 2px; text-align: center;" >
                        <h6 class="kt-widget14__title" style="padding-top: 8px;margin-bottom: 0px;">
                            10 ALUMNOS CON MAS FALTAS DEL MES         
                        </h6>
                    <div class="kt-widget14__chart"  >
                           <div id="studentmonth" class="chartdiv"></div>
                    </div>
                </div>
            </div>  
        </div>

        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14" style="padding: 2px; text-align: center;" >
                        <h6 class="kt-widget14__title" style="padding-top: 8px;margin-bottom: 0px;">
                            1O ALUMNOS CON MAS FALTAS DEL AÑO         
                        </h6>
                    <div class="kt-widget14__chart"  >
                           <div id="studentyear" class="chartdiv"></div>
                    </div>
                </div>
            </div>  
        </div>



        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1" style="margin-bottom: 150px;">
            <div class="kt-portlet kt-portlet--height-fluid">
            <!-- Tu contenido -->
            </div>
        </div>



    <?php 
require 'footer.php'; 
    }else{
        require 'error.html';
    }
}
ob_end_flush();

?>

 <script type="text/javascript" src="scripts/graphics.js"></script>

<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("studentmonth", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptastmonth as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>


<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("studentyear", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptastyear as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>







<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("teachersmonth", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptateamonth as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>


<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("teachersyear", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptateayear as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>










<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("adminsmonth", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptaadmonth as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>


<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("adminsyear", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptaadyear as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>






<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("othersmonth", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptaothmonth as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>


<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
var chart = am4core.create("othersyear", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

chart.data = [
                <?php 
                foreach ($rsptaothyear as $key ) {
                    $nombre= $key['nombre'];
                    $total= $key['total_student'];
                ?>
                        { 
                        "country": "<?php echo $nombre; ?>",
                        "visits":<?php echo $total; ?>,
                        },
                 <?php }  ?>   
];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 300;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 5;

var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.cursor = new am4charts.XYCursor();

});
</script>

