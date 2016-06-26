google.setOnLoadCallback(drawChart);

function drawChart() {

    var options = {
        //vAxis: {minValue: 0, ticks: [0, 1, 2, 3, 4]}
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

    var data = new google.visualization.DataTable();
    data.addColumn('datetime', 'Time');
    data.addColumn('number', 'Temp');

    data.addRows([
        [new Date('2015-02-06 05:15:03'),20],
        [new Date('2015-02-06 07:30:03'),  50],
        [new Date('2015-02-06 12:00:03'), 75],
        [new Date('2015-02-06 15:15:59'),  60],
        [new Date('2015-02-06 16:30:03'), 50],
        [new Date('2015-02-06 18:45:59'),  32],
        [new Date('2015-02-06 20:00:04'),  25],
        [new Date('2015-02-06 20:15:05'),  80],
        [new Date('2015-02-06 20:30:59'), 90],

    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}