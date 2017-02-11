@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.carrera.index') }}">Carreras</a></li>
    <li class="active">Editar Carrera</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar Carrera: {{ $carrera->nombre }}</h2>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4> Ingrese los datos </h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        {!! Form::model($carrera, ['route' => ['administrador.carrera.update', $carrera], 'method' => 'PUT']) !!}
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                          <div class="form-group">
                           {!! Form::label('nombre', 'Nombre') !!}
                           {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingeniería en Informática']) !!}
                          </div>
                           <div class="form-group">
                           {!! Form::label('codigo', 'Codigo') !!}
                           {!! Form::text('codigo', null,['class' => 'form-control', 'placeholder' => 'Ej: 21030']) !!}
                          </div>                                                                        
                          <div class="form-group">
                           {!! Form::label('descripcion', 'Descripción') !!}
                           {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: ingenieria y computacion aplicada..']) !!}
                          </div>
                          <div class="form-group">
                              <label>Escuela</label>
                              <select name="escuela" id="escuela" class="form-control">
                              @foreach($escuelas as $escuela)
                                  <option name="escuela" id="escuela_{{ $escuela->id }}" value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>
                              @endforeach
                              </select>
                          </div>

                          <input type="hidden" id="escuela_id" value="{{ $carrera->escuela_id }}">

                          <button type="submit" class="btn btn-success">Aceptar</button>
                      	{!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


@stop

@section('scripts')
<script>
$(document).ready(function(){

  var escuela_id = $("#escuela_id").val();

  $("#escuela option[id='escuela_"+escuela_id+"']").attr('selected','selected');

});
</script>
@stop