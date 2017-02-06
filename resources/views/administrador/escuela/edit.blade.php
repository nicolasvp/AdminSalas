@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.escuela.index') }}">Escuelas</a></li>
    <li class="active">Editar Escuela</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h1 class="page-header">Editar Escuela: {{ $escuela->nombre }}</h1>
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
                        {!! Form::model($escuela, ['route' => ['administrador.escuela.update', $escuela], 'method' => 'PUT']) !!}
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                          <div class="form-group">
                           {!! Form::label('nombre', 'Nombre') !!}
                           {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingeniería']) !!}
                          </div>

                          <div class="form-group">
                              <label>Departamento</label>
                              <select name="departamento" id="departamento" class="form-control">
                              @foreach($departamentos as $departamento)
                                  <option name="departamento" id="departamento_{{ $departamento->id }}" value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                              @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                           {!! Form::label('descripcion', 'Descripción') !!}
                           {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingenieria y Ciencias..']) !!}
                          </div>

                          <input type="hidden" id="departamento_id" value="{{ $escuela->departamento_id }}">

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