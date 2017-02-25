@extends('administrador/main')

@section('option')
    <li class="active">Estadísticas</li>
@stop

@section('style')
    <link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">
@stop

@section('container')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

    <div class="col-lg-12" style="padding-top: 20px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h2> Estadísticas </h2>
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif                                    
                    </div>
                    <div class="col-md-6 col-lg-6">
                    </div>
               </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group" id="form-fecha-ini">
                                    <label>Fecha Inicio</label>
                                    <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                </div>                                
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group" id="form-fecha-term">
                                    <label>Fecha Término</label>
                                    <input type="text" class="form-control" id="fecha_termino" name="fecha_termino">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button id="filtros" class="btn btn-success" style="margin-top: 25px;">Aceptar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Salas
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="salas-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Cursos
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="cursos-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

@stop

@section('scripts')
<script src="{{ asset('dist/js/jquery-ui.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){

    $("#fecha_inicio").datepicker();
    $("#fecha_inicio").datepicker('option', {dateFormat: 'dd-mm-yy'});
    $("#fecha_termino").datepicker();
    $("#fecha_termino").datepicker('option', {dateFormat: 'dd-mm-yy'});

    column_chart();
    pie_chart();

});  

function pie_chart(){

    var options =  {
        chart: {
            renderTo: 'salas-chart',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Uso de salas por curso'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: []
        }]      
    };

    $.getJSON("{{ route('administrador.estadistica.index') }}",{dato:'salas'}, function(json) {

        $.each(json,function(k,v){
            options.series[0].data.push(v);
        }); 

        chart = new Highcharts.Chart(options);

    });
}    

function column_chart(){

    var options =  {
        chart: {
            renderTo: 'cursos-chart',
            type: 'column'
        },
        title: {
            text: 'Uso de salas'
        },
        subtitle: {
            text: ''
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
                text: 'Número de veces usadas'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Uso: <b>{point.y:.1f} horarios</b>'
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

    $.getJSON("{{ route('administrador.estadistica.index') }}",{dato:'cursos'}, function(json) {

        $.each(json,function(k,v){
            options.series[0].data.push(v);
        }); 

        chart = new Highcharts.Chart(options);

    });    
} 
</script>

@stop