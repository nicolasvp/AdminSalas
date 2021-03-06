@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.tipo_sala.index') }}">Tipos de Salas</a></li>
    <li class="active">Editar Tipo de Sala</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar tipo de sala: {{ $tipo->nombre }}</h2>
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
                        {!! Form::model($tipo, ['route' => ['administrador.tipo_sala.update', $tipo], 'method' => 'PUT']) !!}
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                          <div class="form-group">
                           {!! Form::label('nombre', 'Nombre') !!}
                           {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: m1-201', 'required']) !!}
                          </div>                                                                  
                          <div class="form-group">
                           {!! Form::label('descripcion', 'Descripción') !!}
                           {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: Sala del edificio m1']) !!}
                          </div>
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
