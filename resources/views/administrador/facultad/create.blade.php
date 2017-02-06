@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.facultad.index') }}">Facultades</a></li>
    <li class="active">Ingresar Facultad</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h1 class="page-header">Facultad</h1>
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
                            {!! Form::open(['route' => ['administrador.facultad.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: Ingeniería">
                                </div>
                                <div class="form-group">
                                    <label>Campus</label>
                                    <select name="campus" class="form-control">
                                    @foreach($campus as $c)
                                        <option name="campus" value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Ingenieria y Ciencias..">
                                </div>
                                <button type="submit" class="btn btn-success">Aceptar</button>
                          	{!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop