@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.docente.index') }}">Docentes</a></li>
    <li class="active">Editar Docente</li>
@stop


@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar Docente: {{ $docente->nombres }} {{ $docente->apellidos }}</h2>
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
                          {!! Form::model($docente, ['route' => ['administrador.docente.update', $docente], 'method' => 'PUT']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <div class="form-group">
                             {!! Form::label('nombres', 'Nombres') !!}
                             {!! Form::text('nombres', null,['class' => 'form-control', 'placeholder' => 'Ej: Mauro', 'required']) !!}
                            </div>
                             <div class="form-group">
                             {!! Form::label('apellidos', 'Apellidos') !!}
                             {!! Form::text('apellidos', null,['class' => 'form-control', 'placeholder' => 'Ej: Castillo', 'required']) !!}
                            </div>     
                             <div class="form-group">
                             {!! Form::label('rut', 'Rut') !!}
                             {!! Form::text('rut', null,['class' => 'form-control', 'placeholder' => 'Ej: 6123121', 'required']) !!}
                            </div>                                                                                
                            <div class="form-group">
                             {!! Form::label('email', 'Email') !!}
                             {!! Form::email('email', null,['class' => 'form-control', 'placeholder' => 'Ej: mcast@utem.cl']) !!}
                            </div>
                            <div class="form-group">
                                <label>Departamento</label>
                                <select name="departamento" id="departamento" class="form-control">
                                @foreach($departamentos as $departamento)
                                    <option name="departamento" id="departamento_{{ $departamento->id }}" value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                @endforeach
                                </select>
                            </div>

                            <input type="hidden" id="departamento_id" value="{{ $docente->departamento_id }}">

                            <button type="submit" class="btn btn-success">Aceptar</button>
                            <a href="{{ URL::previous() }}" class="btn btn-default" role="button">Cancelar</a>
                        	{!! Form::close() !!}
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