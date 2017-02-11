@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.asignatura.index') }}">Asignaturas</a></li>
    <li class="active">Editar Asignaturas</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar Asignatura: {{ $asignatura->nombre }}</h2>
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
                        {!! Form::model($asignatura, ['route' => ['administrador.asignatura.update', $asignatura], 'method' => 'PUT']) !!}
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                          <div class="form-group">
                           {!! Form::label('nombre', 'Nombre') !!}
                           {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingeniería de Software']) !!}
                          </div>
                           <div class="form-group">
                           {!! Form::label('codigo', 'Codigo') !!}
                           {!! Form::text('codigo', null,['class' => 'form-control', 'placeholder' => 'Ej: INF-2314']) !!}
                          </div>                                                                        
                          <div class="form-group">
                           {!! Form::label('descripcion', 'Descripción') !!}
                           {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: asignatura orientada a..']) !!}
                          </div>
                          <div class="form-group">
                              <label>Departamento</label>
                              <select name="departamento" id="departamento" class="form-control">
                              @foreach($departamentos as $departamento)
                                  <option name="departamento" id="departamento_{{ $departamento->id }}" value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                              @endforeach
                              </select>
                          </div>

                          <input type="hidden" id="departamento_id" value="{{ $asignatura->departamento_id }}">

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

  var departamento_id = $("#departamento_id").val();

  $("#departamento option[id='departamento_"+departamento_id+"']").attr('selected','selected');

});
</script>
@stop