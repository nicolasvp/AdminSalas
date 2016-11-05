@extends('main')

@section('container')

            <div class="col-lg-12">
                <h1 class="page-header">Editar Rol: {{ $rol->nombre }}</h1>
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
                                    {!! Form::model($rol, ['route' => ['rol.update', $rol], 'method' => 'PUT']) !!}
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                      <div class="form-group">
                                       {!! Form::label('nombre', 'Nombre') !!}
                                       {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: Encargado de Secretaria de Estudios']) !!}
                                      </div>                                                                  
                                      <div class="form-group">
                                       {!! Form::label('descripcion', 'Descripción') !!}
                                       {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: Encargado del campus..']) !!}
                                      </div>
                                      <button type="submit" class="btn btn-success">Aceptar</button>
                                  	{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@stop
