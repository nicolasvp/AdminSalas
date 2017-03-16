@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.periodo.index') }}">Períodos</a></li>
    <li class="active">Editar Período</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar Periodo: {{ $periodo->bloque }}</h2>
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
                          {!! Form::model($periodo, ['route' => ['administrador.periodo.update', $periodo], 'method' => 'PUT']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <div class="form-group">
                             {!! Form::label('bloque', 'Bloque') !!}
                             {!! Form::text('bloque', null,['class' => 'form-control', 'placeholder' => 'Ej: I', 'required']) !!}
                            </div>                                                                  
                            <div class="form-group">
                             {!! Form::label('inicio', 'Inicio') !!}
                             {!! Form::time('inicio', null,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                             {!! Form::label('fin', 'Fin') !!}
                             {!! Form::time('fin', null,['class' => 'form-control', 'required']) !!}
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
