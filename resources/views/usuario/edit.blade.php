@extends('main')

@section('container')

            <div class="col-lg-12">
                <h1 class="page-header">Editar Usuario: {{ $usuario->nombre }}</h1>
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
                                    {!! Form::model($usuario, ['route' => ['usuario.update', $usuario], 'method' => 'PUT']) !!}
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                                      <div class="form-group">
                                       {!! Form::label('rut', 'Rut') !!}
                                       {!! Form::text('rut', null,['class' => 'form-control', 'placeholder' => 'Ej: 18117925']) !!}
                                      </div>

                                      <div class="form-group">
                                       {!! Form::label('email', 'Email') !!}
                                       {!! Form::text('email', null,['class' => 'form-control', 'placeholder' => 'Ej: nicolas.vera@ceinf.cl']) !!}
                                      </div>

                                      <div class="form-group">
                                       {!! Form::label('nombres', 'Nombre') !!}
                                       {!! Form::text('nombres', null,['class' => 'form-control', 'placeholder' => 'Ej: Nicolás']) !!}
                                      </div>

                                      <div class="form-group">
                                       {!! Form::label('apellidos', 'Apellido') !!}
                                       {!! Form::text('apellidos', null,['class' => 'form-control', 'placeholder' => 'Ej: Vera']) !!}
                                      </div>

                                      <button type="submit" class="btn btn-success">Aceptar</button>
                                  	{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@stop
