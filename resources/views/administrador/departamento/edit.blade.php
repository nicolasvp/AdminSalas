@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.departamento.index') }}">Departamentos</a></li>
    <li class="active">Ingresar Departamento</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar Departamento: {{ $departamento->nombre }}</h2>
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
                        {!! Form::model($departamento, ['route' => ['administrador.departamento.update', $departamento], 'method' => 'PUT']) !!}
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                          <div class="form-group">
                           {!! Form::label('nombre', 'Nombre') !!}
                           {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingeniería', 'required']) !!}
                          </div>

                          <div class="form-group">
                              <label>Facultad</label>
                              <select name="facultad" id="facultad" class="form-control" required>
                                  <option value="">Seleccione</option>
                              @foreach($facultades as $facultad)
                                  <option id="facultad_{{ $facultad->id }}" value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                              @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                           {!! Form::label('descripcion', 'Descripción') !!}
                           {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingenieria y Ciencias..']) !!}
                          </div>

                          <input type="hidden" id="facultad_id" value="{{ $departamento->facultad_id }}">

                          <button type="submit" class="btn btn-success">Aceptar</button>
                          <a href="{{ URL::previous() }}" class="btn btn-default" role="button">Cancelar</a>
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

  var facultad_id = $("#facultad_id").val();

  $("#facultad option[id='facultad_"+facultad_id+"']").attr('selected','selected');

});
</script>
@stop