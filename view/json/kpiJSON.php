<?php
  require_once "../../model/KPI.php";
  $obj = array();
  $obj["worker"] = $_REQUEST["worker"];
  $obj["process"] = $_REQUEST["process"];
  $allKpi = json_encode(KPI::getAllKPIForChart($obj));

?>
<div id="chartdiv"></div>
<script>
  var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataProvider": <?=$allKpi?>,
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "totalWork",
    "fixedColumnWidth": 80
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "own_name",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }
  } );
</script>
