google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  const dateB = JSON.parse('{{ dateB  }}');
  const qte = JSON.parse('{{ qte }}');
  
  var data = new google.visualization.DataTable();
    data.addColumn('string', 'Date de bourse');
    data.addColumn('number', 'Quantité');

  for(i = 0; i < dateB.length; i++)
    data.addRow([dateB[i], qte[i]]);

  var options = {
    title: "Titre",
    hAxis: {title: 'Date Bourse',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0},
     height: 500,
      width: 900 
  };
  new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {});
/*   new google.visualization.AreaChart(document.getElementById('chart_div'));
  chart.draw(data, options);
 */}