// Load Charts and the corechart and barchart packages.
google.charts.load('current', {'packages':['corechart']});

// Draw the pie chart and bar chart when Charts is loaded.
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var contenido = new google.visualization.DataTable();
    contenido.addColumn('string', 'Contenido');
    contenido.addColumn('number', 'value');
    contenido.addRows([
        ['Yes', {{ yes }}],
        ['No', 2]
    ]);

    var barchart_options = {title:'Contenido',
        width:400,
        height:300};
    var barchart = new google.visualization.BarChart(document.getElementById('contenido_div'));
    barchart.draw(contenido, barchart_options);

    // var barchart_options = {title:'Barchart: How Much Pizza I Ate Last Night',
    //     width:400,
    //     height:300,
    //     legend: 'none'};
    // var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
    // barchart.draw(contenido, barchart_options);
}