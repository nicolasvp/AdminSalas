@extends('administrador/main')

@section('option')
    <li class="active">Estadísticas</li>
@stop

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
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
                                    <label>Campus</label>
                                    <select class="form-control" id="campus" name="campus" onChange="search_elements()">
                                        <option value="">Seleccione</option>
                                        @foreach($campus as $camp)
                                        <option value="{{ $camp->id }}">{{ $camp->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>                                
                            </div>                           
                            <div class="col-lg-2">
                                <div class="form-group" id="form-fecha-ini">
                                    <label>Tipo</label>
                                    <select class="form-control" id="tipos" name="tipos" onChange="search_elements()">
                                        <option value="">Seleccione</option>
                                        <option value="salas">Salas</option>
                                        <option value="cursos">Cursos</option>
                                        <option value="carreras">Carreras</option>
                                        <option value="asistencia">Asistencia</option>
                                        <option value="estado_salas">Estado de Salas</option>
                                    </select>
                                </div>                                
                            </div>
                        </div>
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
                                <div class="form-group" id="form-fecha-term">
                                    <label>Semestre</label>
                                    <select class="form-control" id="semestre" name="semestre">
                                        <option value="0">Seleccione</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-lg-2">
                                <div class="form-group" id="form-fecha-term">
                                    <label>Año</label>
                                    <select class="form-control" id="anio" name="anio">
                                        <option name="anio" value="">Seleccione</option>
                                    <!-- Esto hay que hacerlo dinámico -->
                                        @foreach($anios as $anio)
                                        <option value="{{ $anio->anio }}">{{ $anio->anio }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>    
                            <div class="col-lg-2">
                                <div class="form-group" id="form-fecha-term">
                                    <label>Elemento</label>
                                    <select class="form-control" id="elemento" name="elemento">
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>                                                                                
                            <div class="col-lg-2">
                                <button id="buscar" class="btn btn-success" onClick="search_results()" style="margin-top: 25px;">Aceptar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading estadisticas" style="text-transform:capitalize;">
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="pie-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading estadisticas" style="text-transform:capitalize;">
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="column-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    $("#fecha_inicio").datepicker();
    $("#fecha_inicio").datepicker('option', {dateFormat: 'dd-mm-yy'});
    $("#fecha_termino").datepicker();
    $("#fecha_termino").datepicker('option', {dateFormat: 'dd-mm-yy'});

});  


function search_elements()
{

    var tipo = $("#tipos").val();
    var campus = $("#campus").val();

    $.get("{{ route('administrador.estadistica.tipos') }}",{tipo: tipo,campus: campus}, function(response) {

        $("#elemento").empty();
        $("#elemento").append('<option value="">Seleccione</option>');
        $.each(response,function(k,v){

            $("#elemento").append("<option value='"+v.id+"'>"+v.nombre+"</option>");

        });

    });

}


function search_results(){

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_termino = $("#fecha_termino").val();
    var semestre = $("#semestre").val();
    var tipo = $("#tipos").val();
    var campus = $("#campus").val();
    var anio = $("#anio").val();
    var elemento = $("#elemento").val();

    switch(tipo)
    {
        case "salas":
            $(".estadisticas").text(tipo);
            ruta = "{{ route('administrador.estadistica.salas') }}";
        break;

        case "cursos":
            $(".estadisticas").text(tipo);
            ruta = "{{ route('administrador.estadistica.cursos') }}";
        break;

        case "carreras":
            $(".estadisticas").text(tipo);
            ruta = "{{ route('administrador.estadistica.carreras') }}";
        break;

        case "asistencia":
            $(".estadisticas").text(tipo);
            ruta = "{{ route('administrador.estadistica.asistencia') }}";
        break;

        case "estado_salas":
            $(".estadisticas").text(tipo);
            ruta = "{{ route('administrador.estadistica.estado_salas') }}";
        break;

        default:
            ruta = "";
    }

    column_chart(campus,tipo,fecha_inicio,fecha_termino,semestre,anio,elemento,ruta);
    pie_chart(campus,tipo,fecha_inicio,fecha_termino,semestre,anio,elemento,ruta);

}



function pie_chart(campus,tipo,fecha_inicio,fecha_termino,semestre,anio,elemento,ruta){

    var options =  {
        chart: {
            renderTo: 'pie-chart',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Uso por '+tipo
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

    $.getJSON(ruta,{campus: campus, tipo:tipo, fecha_inicio: fecha_inicio, fecha_termino: fecha_termino,semestre: semestre,anio: anio,elemento: elemento}, function(json) {

        if(json.length == 0)
        {
            $(".estadisticas").text('Sin resultados');
        }

        $.each(json,function(k,v){
            options.series[0].data.push(v);
        }); 

        chart = new Highcharts.Chart(options);            
        

    });
}    

function column_chart(campus,tipo,fecha_inicio,fecha_termino,semestre,anio,elemento,ruta){

    var options =  {
        chart: {
            renderTo: 'column-chart',
            type: 'column'
        },
        title: {
            text: 'Uso por '+tipo
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
            pointFormat: 'Uso: <b>{point.y:.1f} asignaciones</b>'
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

    $.getJSON(ruta,{campus: campus, tipo:tipo, fecha_inicio: fecha_inicio, fecha_termino: fecha_termino,semestre: semestre,anio: anio, elemento: elemento}, function(json) {

        if(json.length == 0)
        {
            $(".estadisticas").text('Sin resultados');
        }

        $.each(json,function(k,v){
            options.series[0].data.push(v);
        }); 

        chart = new Highcharts.Chart(options);
    
    });    
} 
</script>

@stop