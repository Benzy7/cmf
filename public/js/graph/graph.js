google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(BuildChart);

var table = document.getElementById('dataTable');
var json = []; // First row needs to be headers 
var headers =[];
for (var i = 0; i < table.rows[0].cells.length; i++) {
  headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
}

// Go through cells 
for (var i = 1; i < table.rows.length; i++) {
  var tableRow = table.rows[i];
  var rowData = {};
  for (var j = 0; j < tableRow.cells.length; j++) {
    rowData[headers[j]] = tableRow.cells[j].innerHTML;
  }

  json.push(rowData);
}
console.log(json);

// Map json values back to label array
var labels = json.map(function (e) {
    return e.datebourse;
});
console.log(labels);

// Map json values back to values array
var values = json.map(function (e) {
    return e.quantité;
});
console.log(values);

/* var i, j; 

for(i=0;i<values.length;i++){
  for(j=1;i<values.length;j++){

if(labels[i] = labels[j] ){

  values[i] =  Number(values[i]) + Number(values[j]);

  labels.splice(j,1); 
  values.splice(j,1); 

  }

 }
} */

//var chart = BuildChart(labels, values, "Items Sold Over Time");
//for(i = 0; i < 10; i++){
  var i;

  for(i=0 ; i < labels.length ; i++){
  
    values[i] =  Number(values[i]);
  }

  for(i=0 ; i < labels.length ; i++){

  if( Number(labels[i]) = Number(labels[(i+1)]) ){
  
    values[i] = values[i]+values[i++];
  
    labels.splice(i++,1); 
    values.splice(i++,1); 
  
    }
  }
  console.log(values);
  console.log(labels);


function BuildChart() {
    var data = google.visualization.arrayToDataTable([
      ['Date', 'Quantité'],
      [labels[0], Number(values[0])],
      [labels[1], Number(values[1])],
      [labels[2], Number(values[2])],

      //[labels[0], Number(values[0])+Number(values[1])],
      //[labels[1], Number(values[1])],
      //[labels[2], Number(values[2])+Number(values[3])+Number(values[4])],
      //[labels[3], Number(values[3])],
      //[labels[4], Number(values[4])],
      //[labels[5], Number(values[5])+Number(values[6])+Number(values[7])],
      //[labels[6], Number(values[6])],
      //[labels[7], Number(values[7])],
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