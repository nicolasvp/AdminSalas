<!DOCTYPE html>
<html>
<head>
	<title>Graficas Probando</title>
</head>
<body>
	<button id="grafico_1">grafico 1</button>
	<button id="grafico_2">grafico 2</button>
	<button id="grafico_3">grafico 3</button>
    <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

   	$("#grafico_1").click(function(){


        var options = {
        chart: {
        	renderTo: 'container',
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: []
        };

        $.getJSON("{{ route('graficas.index') }}", function(json) {

            //options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
            options.xAxis.categories = [ 
            	'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'];

           // options.series[0] = json[1];
           	options.series = [{
	            name: 'Tokyo',
	            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

	        }, {
	            name: 'New York',
	            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

	        }, {
	            name: 'London',
	            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

	        }, {
	            name: 'Berlin',
	            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

	        }];

            chart = new Highcharts.Chart(options);

        });

    });	


$("#grafico_2").click(function(){
	// Create the chart
	Highcharts.chart('container', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Browser market shares. January, 2015 to May, 2015'
	    },
	    subtitle: {
	        text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
	    },
	    xAxis: {
	        type: 'category'
	    },
	    yAxis: {
	        title: {
	            text: 'Total percent market share'
	        }

	    },
	    legend: {
	        enabled: false
	    },
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y:.1f}%'
	            }
	        }
	    },

	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
	    },

	    series: [{
	        name: 'Brands',
	        colorByPoint: true,
	        data: [{
	            name: 'Microsoft Internet Explorer',
	            y: 56.33,
	            drilldown: 'Microsoft Internet Explorer'
	        }, {
	            name: 'Chrome',
	            y: 24.03,
	            drilldown: 'Chrome'
	        }, {
	            name: 'Firefox',
	            y: 10.38,
	            drilldown: 'Firefox'
	        }, {
	            name: 'Safari',
	            y: 4.77,
	            drilldown: 'Safari'
	        }, {
	            name: 'Opera',
	            y: 0.91,
	            drilldown: 'Opera'
	        }, {
	            name: 'Proprietary or Undetectable',
	            y: 0.2,
	            drilldown: null
	        }]
	    }],
	    drilldown: {
	        series: [{
	            name: 'Microsoft Internet Explorer',
	            id: 'Microsoft Internet Explorer',
	            data: [
	                [
	                    'v11.0',
	                    24.13
	                ],
	                [
	                    'v8.0',
	                    17.2
	                ],
	                [
	                    'v9.0',
	                    8.11
	                ],
	                [
	                    'v10.0',
	                    5.33
	                ],
	                [
	                    'v6.0',
	                    1.06
	                ],
	                [
	                    'v7.0',
	                    0.5
	                ]
	            ]
	        }, {
	            name: 'Chrome',
	            id: 'Chrome',
	            data: [
	                [
	                    'v40.0',
	                    5
	                ],
	                [
	                    'v41.0',
	                    4.32
	                ],
	                [
	                    'v42.0',
	                    3.68
	                ],
	                [
	                    'v39.0',
	                    2.96
	                ],
	                [
	                    'v36.0',
	                    2.53
	                ],
	                [
	                    'v43.0',
	                    1.45
	                ],
	                [
	                    'v31.0',
	                    1.24
	                ],
	                [
	                    'v35.0',
	                    0.85
	                ],
	                [
	                    'v38.0',
	                    0.6
	                ],
	                [
	                    'v32.0',
	                    0.55
	                ],
	                [
	                    'v37.0',
	                    0.38
	                ],
	                [
	                    'v33.0',
	                    0.19
	                ],
	                [
	                    'v34.0',
	                    0.14
	                ],
	                [
	                    'v30.0',
	                    0.14
	                ]
	            ]
	        }, {
	            name: 'Firefox',
	            id: 'Firefox',
	            data: [
	                [
	                    'v35',
	                    2.76
	                ],
	                [
	                    'v36',
	                    2.32
	                ],
	                [
	                    'v37',
	                    2.31
	                ],
	                [
	                    'v34',
	                    1.27
	                ],
	                [
	                    'v38',
	                    1.02
	                ],
	                [
	                    'v31',
	                    0.33
	                ],
	                [
	                    'v33',
	                    0.22
	                ],
	                [
	                    'v32',
	                    0.15
	                ]
	            ]
	        }, {
	            name: 'Safari',
	            id: 'Safari',
	            data: [
	                [
	                    'v8.0',
	                    2.56
	                ],
	                [
	                    'v7.1',
	                    0.77
	                ],
	                [
	                    'v5.1',
	                    0.42
	                ],
	                [
	                    'v5.0',
	                    0.3
	                ],
	                [
	                    'v6.1',
	                    0.29
	                ],
	                [
	                    'v7.0',
	                    0.26
	                ],
	                [
	                    'v6.2',
	                    0.17
	                ]
	            ]
	        }, {
	            name: 'Opera',
	            id: 'Opera',
	            data: [
	                [
	                    'v12.x',
	                    0.34
	                ],
	                [
	                    'v28',
	                    0.24
	                ],
	                [
	                    'v27',
	                    0.17
	                ],
	                [
	                    'v29',
	                    0.16
	                ]
	            ]
	        }]
	    }
	});
});


$("#grafico_3").click(function(){
    var options =  {
        chart: {
        	renderTo: 'container',
            type: 'column'
        },
        title: {
            text: 'World\'s largest cities per 2014'
        },
        subtitle: {
            text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (horarios)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2008: <b>{point.y:.1f} horarios</b>'
        },
        series: [{
            name: 'Population',
            data: [],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    };

    $.getJSON("{{ route('graficas.index') }}", function(json) {

 	    $.each(json,function(k,v){
        	options.series[0].data.push(v);
       	}); 


        chart = new Highcharts.Chart(options);

    });

});

</script>
</html>