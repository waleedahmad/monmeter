google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales'],
        ['2013',  100],
        ['2014',  150],
        ['2015',  20],
        ['2016',  50]

    ]);

    var options = {
        hAxis: {
            titleTextStyle: {color: '#ffffff'},
            gridlines: {color: 'transparent', count: 10},

        },
        vAxis: {
            minValue: 10,
            gridlines: {color: '#bababa', count: 1},
            ticks : [0,30,60,90,120,150],
            format:'#L'
        },


        backgroundColor: '#EEE0DF',
        chartArea: {
            backgroundColor: '#EEE0DF'
        },
        crosshair: {
            orientation: 'vertical'
        },
        animation: {
            startup: true,
            duration: 500
        },
        curveType: 'function',
        legend: {
            position: 'bottom',
        },
        height: 250,
        series: {0:{color:'D2304F',lineWidth:0}},
        areaOpacity : 0.8
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}