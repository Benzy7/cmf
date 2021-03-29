google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var aet = document.getElementsByName("AET").rows[0].cells.length
var cvt = document.getElementsByName("CVT").rows[0].cells.length
var trt = document.getElementsByName("TRT").rows[0].cells.length
var nat = document.getElementsByName("NAT").rows[0].cells.length
var mpt = document.getElementsByName("MPT").rows[0].cells.length



function drawChart() {

  var data = google.visualization.arrayToDataTable([
    ['Code opération', 'Nombre'],
    ['AET',     aet],
    ['CVT',     cvt],
    ['TRT',     trt],
    ['NAT',     nat],
    ['MPT',     mpt],
  ]);

  var options = {
    pieHole: 0.5,
    pieSliceTextStyle: {
      color: 'black',
    },
    legend: 'none'
  };

  var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
  chart.draw(data, options);
}