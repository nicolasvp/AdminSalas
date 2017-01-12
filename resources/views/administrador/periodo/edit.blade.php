@extends('administrador/main')

@section('container')

            <div class="col-lg-12">
                <h1 class="page-header">Editar Periodo: {{ $periodo->bloque }}</h1>
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
                                       {!! Form::text('bloque', null,['class' => 'form-control', 'placeholder' => 'Ej: I']) !!}
                                      </div>                                                                  
                                      <div class="form-group">
                                       {!! Form::label('inicio', 'Inicio') !!}
                                       {!! Form::text('inicio', null,['class' => 'form-control']) !!}
                                      </div>
                                      <div class="form-group">
                                       {!! Form::label('fin', 'Fin') !!}
                                       {!! Form::text('fin', null,['class' => 'form-control']) !!}
                                      </div>                                      
                                      <button type="submit" class="btn btn-success">Aceptar</button>
                                  	{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@stop
