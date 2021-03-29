google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

dateB = ['05/01/2016','05/10/2016','05/20/2016'];
qte = [327346,3273680,327468];

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Date', 'Quantité'],
    [dateB[0], qte[0]],
    [dateB[1], qte[1]],
    [dateB[2], qte[2]],
  ]);

  var options = {
    title: "Libellé Catégorie d'avoir = Av clts libres Tun",
    hAxis: {title: 'Date Bourse',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0},
    height: 600,
    width: 1200
  };

  var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}